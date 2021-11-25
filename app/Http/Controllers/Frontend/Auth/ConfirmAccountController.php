<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;

/**
 * Class ConfirmAccountController.
 */
class ConfirmAccountController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ConfirmAccountController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param $token
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function confirm($token)
    {
        $this->user->confirm($token);

        return redirect()->route(home_route())->withFlashSuccess(__('exceptions.frontend.auth.confirmation.success'));
    }

    /**
     * @param $uuid
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function sendConfirmationEmail($uuid)
    {
        //echo "<pre>"; print_r(Auth()->user()->uuid); exit('da'); 
        $user = $this->user->findByUuid($uuid);
        // if ($user->isConfirmed()) {
        //     return redirect()->route('frontend.auth.login')->withFlashSuccess(__('exceptions.frontend.auth.confirmation.already_confirmed'));
        // }

        $user->notify(new UserNeedsConfirmation($user));
        return redirect()->back()->withFlashSuccess(__('exceptions.frontend.auth.confirmation.resent'));
    }
    public function sendWhatsappVerification($uuid)
    {
        $user = $this->user->findByUuid($uuid);
        if ($user->whatsapp_verified_at != NULL) {
            return redirect()->route('frontend.auth.login')->withFlashSuccess(__('exceptions.frontend.auth.whatsapp_verification.already_confirmed'));
        }
        $locale = \App::getLocale();
            // echo 'dfd'.$locale;exit;
        $email_content = '';
        $email_content = 'King [username] [env] [role],';
        $email_template = get_email_template('VERIFY EMAIL');
        \App\EmailTemplate::where('title', 'VERIFY EMAIL')->increment('sent');
        if($email_template){
            if($user->hasRole('testuser')){
              $msg_username = $user->name." ".live_dev_site_status();            
            }else{
              $msg_username = $user->name;
            }
            $msg_content = "Hi ".$msg_username.",";

            $whatsapp_verification_link = route('frontend.auth.whatsapp.verify', $user->whatsapp_verification_code);
            if($locale == 'pl'){
              $email_content .= $email_template->sms_content_pl;
            }else{
              $email_content .= $email_template->sms_content;
            }
            $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
            $email_content = str_replace("[role]", 'seller/buyer', $email_content);
            $email_content = $msg_content.str_replace("[name]", $user->name, $email_content);
            $email_content = str_replace("[first_name]", $user->first_name, $email_content);
            $email_content = str_replace("[verification_link]", $whatsapp_verification_link, $email_content);

            $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $uuid);
            
            $email_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $email_content); 
        }
         SendWhatsapp(['phone' => $user->whatsapp_number, 'body' => $email_content,'is_PDF'=>false]);
        return redirect()->back()->withFlashSuccess(__('exceptions.frontend.auth.whatsapp_verification.resent'));
    }
    public function whatsappVerify($token)
    {
        $this->user->confirm($token, 'whatsapp');

        return redirect()->route(home_route())->withFlashSuccess(__('exceptions.frontend.auth.whatsapp_verification.success'));
    }
}
