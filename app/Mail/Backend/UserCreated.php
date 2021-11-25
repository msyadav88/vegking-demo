<?php

namespace App\Mail\Backend;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendContact.
 */
class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct($user, $password, $email_template = NULL)
    {
        $this->user = $user;
        $this->password = $password;
        $this->email_template = $email_template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $locale = \App::getLocale();

        if($this->email_template != NULL){
           $email_template = $this->email_template;
        }else{
           $email_template = get_email_template('USER CREATED');
        }

        if($email_template){
            $globalHeader = getHeaderFooter($email_template->id, $locale);
            if($locale == 'pl')
            {
                $email_content = $globalHeader['header'];
                $email_content .= $email_template->email_content_pl;
                $email_content .= $globalHeader['footer'];
            }
            else if($locale == 'de')
            {
                $email_content = $globalHeader['header'];
                $email_content .= $email_template->email_content_de;
                $email_content .= $globalHeader['footer'];
            }
            else
            {
                $email_content = $globalHeader['header'];
                $email_content .= $email_template->email_content;
                $email_content .= $globalHeader['footer'];
            }
            $name = $this->user['first_name'].' '.$this->user['last_name'];            
            $email_content = str_replace("[recipient]",$name, $email_content);
            $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
            $email_content = str_replace("[role]", 'user', $email_content);
            $email_content = str_replace("[name]", $name, $email_content);
            $email_content = str_replace("[email]", $this->user['email'], $email_content);
            $email_content = str_replace("[password]", $this->password, $email_content);
            $email_content = str_replace("[phone]", (substr(trim($this->user['phone']),0,1) != '+' ? '+' : '').$this->user['phone'], $email_content);            
        }
            return $this->view('frontend.mail.general',['email_content' => $email_content], 'uuid'=>$user->uuid)
            ->subject($email_template->subject)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.from.address'), config('mail.from.name'));    
    }
}