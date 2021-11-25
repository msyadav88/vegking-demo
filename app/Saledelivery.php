<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saledelivery extends Model
{
    protected $fillable = ['salesid','deliverymain','created_at','updated_at','loadcount'];

    protected $table = 'sale_delivery';
}
