<?php

namespace App\Mail\Frontend\Register;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Roles;
use Mail;
use App\Models\Auth\User;
use App\Buyer;
use App\Seller;

class Register_email extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public $request, $buyer_seller, $email_template;
  public function __construct($data, $buyer_seller, $email_template)
  {
      $this->request = $data;
      $this->buyer_seller = $buyer_seller;
      $this->email_template = $email_template;
  }
  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $email_buyer_seller = '';
    $name = $this->request->first_name.' '.$this->request->last_name;
    $email_template = $this->email_template;
    
    if(!empty($email_template))
    {
      $title = 'King';
      $email_verification_link = '<a href="'.route('frontend.auth.account.confirm',$this->request->confirmation_code).'">'.\Lang::get('email.confirm_email').'</a>';
      $locale = \App::getLocale();
      $globalHeader = getHeaderFooter($email_template->id, $locale);
      if($this->request->hasRole('seller'))
      {
        if($locale == 'pl')
        {
          $email_content = $globalHeader['header'];
          
          $email_content .= $email_template->email_content_pl;
          
          $email_content .= $globalHeader['footer'];
        }
        elseif($locale == 'de')
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
      }
      if($this->request->hasRole('buyer'))
      {
        if($locale == 'pl')
        {
          $email_content = $globalHeader['header'];

          $email_content .= $email_template->buyer_email_content_pl;
          
          $email_content .= $globalHeader['footer'];
        }
        elseif($locale == 'de')
        {
          $email_content = $globalHeader['header'];

          $email_content .= $email_template->buyer_email_content_de;
          
          $email_content .= $globalHeader['footer'];
        }
        else
        {
          $email_content = $globalHeader['header'];

          $email_content .= $email_template->buyer_email_content;
          
          $email_content .= $globalHeader['footer'];
        }
      }
      $prefered_method = array();
      if($this->buyer_seller->contact_sms==1)
      {
        $prefered_method[] = "SMS";
      }
      if($this->buyer_seller->contact_email==1)
      {
        $prefered_method[] = "Email";
      }
      if($this->buyer_seller->contact_whatsapp==1)
      {
        $prefered_method[] = "WhatsApp";
      }
      if($locale == 'pl')
      {
        $product_name_column = 'name_pl';
      }
      elseif($locale == 'de')
      {
        $product_name_column = 'name_de';
      }
      else
      {
        $product_name_column = 'name';
      }
      $product_name = \App\Product::where('id',$this->buyer_seller->product_id)->first()[$product_name_column];
      if($this->request->hasRole('seller') && in_array('1001', explode(',',$email_template->recipients)) || $this->request->hasRole('buyer') && in_array('1002', explode(',',$email_template->recipients)))
      {
        $email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
        $email_content = str_replace("[title]", 'King', $email_content);
        $email_content = str_replace("[level]", 'level 1', $email_content);
        if($this->request->hasRole('seller'))
        {
          $email_content = str_replace("[role]", 'seller', $email_content);          
        }
        if($this->request->hasRole('buyer'))
        {
          $email_content = str_replace("[role]", 'buyer', $email_content);
        }
        $email_content = str_replace("[recipient]", $this->request->full_name, $email_content);
        $email_content = str_replace("[product_name]", $product_name, $email_content);
        $email_content = str_replace("[product_sub_type]", $this->buyer_seller->product_sub_type, $email_content);
        $email_content = str_replace("[name]", ucfirst($this->request->name), $email_content);
        $email_content = str_replace("[first_name]", $this->request->first_name, $email_content);
        $email_content = str_replace("[email]", $this->request->email, $email_content);
        $email_content = str_replace("[phone]", (substr(trim($this->request->phone),0,1) != '+' ? '+' : '').$this->request->phone, $email_content);
        $email_content = str_replace("[contact_preferred_method]", implode(', ',$prefered_method), $email_content);
        $email_content = str_replace("[notes]", $this->buyer_seller->note, $email_content);
        $email_content = str_replace("[verification_link]", $email_verification_link, $email_content);
        $email_content = str_replace("[english_phone_number]", \Lang::get('inner-content.frontend.contactsec.phone-2'), $email_content);
        $email_buyer_seller=$email_template->title;
      }
      $this->to($this->request->email, $name )
        ->view('frontend.mail.buyer_register_email',['user'=>$this->request, 'email_content' => @$email_content,'email_buyer_seller'=>$email_buyer_seller, 'uuid'=>$this->request->uuid ])
        ->subject($email_template->subject)
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->replyTo(config('mail.from.address'), config('mail.from.name'));
    
    }

    if($this->request->hasRole('seller'))
    {
      $sms_content = get_email_template('SELLER REGISTER');
      $email_template = get_email_template('SELLER REGISTER');
      \App\EmailTemplate::where('title', 'SELLER REGISTER')->increment('sent');     
    }
    elseif($this->request->hasRole('buyer'))
    {
      if($this->buyer_seller->from_buyerlead==1)
      {
        $sms_content = get_email_template('BUYER SHORT REGISTER');
        $email_template = get_email_template('BUYER SHORT REGISTER');
        \App\EmailTemplate::where('title', 'BUYER SHORT REGISTER')->increment('sent');
      }
      else
      {
        $sms_content = get_email_template('BUYER REGISTER');
        $email_template = get_email_template('BUYER REGISTER');
        \App\EmailTemplate::where('title', 'BUYER REGISTER')->increment('sent');
      }
    }

    if(isset($email_template->roles_content))
    {
      $roles = Roles::get();
      $globalHeader = getHeaderFooter($email_template->id, $locale);
      $recipients_template = json_decode($email_template->roles_content);
      foreach($roles as $role)
      {
        $rolename = $role->name;
        if( in_array($role->id ,explode(',',$email_template->recipients)) )
        {
          $allroles = array();
          if(Roles::where('name', $role->name)->exists())
          {
            $allroles[] = $role->name;
          }
          $users = User::role(@$allroles)->get();
          
          foreach ($users as $rolesmail) 
          {
            if(isset($rolesmail->email))
            {
              $titles = $rolesmail->gender == 0 ? 'King':'Queen';
              $email_subject = $recipients_template->$rolename->subject;
              if($locale == 'de')
              {
                $email_content = $globalHeader['header'];
                $sms_content = $globalHeader['header'];
                $sms_content .= "\r\n";
          
                $email_content .= $recipients_template->$rolename->email_content_de;
                $sms_content .= $recipients_template->$rolename->sms_content_de;
                
                $sms_content .= "\r\n";
                $email_content .= $globalHeader['footer'];
					      $sms_content .= $globalHeader['footer'];
              }
              elseif($locale == 'pl')
              {
                $email_content = $globalHeader['header'];
                $sms_content = $globalHeader['header'];
                $sms_content .= "\r\n";

                $email_content .= $recipients_template->$rolename->email_content_pl;
                $sms_content .= $recipients_template->$rolename->sms_content_pl;
                
                $sms_content .= "\r\n";
                $email_content .= $globalHeader['footer'];
					      $sms_content .= $globalHeader['footer'];
              }
              else
              {
                $email_content = $globalHeader['header'];
                $sms_content = $globalHeader['header'];
                $sms_content .= "\r\n";

                $email_content .= $recipients_template->$rolename->email_content;
                $sms_content .= $recipients_template->$rolename->sms_content;

                $sms_content .= "\r\n";
                $email_content .= $globalHeader['footer'];
					      $sms_content .= $globalHeader['footer'];
              }

              $sms_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $sms_content);
              $sms_content = str_replace("[role]", $role->name, $sms_content);
              $sms_content = str_replace("[title]", $titles, $sms_content);
              $email_content = str_replace("[title]", $titles, $email_content);
              $email_content = str_replace("[role]", $role->name, $email_content);
              $email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
              
              $email_content = str_replace("[unsubscribe]", "", $email_content);
              if($rolesmail->email_subscription){  
                \Mail::to($rolesmail->email, $rolesmail->first_name.' '.$rolesmail->last_name)->send(new \App\Mail\Frontend\Register\RegistrationNotificationToTeam($this->request,$rolesmail,$this->buyer_seller, $email_content, $email_subject));  
              }
              
              if($role->name == 'seller')
              {
                $sellertrust = Seller::where('user_id',$rolesmail->id)->get();
                $levels = $sellertrust->trust_level == '' ? 'level 1' : 'level '.$sellertrust->trust_level;
                $sms_content = str_replace("[env]", $levels, $sms_content);
              }
              elseif($role->name == 'buyer')
              {
                $buyertrust = Buyer::where('user_id',$rolesmail->id)->get();
                $levels = $buyertrust->trust_level == '' ? 'level 1' : 'level '.$buyertrust->trust_level;
                $sms_content = str_replace("[level]", $levels, $sms_content);
              }
              else
              {
                $sms_content = str_replace("[level]", 'level 1', $sms_content);
              }
              
              $product_name_column = (($locale == 'pl') ? 'name_pl' : 'name');
              $product_name = \App\Product::where('id',@$this->buyer_seller->product_id)->first()[$product_name_column];
              $sms_content = str_replace("[team_member_name]", $rolesmail->first_name.' '.$rolesmail->last_name, $sms_content);
              $sms_content = str_replace("[product_name]", $product_name, $sms_content);
              $sms_content = str_replace("[product_sub_type]", @$this->buyer_seller->product_sub_type, $sms_content);
              if($role->name != 'buyer' || $role->name != 'seller')
              {
                $sms_content = str_replace("[name]", $rolesmail->name, $sms_content);
                $sms_content = str_replace("[email]", $rolesmail->email, $sms_content);
                $sms_content = str_replace("[phone]", (substr(trim($rolesmail->phone),0,1) != '+' ? '+' : '').$rolesmail->phone, $sms_content);
              }
              else
              {
                $sms_content = str_replace("[name]", '', $sms_content);
                $sms_content = str_replace("[email]", '', $sms_content);
                $sms_content = str_replace("[phone]", '', $sms_content);
              }
              
              if($this->request->hasRole('seller'))
              {
                $sms_content = str_replace("[view_seller_link]", route('admin.sellers.show',$this->buyer_seller->id), $sms_content);
              }
              elseif($this->request->hasRole('buyer'))
              {
                $sms_content = str_replace("[view_buyer_link]", route('admin.buyers.show',$this->buyer_seller->id), $sms_content); 
              }
            }
            $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $rolesmail->uuid);
            
            $sms_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $sms_content);
            
            $sms_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $sms_content);
            if($rolesmail->whatsapp_subscription){  
              SendWhatsapp(['phone' => $rolesmail->phone,'body' => $sms_content,'is_PDF'=>false]);
            }
          }
        }
      }
    }
  }
}
