<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repositories\Backend\Auth\UserRepository;


class UserCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user,$event;
    public function __construct($user,$event)
    {
        $this->user = $user;
        $this->event =$event;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepository $userRepository)
    {
        \Log::info('User Created Job start: ');
        $this->useremail = new \App\Listeners\Backend\Auth\User\UserEventListener($userRepository);
        $this->useremail->UserCreated($this->event);
        \Log::info('User Created Job end: ');
    }
}
