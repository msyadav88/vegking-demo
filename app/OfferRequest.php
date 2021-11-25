<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferRequest extends Model
{
  protected $fillable = ['product_id', 'buyer_id', 'variety', 'size_from', 'size_to', 'packing', 'quantity', 'flesh_color', 'location_from', 'location_to', 'price_from', 'price_to', 'status'];

  public function product(){
    return $this->hasone('App\Product','id','product_id');
  }

  public function buyer(){
    return $this->hasone('App\Models\Auth\User','id','buyer_id')->select(['id', 'first_name', 'last_name', 'email', 'phone']);
  }
}
