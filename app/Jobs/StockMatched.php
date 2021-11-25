<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Backend\MatchsController;
use App\Repositories\Backend\Auth\UserRepository;


class StockMatched implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $seller,$buyer,$stock,$pref,$match;
    public function __construct($seller,$buyer,$stock,$pref,$match)
    {
        $this->seller = $seller;
        $this->buyer = $buyer;
        $this->stock = $stock;
        $this->pref=$pref;
        $this->match=$match;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepository $userRepository)
    {
        \Log::info('Stock Matched Job start: ');
        $this->stockmatched = new MatchsController($userRepository);
        $this->stockmatched->stockmatched($this->seller,$this->buyer,$this->stock,$this->pref,$this->match);
        \Log::info('Stock Matched Job end: ');
    }
}
