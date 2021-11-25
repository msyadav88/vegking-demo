<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StockUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $stockId;
    public function __construct($stockId)
    {
        $this->stockId = $stockId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         \Log::info('StockUpdated Job start: ');
         $stock = \App\Stock::with('offerProperty.productSpecValue')->where('id',$this->stockId)->first();
         event(new \App\Events\Backend\StockUpdated($stock));
         \Log::info('StockUpdated Job end: ');
    }
}
