<?php

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('home_route')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (auth()->check()) {
            if (auth()->user()->can('view backend')) {
                return 'admin.dashboard';
            }elseif(auth()->user()->roles->pluck( 'name' )->contains( 'seller' )){
                return 'seller.dashboard';
            }elseif(auth()->user()->roles->pluck( 'name' )->contains( 'buyer' )){
                return 'buyer.dashboard';
            }elseif(auth()->user()->roles->pluck( 'name' )->contains( 'trader' )){
                return 'trader.dashboard';
            }
            return 'frontend.user.dashboard';
        }

        return 'frontend.index';
    }
}

if (! function_exists('live_dev_site_status')) {
    /**
     * Return the site information according to live or dev in 1, 0 values.
    */
    
    function live_dev_site_status()
    {        
        $live_url = 'vegking.eu';        
        $current_url = $_SERVER['SERVER_NAME'];

        if('vegking.eu' == $current_url){
            $site_status = 'LTEST';
        }elseif('dev2.vegking.eu' == $current_url){
            $site_status = 'DTEST';
        }else{
            $site_status = 'STEST';
        }
        return $site_status;
    }
}
