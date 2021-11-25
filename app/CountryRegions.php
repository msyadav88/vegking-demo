<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryRegions extends Model
{
    protected $table = 'country_regions';
    protected $fillable = ['country', 'region'];
}