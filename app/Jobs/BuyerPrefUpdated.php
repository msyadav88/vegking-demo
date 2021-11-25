<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BuyerPrefUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $buyerPrefId;
    public function __construct($buyerPrefId)
    {
        $this->buyerPrefId = $buyerPrefId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         \Log::info('BuyerPrefUpdated Job start: ');
         $buyerPref = \App\BuyerPref::with(['buyer','productPrefs.productSpecValue'])->where('id',$this->buyerPrefId)->first();
         event(new \App\Events\Backend\BuyerPrefCreated($buyerPref));
         \Log::info('BuyerPrefUpdated Job end: ');
    }
}
