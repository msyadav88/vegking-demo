<?php

namespace App\Mail\Frontend\Contact;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyerleadNotificationToTeam extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    /*public function __construct($user,$team)
    {
        $this->user = $user;
        $this->team = $team;
    }*/

    public function __construct($request,$users)
    {
        $this->request = $request;
        $this->user = $users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $name = $this->request->name;
      $locale = \App::getLocale();     
      $name = ucfirst($this->user->first_name).' '.ucfirst($this->user->last_name);
      $email_content = '';
      $email_content = 'King [name] [env] [role],';
      $email_template = get_email_template('BUYER LEAD TO TEAM');
      if($email_template){
        if($locale == 'pl'){
          $email_content .= $email_template->email_content_pl;
        }else{
          $email_content .= $email_template->email_content;
        }
        $email_content = str_replace("[team_member_name]", $name, $email_content);   

        if(isset($this->request->product_name))   {      
        $email_content = str_replace("[product_name]", $this->request->product_name, $email_content);
        }

        if(isset($this->request->product_sub_type)){
        $email_content = str_replace("[product_sub_type]", $this->request->product_sub_type, $email_content);
        }

        if(isset($this->request->first_name) || $this->request->first_name !== ''){
        $email_content = str_replace("[name]", $this->request->first_name, $email_content);
        }
        else{
          $email_content = str_replace("Name: [name]",' ', $email_content);
        }

        $email_content = str_replace("[email]", $this->request->email, $email_content);

        if(isset($this->request->phone)){
          $email_content = str_replace("[phone]", (substr(trim($this->request->phone),0,1) != '+' ? '+' : '').$this->request->phone, $email_content);            
        }
        if(isset($this->request->buyerlead_id)){
          $email_content = str_replace("[view_buyer_lead_link]", route('admin.buyerleads.show',$this->request->buyerlead_id), $email_content);            
        }
        $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
        $email_content = str_replace("[role]", 'buyer', $email_content);
          return $this->to($this->user->email, $name )->view('frontend.mail.general',['email_content' => $email_content, 'uuid'=>$this->user->uuid ]  )
          ->subject($email_template->subject)
          ->from(config('mail.from.address'), config('mail.from.name'))
          ->replyTo(config('mail.from.address'), config('mail.from.name'));
      }    
    }
}