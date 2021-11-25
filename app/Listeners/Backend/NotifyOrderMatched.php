<?php

namespace App\Listeners\Backend;

use App\Events\Backend\OrderMatched;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Stock;
class NotifyOrderMatched
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
     * @param  OrderMatched  $event
     * @return void
     */
    public function handle(OrderMatched $event)
    {
      \Log::info('Order Updated on '.$event->order->created_at.' by '. auth()->user()->full_name);
      app('App\Http\Controllers\Backend\MatchsController')->matchOrderAPI($event->order);
    }
}
