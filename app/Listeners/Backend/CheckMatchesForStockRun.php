<?php

namespace App\Listeners\Backend;

use App\Events\Backend\StockUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckMatchesForStockRun
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
     * @param  CheckMatchesForStock  $event
     * @return void
     */
    public function handle(StockUpdated $event)
    {
      //\Log::info('Stock Updated on '.$event->stock->updated_at.' by '. auth()->user()->full_name);
      app('App\Http\Controllers\Backend\MatchsController')->CheckMatchesForStockId($event->stock);
    }
}
