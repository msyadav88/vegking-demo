<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportprice extends Model
{
    protected $table = 'country_transport_prices';

    public function region(){
        return $this->hasone('App\region','id','region_id');
      }
}
