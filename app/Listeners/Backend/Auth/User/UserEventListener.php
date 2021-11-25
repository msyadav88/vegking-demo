<?php

namespace App\Listeners\Backend\Auth\User;
use App\Events\Pushnotification;
use App\Roles;
use App\Models\Auth\User;
use Mail;
use DateTime;
use App\Buyer;
use App\Seller;
use App\Repositories\Backend\Auth\UserRepository;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function onCreated($event)
    {
        \Log::info('User Created');
        $user = auth()->user();
        //start user-created
		\App\Jobs\UserCreated::dispatch(@$user,@$event);
		//end user-created
    }

    public function UserCreated($event)
    {
            $locale = \App::getLocale();
            $user = auth()->user();
            $email_content = '';
    
            $email_template = get_email_template('USER CREATED');
            \App\EmailTemplate::where('title', 'USER CREATED')->increment('sent');

            if($email_template)
            {
                $globalHeader = getHeaderFooter($email_template->id, $locale);
                if($locale == 'pl')
                {
                    $email_content = $globalHeader['header'];
                    $sms_content = $globalHeader['header'];
                    $sms_content .= "\r\n";

                    $email_content .= $email_template->email_content_pl;
                    $sms_content .= $email_template->sms_content_pl;
                    $push_content = $email_template->push_content_pl;

                    $sms_content .= "\r\n";
                    $email_content .= $globalHeader['footer'];
                    $sms_content .= $globalHeader['footer'];
                }
                else if($locale == 'de')
                {
                    $email_content = $globalHeader['header'];
                    $sms_content = $globalHeader['header'];
                    $sms_content .= "\r\n";

                    $email_content .= $email_template->email_content_de;
                    $sms_content .= $email_template->sms_content_de;
                    $push_content = $email_template->push_content_de;

                    $sms_content .= "\r\n";
                    $email_content .= $globalHeader['footer'];
                    $sms_content .= $globalHeader['footer'];
                }
                else
                {
                    $email_content = $globalHeader['header'];
                    $sms_content = $globalHeader['header'];
                    $sms_content .= "\r\n";

                    $email_content .= $email_template->email_content;
                    $sms_content .= $email_template->sms_content;
                    $push_content = $email_template->push_content_en;

                    $sms_content .= "\r\n";
                    $email_content .= $globalHeader['footer'];
                    $sms_content .= $globalHeader['footer'];
                }
                
                $name = $event->user['first_name'].' '.$event->user['last_name'];
    
                $password = request()->password;
                \Mail::to($event->user['email'],$name)->send(new \App\Mail\Backend\UserCreated($event->user, $password, $email_template));
             
                $sms_content = str_replace("[env]", env('APP_ENV'), $sms_content);
                $sms_content = str_replace("[role]", 'seller/buyer', $sms_content);
                $sms_content = str_replace("[recipient]", $name, $sms_content);
                $sms_content = str_replace("[email]", $event->user['email'], $sms_content);
                $sms_content = str_replace("[password]", $event->user['password'], $sms_content);
                $sms_content = str_replace("[phone]", (substr(trim($event->user['phone']),0,1) != '+' ? '+' : '').$event->user['phone'], $sms_content);
        
                $push_content = str_replace("[recipient]", $name, $push_content);
                $push_content = str_replace("[email]", $event->user['email'], $push_content);
                $push_content = str_replace("[password]", $event->user['password'], $push_content);
                $push_content = str_replace("[phone]", (substr(trim($event->user['phone']),0,1) != '+' ? '+' : '').$event->user['phone'], $push_content);
                
                $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
            
                $push_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $push_content); 
                
                        SendWhatsapp(['phone' => @$event->user['phone'], 'body' => $sms_content,'is_PDF'=>false]);    
                
                
                //SendSMS(@$event->user['phone'],$sms_content);
                if($push_content)
                {
                    event(new Pushnotification($push_content,$event->user['id']));
                }
            }
            else
            {
                \Log::info('Email template "USER CREATED" not exist ');         
            }

            if($email_template->roles_content)
            {
                $email_content = '';
                $email_subject = '';
                $roles = Roles::get();
    
                //----------- The Trader Email Content -----------//
                if( in_array(1003 ,explode(',',$email_template->recipients)) )
                {
                    $globalHeader = getHeaderFooter($email_template->id, $locale);
                    $result = $this->userRepository->orderBy('id', 'asc')->get();
                    $traders = $result->filter(function ($result, $key) {
                        return $result->hasRole('trader');
                    });
                    if (count($traders)>0) {
                        foreach ($traders as $tarder) {
                            $tarder_emails[] = $tarder->email;
                        }
                        foreach ($traders as $tarder) {
                            $tarder_phones[] = $tarder->phone;
                        }
                 
                        $traderdata = Auth()->user();
                        $traderlevels = isset($traderdata->trust_level) == "" ? "1" : isset($traderdata->trust_level);
                        $title = $traderdata->gender == 0 ? 'King':'Queen';
                        if($locale == 'de')
                        {
                            $email_content = $globalHeader['header'];
                            $whatsapp_content = $globalHeader['header'];
                            $whatsapp_content .= "\r\n";

                            $email_content .= $email_template->trader_email_content_de;
                            $whatsapp_content .= $email_template->trader_sms_content_de;
                            $email_subject = $email_template->trader_subject;

                            $whatsapp_content .= "\r\n";
                            $email_content .= $globalHeader['footer'];
                            $whatsapp_content .= $globalHeader['footer'];
                        }
                        elseif($locale == 'pl')
                        {
                            $email_content = $globalHeader['header'];
                            $whatsapp_content = $globalHeader['header'];
                            $whatsapp_content .= "\r\n";

                            $email_content .= $email_template->trader_email_content_pl;
                            $whatsapp_content .= $email_template->trader_sms_content_pl;
                            $email_subject = $email_template->trader_subject;

                            $whatsapp_content .= "\r\n";
                            $email_content .= $globalHeader['footer'];
                            $whatsapp_content .= $globalHeader['footer'];
                        }
                        else
                        {
                            $email_content = $globalHeader['header'];
                            $whatsapp_content = $globalHeader['header'];
                            $whatsapp_content .= "\r\n";

                            $email_content .= $email_template->trader_email_content;
                            $whatsapp_content .= $email_template->trader_sms_content;
                            $email_subject = $email_template->trader_subject;

                            $whatsapp_content .= "\r\n";
                            $email_content .= $globalHeader['footer'];
                            $whatsapp_content .= $globalHeader['footer'];
                        }
                        $email_content = str_replace("[title]", $title, $email_content);
                        $email_content = str_replace("[level]", 'level '.$traderlevels, $email_content);
                        $email_content = str_replace("[recipient]", $traderdata->first_name.' '.$traderdata->last_name, $email_content);
                        $email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
                        $email_content = str_replace("[role]", 'trader', $email_content);
                        $email_content = str_replace("[username]", $traderdata->first_name.' '.$traderdata->last_name, $email_content);
    
                        $whatsapp_content = str_replace("[title]", $title, $whatsapp_content);
                        $whatsapp_content = str_replace("[level]", 'level '.$traderlevels, $whatsapp_content);
                        $whatsapp_content = str_replace("[recipient]", $traderdata->first_name.' '.$traderdata->last_name, $whatsapp_content);
                        $whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
                        $whatsapp_content = str_replace("[role]", 'trader', $whatsapp_content);
                        
                        foreach ($tarder_emails as $trader_email) {
                            if (isset($trader_email)) {
                                Mail::send('backend.mail.default', ['name' => 'User created','body'=> $email_content], function ($message) use ($trader_email,$email_subject) {
                                    $message->subject($email_subject);
                                    if ($trader_email != '') {
                                        $message->to($trader_email);
                                    }
                                });
                            }
                        }
                        
                        foreach ($tarder_phones as $trader_phone) {
                            if (isset($trader_phone)) {
                              //Whatsapp
                            // SendWhatsapp(['phone' => $trader_phone, 'body' => $whatsapp_content, 'is_PDF'=>false]);
                            }
                        }
                        foreach ($tarder_phones as $trader_phone) {
                            if (isset($trader_phone)) {
                             //Text
                            //SendSMS($traderdata->phone, $seller_url);
                            }
                        }
                    }
                }
                //----------- The Trader Email Content -----------//
    
            }
            if(isset($email_template->roles_content))
                {
                    $roles = Roles::get();
                    $recipients_template = json_decode($email_template->roles_content);
                    $globalHeader = getHeaderFooter($email_template->id, $locale);
                    foreach($roles as $role)
                    {
                        $rolename = $role->name;
                        if( in_array($role->id ,explode(',',$email_template->recipients)) )
                        {					
                            if($locale == 'de')
                            {
                                $email_content = $globalHeader['header'];
                                $whatsapp_content = $globalHeader['header'];
                                $whatsapp_content .= "\r\n";

                                $email_content .= $recipients_template->$rolename->email_content_de;
                                $whatsapp_content .= $recipients_template->$rolename->sms_content_de;
                                $email_subject = $recipients_template->$rolename->subject;

                                $whatsapp_content .= "\r\n";
                                $email_content .= $globalHeader['footer'];
                                $whatsapp_content .= $globalHeader['footer'];
                            }
                            elseif($locale == 'pl')
                            {
                                $email_content = $globalHeader['header'];
                                $whatsapp_content = $globalHeader['header'];
                                $whatsapp_content .= "\r\n";

                                $email_content .= $recipients_template->$rolename->email_content_pl;
                                $whatsapp_content .= $recipients_template->$rolename->sms_content_pl;
                                $email_subject = $recipients_template->$rolename->subject;

                                $whatsapp_content .= "\r\n";
                                $email_content .= $globalHeader['footer'];
                                $whatsapp_content .= $globalHeader['footer'];
                            }
                            else
                            {
                                $email_content = $globalHeader['header'];
                                $whatsapp_content = $globalHeader['header'];
                                $whatsapp_content .= "\r\n";

                                $email_content .= $recipients_template->$rolename->email_content;
                                $whatsapp_content .= $recipients_template->$rolename->sms_content;
                                $email_subject = $recipients_template->$rolename->subject;

                                $whatsapp_content .= "\r\n";
                                $email_content .= $globalHeader['footer'];
                                $whatsapp_content .= $globalHeader['footer'];
                            }
                            $email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
                            $whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
                            $name = $event->user['first_name'].' '.$event->user['last_name'];
                            
                            $email_content = str_replace("[user]", $name, $email_content);
                            $email_content = str_replace("[email]", $event->user['email'], $email_content);
                            $email_content = str_replace("[phone]", (substr(trim($event->user['phone']),0,1) != '+' ? '+' : '').$event->user['phone'], $email_content);
    
                            $allroles = array();
                            if(Roles::where('name', $role->name)->exists())
                            {
                                $allroles[] = $role->name;
                            }
                            $users = User::role(@$allroles)->get();
                            foreach ($users as $rolesmail) 
                            {
                                if($recipients_template->$rolename->email_content != '')
                                {
                                 if(isset($rolesmail->email))
                                  {
                                    $titles = $user->gender == 0 ? 'King':'Queen';
                                    $email_content = str_replace("[title]", $titles, $email_content);
                                    $whatsapp_content = str_replace("[title]", $titles, $whatsapp_content);
                                    if($role->name == 'seller')
                                    {
                                        $sellertrust = Seller::where('user_id',$rolesmail->id)->first();
                                        $levels = @$sellertrust->trust_level == '' ? '1' : @$sellertrust->trust_level;
                                        $email_content = str_replace("[level]", 'level '.$levels, $email_content);
                                        $whatsapp_content = str_replace("[level]", $levels, $whatsapp_content);
                                    }
                                    elseif($role->name == 'buyer')
                                    {
                                        $buyertrust = Buyer::where('user_id',$rolesmail->id)->first();
                                        $levels = @$buyertrust->trust_level == '' ? '1' : @$buyertrust->trust_level;
                                        $email_content = str_replace("[level]", 'level '.$levels, $email_content);
                                        $whatsapp_content = str_replace("[level]", $levels, $whatsapp_content);
                                    }
                                    else
                                    { 
                                        $email_content = str_replace("[level]", 'level 1', $email_content);
                                        $email_content = str_replace("[role]", $rolename, $email_content);
                                        $whatsapp_content = str_replace("[level]", 'level 1', $whatsapp_content);
                                    }
                                    $email_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $email_content);
                                  
    
                                    Mail::send('backend.mail.default', ['name' => 'User Created', 'body' => $email_content], function ($message) use ($rolesmail,$email_subject) {
                                        $message->subject($email_subject);
                                        if($rolesmail->email != '')
                                        {
                                            $message->to($rolesmail->email); 
                                        }
                                    });
                                }
                                $whatsapp_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $whatsapp_content);
                                $whatsapp_content = str_replace("[role]", $role->name, $whatsapp_content);
                                $whatsapp_content = str_replace("[user]", $event->user['first_name'].' '.$event->user['last_name'] , $whatsapp_content);

                                $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
            
                                $whatsapp_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $whatsapp_content);

                                SendWhatsapp(['phone' => $rolesmail->phone ,'body' => $whatsapp_content,'is_PDF'=>false]);
                            }
                          }
                        }
                    }
                }
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('User '.$event->user->full_name.' Updated at '.$event->user->updated_at. ' by '.auth()->user()->full_name.' (#'.auth()->user()->id.')');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('User '.$event->user->full_name.' Deleted at '.$event->user->updated_at. ' by '.auth()->user()->full_name.' (#'.auth()->user()->id.')');
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('User '.$event->user->full_name.' Confirmed at '.$event->user->updated_at);
    }

    /**
     * @param $event
     */
    public function onUnconfirmed($event)
    {
        \Log::info('User '.$event->user->full_name.' Unconfirmed at '.$event->user->updated_at);
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        \Log::info('User '.$event->user->full_name.' Password Changed at '.$event->user->updated_at. ' by '.auth()->user()->full_name.' (#'.auth()->user()->id.')');
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        \Log::info('User Deactivated');
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        \Log::info('User Reactivated');
    }

    /**
     * @param $event
     */
    public function onSocialDeleted($event)
    {
        \Log::info('User Social Deleted');
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info('User Permanently Deleted');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info('User Restored');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Auth\User\UserCreated::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserUpdated::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserDeleted::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserConfirmed::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onConfirmed'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserUnconfirmed::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onUnconfirmed'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserPasswordChanged::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onPasswordChanged'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserDeactivated::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onDeactivated'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserReactivated::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onReactivated'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserSocialDeleted::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onSocialDeleted'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserPermanentlyDeleted::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Auth\User\UserRestored::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@onRestored'
        );

        $events->listen(
            \App\jobs\UserCreated::class,
            'App\Listeners\Backend\Auth\User\UserEventListener@UserCreated'
        );
    }
}