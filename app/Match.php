<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
   protected $table = 'matches';
    protected $fillable = ['buyer_pref_id', 'stock_id','product_id', 'profit_per_ton','pton_calculation','profit_per_truck', 'total_profit', 'numofmismatches','notes'];

    public function matchItem(){
      return $this->hasmany('App\MatchItem','match_id','id');
    }
    public function stock(){
      return $this->hasone('App\Stock','id','stock_id');
    }

    public function product(){
      return $this->hasone('App\Product','id','product_id');
    }

    public function buyerPref(){
      return $this->hasone('App\BuyerPref','id','buyer_pref_id');
    }

    public function offerSent(){
      return $this->hasone('App\OfferSent','match_id','id');
    }

    // public function seller(){
    //   return $this->hasone('App\seller','id','seller_id');
    // }

    public function offerproperty()
    {
      return $this->hasmany('App\StockProperty', 'stock_id');
    }

}
