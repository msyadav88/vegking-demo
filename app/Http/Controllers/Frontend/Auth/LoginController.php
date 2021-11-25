<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use App\Helpers\Auth\AuthHelper;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Helpers\Auth\SocialiteHelper;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Carbon\Carbon;
use App\UserIps;
use App\LanguageContent;
use Cookie;
use Auth;
use Mixpanel;
/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {
        $push_token='';
        if($request->userId)
        {
            $push_token=$request->userId;
        }
        $LanguageContent = LanguageContent::where('id',1)->first();
        return view('frontend.auth.login', compact('LanguageContent','push_token'))->withSocialiteLinks((new SocialiteHelper)->getSocialLinks());
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('access.users.username');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => ['required', 'min:6'],
        ]);
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @throws GeneralException
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
      
        $ip = Cookie::get('IP');
        $location_detail = \Location::get($ip);
        Cookie::queue('UserId', $user->id);

        $mp = Mixpanel::getInstance(env('MIXPANEL_TOKEN'), array("debug" => true));
        
        // track an event
        $mp->track("button clicked", array("label" => "Log In")); 

        // create/update a profile for user id 12345
        $mp->people->increment($user->id, "login count", 1);
        // track an event
        
        // create/update a profile for user id 12345
        $mp->people->set($user->id, array(
            '$first_name'   => $user->name,
            '$last_name'    => "",
            'company_name'  => $user->company_name,
            '$email'        => $user->email,
            'phone'         => $user->country_code.$user->phone,
            '$created'      => date('Y-m-d H:i:s')    
        ));
        // code for check userips

        $check_Userips = UserIps::where('ip',$ip)->where('UserId',$user->id)->orderBy('id', 'DESC')->first();
        $current_date =  \Carbon\Carbon::now()->toDateTimeString();
        if($check_Userips != ''){
        $after_2_hrs = $check_Userips->created_at->addHours(2)->toDateTimeString();
        
            if($after_2_hrs <= $current_date){
            $Userips = new UserIps;
            $Userips->userid = ($user->id != '') ? $user->id : null;
            $Userips->ip = $ip;
            $Userips->city = $location_detail->cityName;
            $Userips->country = $location_detail->countryName;
            $Userips->didlogin = (Auth::check() == false) ? 'No' : 'Yes';
            $Userips->cookie=json_encode(Cookie::get());
            $Userips->date = date('Y-m-d', strtotime($current_date));
            $Userips->time = date('h:i:s', strtotime($current_date));
            $Userips->save();
            }
        }else{
            $Userips = new UserIps;
            $Userips->userid = ($user->id != '') ? $user->id : null;
            $Userips->ip = $ip;
            $Userips->city = $location_detail->cityName;
            $Userips->country = $location_detail->countryName;
            $Userips->didlogin = (Auth::check() == false) ? 'No' : 'Yes';
            $Userips->cookie=json_encode(Cookie::get());
            $Userips->date = date('Y-m-d', strtotime($current_date));
            $Userips->time = date('h:i:s', strtotime($current_date));
            $Userips->save();
        }


        // Check to see if the users account is confirmed and active
        // if (! $user->isConfirmed()) {
        //     auth()->logout();

        //     // If the user is pending (account approval is on)
        //     if ($user->isPending()) {
        //         throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
        //     }

        //     // Otherwise see if they want to resent the confirmation e-mail

        //     throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', e($user->{$user->getUuidName()}))]));
        // }

        if (! $user->isActive()) {
            auth()->logout();

            throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
        }

        event(new UserLoggedIn($user));

        if (config('access.users.single_login')) {
            auth()->logoutOtherDevices($request->password);
        }

       /*if ($request->seller_route == 'seller_route') {
           return response()->json(['status' => 'success', 'message' => 'Login successfully.']);
       }*/
      
        if(auth()->user()->roles->pluck( 'name' )->contains( 'administrator' )){
           return redirect('/admin/dashboard');
        }else if(auth()->user()->roles->pluck( 'name' )->contains( 'seller' )){
            return redirect('/seller/dashboard');
        }else if(auth()->user()->roles->pluck( 'name' )->contains( 'buyer' )){
            return redirect('/buyer/dashboard');
        }else if(auth()->user()->roles->pluck( 'name' )->contains( 'trader' )){
           return redirect('/trader/dashboard');
        }else{
            return redirect()->intended($this->redirectPath());
        }
  
       
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Remove the socialite session variable if exists
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        // Remove any session data from backend
        resolve(AuthHelper::class)->flushTempSession();

        // Fire event, Log out user, Redirect
        event(new UserLoggedOut($request->user()));

        // Laravel specific logic
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        // If for some reason route is getting hit without someone already logged in
        if (! auth()->user()) {
            return redirect()->route('frontend.auth.login');
        }
        // If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            \Session::forget('roles');
            // Save admin id
            $admin_id = session()->get('admin_user_id');

            resolve(AuthHelper::class)->flushTempSession();

            // Re-login admin
            auth()->loginUsingId((int) $admin_id);

            // Redirect to backend user page
            return redirect()->route('admin.auth.user.index');
        }

        resolve(AuthHelper::class)->flushTempSession();

        auth()->logout();

        return redirect()->route('frontend.auth.login');
    }
}
