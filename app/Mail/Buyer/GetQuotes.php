<?php

namespace App\Mail\Buyer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GetQuotes extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($team,$buyers_data)
    {
        $this->team = $team;
        $this->buyers_data = $buyers_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $locale = \App::getLocale();
        $email_content = '';
        $email_template = get_email_template('GET QUOTES');
        \App\EmailTemplate::where('title', 'GET QUOTES')->increment('sent');
        
        if($email_template){
            if($this->team->hasRole('testuser')){
              $msg_username = $this->team->name." ".live_dev_site_status();            
            }else{
              $msg_username = $this->team->name;
            }

            $email_content = 'King [username] [env] [role],';
            if($locale == 'pl'){
              $email_content .= $email_template->email_content_pl;
            }else{
              $email_content .= $email_template->email_content;
            }
            $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
            $email_content = str_replace("[role]", 'seller/buyer', $email_content);
            $buyername_link = '<a href="'.route('admin.buyers.show',$this->buyers_data['buyer_id']).'">'.$this->buyers_data['name'].'</a>';
            $email_content = str_replace("[team_member_name]", $this->team->name, $email_content);
            $email_content = str_replace("[name]", $buyername_link, $email_content);
            $email_content = str_replace("[phone]", (substr(trim($this->buyers_data['phone']),0,1) != '+' ? '+' : '').$this->buyers_data['phone'], $email_content);
            $uuid = $this->team->uuid;
        }
        return $this->view('frontend.mail.general',compact('email_content' , 'uuid'));
    }
}