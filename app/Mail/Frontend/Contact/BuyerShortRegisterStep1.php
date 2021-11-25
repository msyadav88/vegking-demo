<?php

namespace App\Mail\Frontend\Contact;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendContact.
 */
class BuyerShortRegisterStep1 extends Mailable
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
    public function __construct(Request $request,$email_template)
    {
        $this->request = $request;
        $this->email_template = $email_template;
        //print_r($this->request->toArray());exit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $locale = \App::getLocale();

        $email_template = $this->email_template;
            
        if(!empty($email_template)){
            $email_content = '';            
            if($email_template){
                $email_verification_link = '';
                if($locale == 'pl'){
                    $email_content = $email_template->email_content_pl;
                }else if($locale == 'de'){
                    $email_content = $email_template->email_content_de;
                }else{
                    $email_content = $email_template->email_content;
                }
                $email_content = str_replace("[email]", $this->request->email, $email_content);
                $email_content = str_replace("[buyerlead_step1_link]", $this->request->view_buyerlead_link, $email_content);
            }
        }
        $uuid = $this->request->uuid;
        return $this->view('frontend.mail.general',['email_content' => $email_content, 'uuid'=> $uuid ])
            ->subject($email_template->subject)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.from.address'), config('mail.from.name'));
    }
}