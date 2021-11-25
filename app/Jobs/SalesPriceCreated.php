<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Backend\SaleController;

class SalesPriceCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user, $saleid, $buyerid, $deliverydate, $stockid, $main_total;
    public function __construct($user, $saleid, $buyerid, $deliverydate, $stockid, $main_total)
    {
        $this->user = $user;
        $this->saleid = $saleid;
        $this->buyerid = $buyerid; 
        $this->deliverydate = $deliverydate; 
        $this->stockid = $stockid;
        $this->main_total = $main_total;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('Sales Created Price Job start: ');
        $this->saleEMail = new SaleController();
        $this->saleEMail->sendPriceList($this->user, $this->saleid, $this->buyerid, $this->deliverydate, $this->stockid, $this->main_total);
        \Log::info('Sales Updated Price Job end: ');
    }
}
