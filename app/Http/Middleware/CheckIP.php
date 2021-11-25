<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
// use Torann\GeoIP\Location;
use Illuminate\Support\Facades\URL;

class CheckIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $position = \Location::get($request->getClientIp());
   
        $visitor = Visitor::firstOrNew(["ip"=>$request->getClientIp(), 'user_id'=>null]);
        $visitor->city = @$position->cityName;
        $visitor->did_logn =false;
        $visitor->country = @$position->countryName;
        $visitor->post_code = @$position->zipCode;
        $visitor->latitude = @$position->latitude;
        $visitor->longitude = @$position->longitude;
        $visitor->save();
        return $next($request);
    }
}