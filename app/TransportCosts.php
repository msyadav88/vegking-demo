<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportCosts extends Model
{
    protected $table = 'transport_costs';
    protected $fillable = ['country', 'region', 'cost'];

    public function country(){
        return $this->hasone('App\CountryRegions','id','country')->select(['id', 'country']);
    }

    public function region(){
        return $this->hasone('App\CountryRegions','id','region')->select(['id', 'region']);
    }
}