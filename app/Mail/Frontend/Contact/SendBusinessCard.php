<?php

namespace App\Mail\Frontend\Contact;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendBusinessCard.
 */
class SendBusinessCard extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;

    /**
     * SendBusinessCard constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->request->name;
        /*$this->to(config('mail.from.address'), config('mail.from.name'))
            ->view('frontend.mail.buyercontact')
            // ->text('frontend.mail.contact-text')
            ->subject(__('strings.emails.contact.subject', ['app_name' => app_name()]))
            ->from($this->request->email, $name )
            ->replyTo($this->request->email, $name );*/

        $locale = \App::getLocale();
        $email_content = '';
        $email_template = get_email_template('BUYER LEAD');
        if($email_template){
            $email_verification_link = '';
            if($locale == 'pl'){
                $email_content = $email_template->email_content_pl;
            }else{
                $email_content = $email_template->email_content;
            }

            $email_content = str_replace("[english_phone_number]", \Lang::get('inner-content.frontend.contactsec.phone-2'), $email_content);
            $email_content = str_replace("[product_name]", $this->request->product_name, $email_content);
            $email_content = str_replace("[product_sub_type]", $this->request->product_sub_type, $email_content);
            $email_content = str_replace("[name]", $this->request->name, $email_content);
            $email_content = str_replace("[email]", $this->request->email, $email_content);
            $email_content = str_replace("[phone]", (substr(trim($this->request->phone),0,1) != '+' ? '+' : '').$this->request->phone, $email_content);
            $email_content = str_replace("[contact_preferred_method]", $this->request->prefered_method, $email_content);
            $email_content = str_replace("[notes]", $this->request->notes, $email_content);
            $email_content = str_replace("[verification_link]", $email_verification_link, $email_content);
        }
            return $this->to($this->request->email, $name )
                ->view('frontend.mail.buyer_lead',['email_content' => $email_content, 'uuid'=> $this->request->uuid])
                ->subject($email_template->subject)
                ->from(config('mail.from.address'), config('mail.from.name'))
                ->replyTo(config('mail.from.address'), config('mail.from.name'));
        
    }
}
