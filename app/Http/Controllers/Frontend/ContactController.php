<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\Contact\SendContact;
use App\Http\Requests\Frontend\Contact\SendContactRequest;
use App\Mail\Frontend\Contact\BuyerleadNotificationToTeam;
use App\Buyercontact;
use App\Buyerform;
use App\LanguageContent;
use App\Buyerlead;
use App\Contact;
use Illuminate\Http\Request;
use DB;
/**
 * Class ContactController.
 */
class ContactController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $LanguageContent = LanguageContent::where('id',1)->first();
        return view('frontend.contact', compact('LanguageContent'));
    }
    public function buyercontact(Request $request)
    {
        return view('frontend.buyercontact');
    }
	
	public function buyerform(Request $request)
    {
        return view('frontend.buyerform');
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function buyercontact_send(Request $request)
    {
         /*$request->validate([
            //'name' => 'required',
            //'email'=>'required|email',
            //'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            // 'product_id' => 'required',
         ]);*/
        // $prefered_method = array();
        // foreach($request->prefered_method as $key=>$val){
        //     if($val=='Yes'){
        //        $prefered_method[] = $key;
        //     }
        // }
        //  $request->prefered_method = implode(',',$prefered_method);
        
        if(!empty($request->email) && $request->current_step==1){
            $request->validate([
                'email'=>'required|email|unique:users|unique:buyers',
            ]);
            $buyercontact = Buyerlead::updateOrCreate(['email' => $request->email]);
            //print_r($buyercontact->toArray());exit;
            if($buyercontact->wasRecentlyCreated==1) {
                $request['view_buyerlead_link'] = url('')."?buynew=0&email=".$request->email;
                $locale = \App::getLocale();
                // echo 'dfd'.$locale;exit;
                $email_content = '';
                if($request->user_role == 'buyer'){
                    $email_template = get_email_template('BUYER SHORT REGISTER STEP1');
                    \App\EmailTemplate::where('title', 'BUYER SHORT REGISTER STEP1')->increment('sent');
                }

                if($email_template){                    
                    if($request->email_subscription){           
                        \Mail::to($request->email)->send(new \App\Mail\Frontend\Contact\BuyerShortRegisterStep1($request,$email_template));
                    }
                    
                    if($locale == 'pl'){
                       $email_content = $email_template->sms_content_pl;
                    }else if($locale == 'de'){
                       $email_content = $email_template->sms_content_de;
                    }else{
                        $email_content = $email_template->sms_content;
                    }
                        
                    $email_content = str_replace("[email]", $request->email, $email_content);               
                    $email_content = str_replace("[buyerlead_step1_link]", $request->view_buyerlead_link, $email_content);
                    //SendWhatsapp(['phone' => @$whatsapp_number, 'body' => $email_content,'is_PDF'=>false]);
                    //SendSMS(@$sms_number,$email_content);
                }else{
                   \Log::info('Email template BUYER SHORT REGISTER STEP1 does not exist');         
                }

                if(\Spatie\Permission\Models\Role::where('name','trader')->exists()){
                 $roles[] = 'trader';
                }
                if(\Spatie\Permission\Models\Role::where('name','trader admin')->exists()){
                    $roles[] = 'trader admin';
                }
                $users = \App\Models\Auth\User::role(@$roles)->get();
                foreach(@$users as $user){
                    $email_content = '';
                    if($request->user_role == 'buyer'){
                        $email_template = get_email_template('BUYER SHORT REGISTER STEP1 TO TEAM');
                        \App\EmailTemplate::where('title', 'BUYER SHORT REGISTER STEP1 TO TEAM')->increment('sent');
                    }
                    if($email_template){

                        if($user->hasRole('testuser')){
                          $msg_username = $user->name." ".live_dev_site_status();            
                        }else{
                          $msg_username = $user->name;
                        }
                        $msg_content = "Hi ".$msg_username.",";
                        if($user->email_subscription){
                            \Mail::to($user->email, $user->first_name.' '.$user->last_name)->send(new \App\Mail\Frontend\Contact\BuyerShortRegisterStep1ToTeam($request, $user, $email_template));    
                        }    
                        
                        if($locale == 'pl'){
                            $email_content = $email_template->sms_content_pl;
                        }else if($locale == 'de'){
                            $email_content = $email_template->sms_content_de;
                        }else{
                            $email_content = $email_template->sms_content;
                        }                    
                        $email_content = $msg_username.str_replace("[team_member_name]", $user->name, $email_content);
                        $email_content = str_replace("[email]", $request->email, $email_content);

                        //SendWhatsapp(['phone' => (!empty(@$user->whatsapp_number)?$user->whatsapp_number:@$user->phone), 'body' => $email_content,'is_PDF'=>false]);
                        //SendSMS(@$user->sms_number,$email_content);
                    }else{
                        \Log::info('Email template BUYER SHORT REGISTER STEP1 TO TEAM does not exist ');         
                    }
                }
            }            
            return response()->json(['status'=>'success','current_step'=>$request->current_step,'buyerlead_id'=>$buyercontact->id]);
        }
        
        if(!empty($request->phone) && $request->current_step==2){
            $request['phone'] = $request->country_code.$request->phone;
            $request->validate([
                'email'=>'required|email|unique:users|unique:buyers',
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|unique:users|unique:buyers',
            ]);
            //Buyerlead::where('id', $request->buyerlead_id)->update(['phone' => $request->country_code.$request->phone]);
            $buyerlead = Buyerlead::where([['id',$request->buyerlead_id], ['email',$request->email]])->first();
            //print_r($buyerlead);exit;
            if(empty($buyerlead->phone)){
                Buyerlead::where('id', $request->buyerlead_id)->update(['phone' => $request->phone]);
                
                $locale = \App::getLocale();

                $request['view_buyerlead_link'] = url('')."?buynew=0&email=".$request->email."&phone=".$request->phone;
                // echo 'dfd'.$locale;exit;
                $email_content = '';
                if($request->user_role == 'buyer'){
                    $email_template = get_email_template('BUYER SHORT REGISTER STEP2');
                    \App\EmailTemplate::where('title', 'BUYER SHORT REGISTER STEP2')->increment('sent');
                }
                if($email_template){
                    if($request->email_subscription){
                        \Mail::to($request->email)->send(new \App\Mail\Frontend\Contact\BuyerShortRegisterStep2($request,$email_template));    
                    }
                    
                    
                    if($locale == 'pl'){
                       $email_content = $email_template->sms_content_pl;
                    }else if($locale == 'de'){
                       $email_content = $email_template->sms_content_de;
                    }else{
                        $email_content = $email_template->sms_content;
                    }
                        
                    $email_content = str_replace("[email]", $request->email, $email_content);
                    $email_content = str_replace("[phone]", (substr(trim($request->phone),0,1) != '+' ? '+' : '').$request->phone, $email_content);
                    $email_content = str_replace("[buyerlead_step2_link]", $request->view_buyerlead_link, $email_content);


                    //SendWhatsapp(['phone' => @$whatsapp_number, 'body' => $email_content,'is_PDF'=>false]);
                    //SendSMS(@$sms_number,$email_content);
                }else{
                   \Log::info('Email template BUYER SHORT REGISTER STEP2 does not exist');         
                }

                if(\Spatie\Permission\Models\Role::where('name','trader')->exists()){
                 $roles[] = 'trader';
                }
                if(\Spatie\Permission\Models\Role::where('name','trader admin')->exists()){
                    $roles[] = 'trader admin';
                }
                $users = \App\Models\Auth\User::role(@$roles)->get();
                foreach(@$users as $user){
                    $email_content = '';
                    if($request->user_role == 'buyer'){
                        $email_template = get_email_template('BUYER SHORT REGISTER STEP2 TO TEAM');
                        \App\EmailTemplate::where('title', 'BUYER SHORT REGISTER STEP2 TO TEAM')->increment('sent');
                    }
                    if($email_template){
                        if($user->hasRole('testuser')){
                          $msg_username = $user->name." ".live_dev_site_status();            
                        }else{
                          $msg_username = $user->name;
                        }
                        $msg_content = "Hi ".$msg_username.",";
                        if($user->email_subscription){
                            \Mail::to($user->email, $user->first_name.' '.$user->last_name)->send(new \App\Mail\Frontend\Contact\BuyerShortRegisterStep2ToTeam($request, $user, $email_template));
                            
                        }   
                        if($locale == 'pl'){
                            $email_content = $email_template->sms_content_pl;
                        }else if($locale == 'de'){
                            $email_content = $email_template->sms_content_de;
                        }else{
                            $email_content = $email_template->sms_content;
                        }                    
                        $email_content = $msg_content.str_replace("[team_member_name]", $user->name, $email_content);
                        $email_content = str_replace("[email]", $request->email, $email_content);
                        $email_content = str_replace("[phone]", (substr(trim($request->phone),0,1) != '+' ? '+' : '').$request->phone, $email_content);

                        //SendWhatsapp(['phone' => (!empty(@$user->whatsapp_number)?$user->whatsapp_number:@$user->phone), 'body' => $email_content,'is_PDF'=>false]);
                        //SendSMS(@$user->sms_number,$email_content);
                      }else{
                        \Log::info('Email template BUYER SHORT REGISTER STEP2 TO TEAM does not exist ');         
                      }
                }
            
            }else{
                if($buyerlead->phone == $request->phone){
                    //echo "return customer";exit;
                }else{
                    $current_step = 2;
                    return response()->json(['status'=>'error','message'=>'Email already exist with different phone: '.$buyerlead->phone,'current_step'=>$current_step,'buyerlead_id'=>$request->buyerlead_id],422);
                }
            }
            
            
            
            //$buyercontact = Buyerlead::updateOrCreate(['email' => $request->email, 'phone' => $request->phone]);
            //print_r($buyercontact->toArray());exit;
            
            
            return response()->json(['status'=>'success','current_step'=>$request->current_step,'buyerlead_id'=>$request->buyerlead_id]);
        }
        
        if($request->current_step==3){
            // $request->validate([
            //     'password' => 'required',
            //   ]);
            Buyerlead::where('id',$request->buyerlead_id)->delete();
           
            return response()->json(['status'=>'success','message'=>'Great! We will call you and send you a great offer!']);
        }
        return response()->json(['status'=>'success','message'=>'Great! We will call you and send you a great offer!']);
    }
    public function buyercontact_verification($token)
    {
      // echo 'dfd';exit;
      // dd($request->toArray());
         $buyercontact = Buyerlead::where('email_verification_code',$token)->first();
         if($buyercontact->email_verified == true){
            $message = '';
         }elseif($buyercontact){
            $buyercontact->email_verified_at = DB::raw('NOW()');
            $buyercontact->save();
            $message = 'Your email has been verified successfully';
         }else{
            $message = 'Your email verification code mismatch. Please contact support';
         }
         return view('frontend.buyercontact-verification',compact(['message']));
    }
    public function send(SendContactRequest $request)
    {
        //if($request->email_subscription){
            Mail::send(new SendContact($request));    
            return response()->json(['status' => 'success', 'message' => 'Contact successfully.']);
        //}
        //else{
        //    return response()->json(['status' => 'false', 'message' => 'Emails ar unsubscribe.']);
        //}

       
    }
    public function contact_send(Request $request)
    {
        $contact_data =[
                    'name'=> $request['name'],
                    'company' => $request['company'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'message'  => $request['message'],
                  ];
        $response = Contact::create($contact_data);

        if($response){
            return response()->json(['status' => 'success', 'message' => 'Thank you for contacting us. We will call you back shortly.']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Some error occured. please try later']);
        }
    }
}