<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use Cookie;
/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Sets third party service providers that are only needed on local/testing environments
        if ($this->app->environment() !== 'production') {
            /**
             * Loader for registering facades.
             */
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            // Load third party local aliases
            $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
            $this->app->register(DuskServiceProvider::class);
            
        }

        if(!$this->app->environment('local')) {
            \URL::forceScheme('https');
        }        
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        /*
         * Application locale defaults for various components
         *
         * These will be overridden by LocaleMiddleware if the session local is set
         */

        // setLocale for php. Enables ->formatLocalized() with localized values for dates
        setlocale(LC_TIME, config('app.locale_php')); 

        if(Cookie::get('language') !== null){      
            // print_r(Cookie::get('language'));exit;
            $encrypter = app(\Illuminate\Contracts\Encryption\Encrypter::class);
            $cookie_value = $encrypter->decrypt(Cookie::get('language'),false);
            if (array_key_exists($cookie_value, config('locale.languages'))) {
                config(['app.locale'=>$cookie_value]);                
            }
        }else{
            // $ip = Cookie::get('IP');
            $ip = request()->ip();
                // \Log::info('IP is : '.request()->ip().' on url '.url()->full());         

            // echo '***'.request()->getClientIp();exit;
            // $ip = '79.184.34.79';
            $location_detail = \Location::get($ip);
            // dd(config('app.locale'));

            // setLocale to use Carbon source locales. Enables diffForHumans() localized
            if(@$location_detail->countryName == 'poland' || @$location_detail->countryName == 'Poland' ){
                if (array_key_exists('pl', config('locale.languages'))) { 
                    Cookie::queue('language', 'pl', 2628000);
                    config(['app.locale'=>'pl']);                                        
                    // Carbon::setLocale('pl');
                }
            }elseif(@$location_detail->countryName == 'germany' || @$location_detail->countryName == 'Germany'){
                if (array_key_exists('de', config('locale.languages'))) {
                    Cookie::queue('language', 'de', 2628000);
                    config(['app.locale'=>'de']);                    
                    // Carbon::setLocale('de');
                }
            }else{ 
                if (array_key_exists('en', config('locale.languages'))) { 
                    Cookie::queue('language', 'en', 2628000);
                    config(['app.locale'=>'en']);                    
                    //Carbon::setLocale('en');
                }
            }
        }
        /*
         * Set the session variable for whether or not the app is using RTL support
         * For use in the blade directive in BladeServiceProvider
         */
        if (! app()->runningInConsole()) {
            if (config('locale.languages')[config('app.locale')][2]) {
                session(['lang-rtl' => true]);
            } else {
                session()->forget('lang-rtl');
            }
        }

        // Force SSL in production
        /*if ($this->app->environment() === 'production') {
            URL::forceScheme('https');
        }*/

        // Set the default string length for Laravel5.4
        // https://laravel-news.com/laravel-5-4-key-too-long-error
        Schema::defaultStringLength(191);

        // Set the default template for Pagination to use the included Bootstrap 4 template
        \Illuminate\Pagination\AbstractPaginator::defaultView('pagination::bootstrap-4');
        \Illuminate\Pagination\AbstractPaginator::defaultSimpleView('pagination::simple-bootstrap-4');

        // Custom Blade Directives

        /*
         * The block of code inside this directive indicates
         * the project is currently running in demo mode.
         */
        Blade::if('demo', function () {
            return config('app.demo');
        });

        /*
         * The block of code inside this directive indicates
         * the chosen language requests RTL support.
         */
        Blade::if('langrtl', function ($session_identifier = 'lang-rtl') {
            return session()->has($session_identifier);
        });
    }
}
