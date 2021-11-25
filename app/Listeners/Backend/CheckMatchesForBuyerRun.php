<?php

namespace App\Listeners\Backend;

// use App\Events\Backend\BuyerCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckMatchesForBuyerRun
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckMatchesForBuyer  $event
     * @return void
     */
    public function handle($event)
    {
        //\Log::info('Buyer Updated on '.$event->buyer->updated_at.' by '. auth()->user()->full_name);
        app('App\Http\Controllers\Backend\MatchsController')->CheckMatchesForBuyerPrefId((@$event->buyer_pref ? $event->buyer_pref : $event->buyer));
    }
}
