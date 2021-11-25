<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class UserTracking extends Model
{
   protected $timestamp=true;
   protected $table = "user_tracking";
   protected $fillable=['user_id', 'page', 'button', 'name', 'data', 'date_time','fromUrl','toUrl','ip','country'];

   // public function user(){
   //     $this->belongsTo(BaseUser::class, 'user_id');
   // }
   public function userdata(){
      return $this->hasone('App\Models\Auth\User','id','user_id')->select(array('id', 'first_name','last_name'));
      // return $this->belongsTo('App\Models\Auth\User', 'user_id');
   }
}
