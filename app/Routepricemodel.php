<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routepricemodel extends Model
{
    protected $table = 'route_prices';
    public function from_region(){
        return $this->hasOne('App\region','id','from_region_id');
      }
      public function to_region(){
        return $this->hasOne('App\region','id','to_region_id');
      }
}
