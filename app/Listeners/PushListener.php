<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Auth\User;
use App\Pushsounds;
use Illuminate\Http\Request;
class PushListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        
if($event->sound){
    if($event->sound==1){
        $sound="f8377f70-c4c1-419a-ada3-3dab056731a7";
        $ios_sound="sound_one.wav";
    }
    if($event->sound==2){
        $sound="7dd7dfc4-e290-4fac-979e-b3631bc41f89";
        $ios_sound="sound_two.wav";
    }
}else{
    $sound="f8377f70-c4c1-419a-ada3-3dab056731a7";
    $ios_sound="sound_one.wav";
}
 
       if($event->url)
       {
         $url=$event->url;
       }else{
         $url=url()->current();
       }
       $user=User::find($event->user_id); 
       if ($user->push_token) {
        $content= array(
         "en" => $event->message
          );
   
        $fields = array(
            'app_id' => "90053466-381d-46f7-8537-886fa4a7bbee",
            'include_player_ids' => array($user->push_token),
            'contents' => $content,
            'android_channel_id'=>$sound,
            'ios_sound'=>$ios_sound, 
            'url'=>$url,
        );

           $fields = json_encode($fields);
        
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
           curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ZDkzZDM5MTItYzE1YS00Y2YzLThhNmItNGVkOGQ1OWY2YTJi',
        ));
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_HEADER, false);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
           $response = curl_exec($ch);
           curl_close($ch);
           return $response;
        }else{
         return true;
        }
    }
}
