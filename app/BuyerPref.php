<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerPref extends Model
{
  protected $fillable = ['buyer_id','product_id','street','city','country','postalcode'];

  public function product(){
    return $this->hasone('App\Product','id','product_id')->select(array('id', 'name', 'image','homepage_image','type'));
  }

  public function buyer(){
    return $this->hasone('App\Buyer','id','buyer_id');
  }

  public function buyername(){
    return $this->hasone('App\Buyer','id','buyer_id')->select(['id', 'user_id', 'name', 'username']);
  }
  
  public function productPrefs()
  {
    return $this->hasmany('App\BuyerProductPref');
  }
  
  public static function boot() {
    parent::boot();
    static::deleting(function($buyerPref) { 
      $buyerPref->productPrefs()->delete();
    });
  }
}
