<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserRegistered implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user,$buyer_seller;
    public function __construct($user, $buyer_seller)
    {
        $this->user = $user;
        $this->buyer_seller = $buyer_seller;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         \Log::info('UserRegistered Job start: ');
         event(new \App\Events\Frontend\Auth\UserRegistered($this->user, $this->buyer_seller));
         \Log::info('UserRegistered Job end: ');
    }
}
