<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\Auth\SocialiteHelper;
use App\Http\Requests\RegisterRequest;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Validation\Rule;
use App\BuyerPref;
use Illuminate\Support\Facades\DB;
use DateTime;
use Mixpanel;
use App\Jobs\ProcessMixpanel;
use Illuminate\Http\Request;
use App\Models\Auth\User;
/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        abort_unless(config('access.registration'), 404);

        return view('frontend.auth.register')
            ->withSocialiteLinks((new SocialiteHelper)->getSocialLinks());
    }

    /**
     * @param RegisterRequest $request
     *
     * @throws \Throwable
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {
        // check if reCaptcha has been validated by Google
     
     
   
     
       abort_unless(config('access.registration'), 404);
        $request['phone'] = $request->country_code.$request->phone;
        if($request->phonesame!=1){
            $request['whatsapp_number'] = $request->country_code_whatsapp.$request->phonewhatsapp;
        }else{
            $request['whatsapp_number'] = $request->country_code.$request->phone;
        }
        
        $request['username'] = $request->name;
        $request['first_name'] = strtok( $request->name, ' ' );
        $request['last_name'] = strtok( '' ); 
        $request['company_name'] = $request->company_name;
        
        $request->validate([
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|unique:users|unique:'.$request->user_role.'s',
            'name'=> 'required|string',
            'company_name' => 'required|string',
            'username' => ['required', 'string', 'max:191'],
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $request['user_code'] = strtok( $request->name, ' ' );
        
        if($request->user_role == 'seller')
        {
            $request['sms_number'] = $request->country_code_sms.$request->sms_number;
    
        }
        $user = $this->userRepository->create($request->only('first_name', 'last_name', 'email','country_code', 'phone','company_name', 'password','whatsapp_number','sms_number'));
        
        ProcessMixpanel::dispatch($user);

        $buyer_seller_array['user_id'] = $user->id;
        $buyer_seller_array['username'] = $user->full_name;
        $buyer_seller_array['phone'] = $user->phone;
        $buyer_seller_array['email'] = $user->email;
        $buyer_seller_array['contact_email'] = (@$request->contact_email ? 1 : 0);
        $buyer_seller_array['contact_sms'] = (@$request->contact_sms ? 1 : 0);
        $buyer_seller_array['contact_whatsapp'] = (@$request->contact_whatsapp ? 1 : 0);
        $buyer_seller_array['note'] = $request->notes;

        if($request->user_role == 'seller')
        {
            $user->assignRole('seller');
            $buyer_seller = \App\Seller::create($buyer_seller_array);
            $buyer_seller['seller_id'] = $buyer_seller->id;
        }
        elseif($request->user_role == 'buyer') 
        {
            $user->assignRole('buyer');
            $buyer_seller_array['name'] = $user->full_name;
            $buyer_seller = \App\Buyer::create($buyer_seller_array);
            $buyer_seller['product_id'] = $request->product_id;
            $buyer_seller['product_sub_type'] = $request->product_sub_type;
            $buyer_seller['buyer_id'] = $buyer_seller->id;
            $buyer_seller['from_buyerlead'] = ($request->from_buyerlead ? $request->from_buyerlead : 0);

            $buyer_Array['buyer_id'] = $buyer_seller->id;
            $buyer_Array['product_id'] = $request->product_id;
            $products_data =[
                'buyer_id'=>$buyer_Array['buyer_id'],
                'product_id' => $buyer_Array['product_id'],
            ];
            // $buyer_prefs_data = BuyerPref::create($products_data);
            /*$buyer_pref_id = $buyer_prefs_data->id;
            $buyerPP = BuyerProductPref::Create(['buyer_pref_id' => $buyer_pref_id,'key' => $buyer_Array['product_id'],'value' => 'all']);*/
        }
        
        DB::table('users')->where('first_name',strtok( $request->name, ' ' ))->update(['user_code'=>strtok( $request->name, ' ' ),'company_name'=> $request->company_name]);
        
        $users = DB::table('affiliate_data')->select('id','u_id','aff_code','user_code')->where('affiliate_data.user_code',strtok( $request->name, ' ' ))->get();
        $dt = new DateTime();
        
        if($users->count() == 0) 
        {
            $data = array('u_id'=>$user->id,'aff_code'=>'ac',"user_code"=>strtok( $request->name, ' ' ),'created_at' => $dt->format('Y-m-d H:i:s'),'updated_at'=> $dt->format('Y-m-d H:i:s'));
            DB::table('affiliate_data')->insert($data);
        }

        // If the user must confirm their email or their account requires approval,
        // create the account but don't log them in.
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) 
        {
            event(new UserRegistered($user,$buyer_seller));
            return redirect($this->redirectPath())->withFlashSuccess(
                config('access.users.requires_approval') ?
                    __('exceptions.frontend.auth.confirmation.created_pending') :
                    __('exceptions.frontend.auth.confirmation.created_confirm')
            );
        }
      
         
       $url = $_SERVER['HTTP_REFERER']; 
       $url = explode('=', $url);
        if (sizeof($url)>1)
        {
            $user_table=User::find($user->id);
            $user_table->push_token=$url[1];
            $user_table->save();
        }
    

        //event(new UserRegistered($user, $buyer_seller));
    
        \App\Jobs\UserRegistered::dispatch($user, $buyer_seller);
        \Log::info('after dispatch');
        auth()->login($user);
        if($request->ajax())
        {
            return response()->json(['status' => 'success']);
        }
        return redirect($this->redirectPath());
    }
}
