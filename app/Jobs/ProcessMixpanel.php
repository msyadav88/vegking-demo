<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
// use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Mixpanel;

class ProcessMixpanel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $request;
    protected $user;
    public function __construct($user)
    {
        // $this->request = $request;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         // $request = $this->request;
         $user = $this->user;
         // dd($request);
            $mp = Mixpanel::getInstance(env('MIXPANEL_TOKEN'), array("debug" => true));

            // track an event
            $mp->track("button clicked", array("label" => ucfirst(request()->user_role)." Register")); 
            $mp->people->set($user->id, array(
                '$first_name'   => request()->name,
                '$last_name'    => "",
                'company_name'  => request()->company_name,
                '$email'        => request()->email,
                'phone'         => request()->country_code.request()->phone,
                '$created'      => date('Y-m-d H:i:s')    
            ));
        \Log::info('ProcessMixpanel handle:');
    }
}
