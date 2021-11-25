<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

/**
 * Class NotificationController.
 */
class NotificationController extends Controller
{
    /**
     * @param $notification
     */
    public function registerNotifications()
    {
        $locale = \App::getLocale();
        $email_content = '';
        $email_content = 'King [username] [env] [role],';
        $whatsapp_content = 'King [username] [env] [role],';
        if(\Spatie\Permission\Models\Role::where('name','trader')->exists()){
            $roles[] = 'trader';
        }
        if(\Spatie\Permission\Models\Role::where('name','trader admin')->exists()){
            $roles[] = 'trader admin';
        }
        $newusers = \App\Models\Auth\User::where('account_status', '1')->get();
        $users = \App\Models\Auth\User::role(@$roles)->get();

        if($newusers){
            $email_template = '';
            foreach(@$newusers as $nuser){
                if($nuser->hasRole('seller')){
                    $buyer_seller = \App\Seller::where('user_id', $nuser->id)->first();
                    $buyer_seller->product_id = 1;
                    $buyer_seller->seller_id = $buyer_seller['id'];
                    $buyer_seller->product_sub_type = $buyer_seller['id'];
                    $email_template = get_email_template('SELLER REGISTER');
                }elseif($nuser->hasRole('buyer')){
                    $buyer_seller = \App\Buyer::where('user_id', $nuser->id)->get();
                    $buyer_seller->product_id = 1;
                    $buyer_seller->seller_id = $buyer_seller->id;
                    $buyer_seller->product_sub_type = $buyer_seller->id;
                    $email_template = get_email_template('BUYER REGISTER');
                }

                \App\Models\Auth\User::where('id', $nuser->id)->update(array('account_status' => '0'));
                foreach(@$users as $user){
                    if($user->email_subscription){
                        \Mail::to($user->email, $user->first_name.' '.$user->last_name)->send(new \App\Mail\Frontend\Register\RegistrationNotificationToTeam($nuser,$user,$buyer_seller, $email_template));
                    }

                    $email_content = '';
                    if($nuser->hasRole('seller')){                       
                        $email_template = get_email_template('SELLER REGISTER TO TEAM');
                        \App\EmailTemplate::where('title', 'SELLER REGISTER TO TEAM')->increment('sent');
                    }elseif ($nuser->hasRole('buyer')) {
                        $email_template = get_email_template('BUYER REGISTER TO TEAM');
                        \App\EmailTemplate::where('title', 'BUYER REGISTER TO TEAM')->increment('sent');
                    }
                    if($email_template){
                        if($nuser->hasRole('testuser')){
                            $msg_username = $nuser->name." ".live_dev_site_status();            
                        }else{
                            $msg_username = $nuser->name;
                        }
                        $msg_content = "Hi ".$msg_username.",";
            
                        if($locale == 'pl'){
                            $email_content .= $email_template->sms_content_pl;
                        }else{
                            $email_content .= $email_template->sms_content;
                        }
                        $product_name_column = (($locale == 'pl') ? 'name_pl' : 'name');
                        $product_name = \App\Product::where('id', 1)->first()[$product_name_column];
                        $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
                        $email_content = str_replace("[role]", 'seller', $email_content);
                        $email_content = $msg_content.str_replace("[team_member_name]", $user->name, $email_content);
                        $email_content = str_replace("[product_name]", $product_name, $email_content);
                        $email_content = str_replace("[product_sub_type]", '', $email_content);
                        $email_content = str_replace("[name]", ucfirst($nuser->name), $email_content);
                        $email_content = str_replace("[email]", $nuser->email, $email_content);
                        $email_content = str_replace("[phone]", (substr(trim($nuser->phone),0,1) != '+' ? '+' : '').$nuser->phone, $email_content);
                        $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
            
                        $email_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $email_content); 
                        if($nuser->hasRole('seller')){
                            $email_content = str_replace("[view_seller_link]", route('admin.sellers.show',$buyer_seller->id), $email_content);
                        }elseif($nuser->hasRole('buyer')){
                            $email_content = str_replace("[view_buyer_link]", route('admin.buyers.show',$buyer_seller->id), $email_content); 
                        }
                        if($user->whatsapp_subscription){
                        
                        SendWhatsapp(['phone' => (!empty(@$user->whatsapp_number)?$user->whatsapp_number:@$user->phone), 'body' => $email_content,'is_PDF'=>false]);

                        }
                        //SendSMS(@$user->sms_number,$email_content);
                    }else{
                        \Log::info('Email template does not exist ');         
                    }
                }
            }
        }
    }

}