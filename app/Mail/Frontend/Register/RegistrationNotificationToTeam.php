<?php

namespace App\Mail\Frontend\Register;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationNotificationToTeam extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($user,$team,$buyer_seller, $email_template, $email_subject)
  {
      $this->user = $user;
      $this->team = $team;
      $this->buyer_seller = $buyer_seller;
      $this->email_template = $email_template;
      $this->subject = $email_subject;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $locale = \App::getLocale();
    $email_content = $this->email_template;
    if($email_content)
    {
      $email_content = str_replace("[team_member_name]", $this->team->name, $email_content);
      if($this->user->hasRole('buyer'))
      {
        if($locale == 'pl')
        {
          $product_name_column = 'name_pl';
        }
        elseif($locale == 'de')
        {
          $product_name_column = 'name_de';
        }
        else
        {
          $product_name_column = 'name';
        }
        $product_name = \App\Product::where('id',$this->buyer_seller->product_id)->first()[$product_name_column];
        $email_content = str_replace("[product_name]", $product_name, $email_content);
        $email_content = str_replace("[product_sub_type]", $this->buyer_seller->product_sub_type, $email_content);
      }
      $email_content = str_replace("[recipient]", $this->team->name, $email_content);
      $levels = $this->buyer_seller->trust_level == '' ? 'level 1' : $this->buyer_seller->trust_level;
      $email_content = str_replace("[level]", $levels, $email_content);
      $email_content = str_replace("[name]", $this->user->name, $email_content);
      $email_content = str_replace("[email]", $this->user->email, $email_content);
      $email_content = str_replace("[phone]", (substr(trim($this->user->phone),0,1) != '+' ? '+' : '').$this->user->phone, $email_content);
      
      $email_content = str_replace("[unsubscribe]", "" , $email_content); 

      if($this->user->hasRole('seller'))
      {
        $email_content = str_replace("[view_seller_link]", route('admin.sellers.show',$this->buyer_seller->id), $email_content);
      }
      elseif($this->user->hasRole('buyer'))
      {
        $email_content = str_replace("[view_buyer_link]", route('admin.buyers.show',$this->buyer_seller->id), $email_content); 
      }   
    }
    return $this->view('frontend.mail.general',['email_content' => $email_content, 'uuid'=> $this->team->uuid ])
      ->subject($this->subject)
      ->from(config('mail.from.address'), config('mail.from.name'))
      ->replyTo(config('mail.from.address'), config('mail.from.name'));
    
  }
}
