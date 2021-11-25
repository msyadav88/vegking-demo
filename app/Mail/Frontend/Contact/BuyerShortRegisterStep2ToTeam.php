<?php

namespace App\Mail\Frontend\Contact;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyerShortRegisterStep2ToTeam extends Mailable
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

    public function __construct($request,$users,$email_template)
    {
        $this->request = $request;
        $this->user = $users;
        $this->email_template = $email_template;
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
      $email_template = $this->email_template;
            
      if(!empty($email_template)){

        if($this->user->hasRole('testuser')){
          $msg_username = $this->user->first_name." ".live_dev_site_status();            
        }else{
          $msg_username = $name;
        }
        $msg_content = "Hi ".$msg_username.",";

        $email_content = '';
        if($email_template){
          if($locale == 'pl'){
            $email_content = $email_template->email_content_pl;
          }else{
            $email_content = $email_template->email_content;
          }
          $email_content = $msg_content.str_replace("[team_member_name]", $name, $email_content);
          $email_content = str_replace("[email]", $this->request->email, $email_content);
          $email_content = str_replace("[phone]", (substr(trim($this->request->phone),0,1) != '+' ? '+' : '').$this->request->phone, $email_content);
        }
      }
        return $this->view('frontend.mail.general',['email_content' => $email_content, 'uuid'=> $this->request->uuid ])
        ->subject($email_template->subject)
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->replyTo(config('mail.from.address'), config('mail.from.name')); 
      
    }
}