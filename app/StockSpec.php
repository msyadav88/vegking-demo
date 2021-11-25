<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockSpec extends Model
{
    protected $fillable = ['buyer_id','type' ,'key', 'val'];
}
