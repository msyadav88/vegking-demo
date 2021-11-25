<?php

namespace App\Notifications\Frontend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserNeedsConfirmation.
 */
class UserNeedsConfirmation extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $confirmation_code;

    /**
     * UserNeedsConfirmation constructor.
     *
     * @param $confirmation_code
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $locale = \App::getLocale();
            // echo 'dfd'.$locale;exit;
        $email_content = '';
        $email_template = get_email_template('VERIFY EMAIL');
        \App\EmailTemplate::where('title', 'VERIFY EMAIL')->increment('sent');
        if($email_template){

            if($this->user->hasRole('testuser')){
              $msg_username = $this->user->name." ".live_dev_site_status();            
            }else{
              $msg_username = $this->user->name;
            }
            $msg_content = "Hi ".$msg_username.",";

            $email_verification_link = '<a href="'.route('frontend.auth.account.confirm', $this->user->confirmation_code).'">'.\Lang::get('email.confirm_email').'</a>';
            if($locale == 'pl'){
              $email_content = $email_template->email_content_pl;
            }else{
              $email_content = $email_template->email_content;
            }
            $email_content = $msg_content.str_replace("[name]", $this->user->name, $email_content);
            $email_content = str_replace("[first_name]", $this->user->first_name, $email_content);
            $email_content = str_replace("[verification_link]", $email_verification_link, $email_content);
        }
        // echo $email_content;exit;
            return (new MailMessage())
                ->subject(app_name().': '.__('exceptions.frontend.auth.confirmation.confirm'))
                ->view('frontend.mail.verify_email',['email_content' => $email_content, 'uuid' => $this->user->uuid]);
                // ->line(__('strings.emails.auth.click_to_confirm'))
                // ->action(__('buttons.emails.auth.confirm_account'), route('frontend.auth.account.confirm', $this->confirmation_code))
                // ->line(__('strings.emails.auth.thank_you_for_using_app'));
    }
}
