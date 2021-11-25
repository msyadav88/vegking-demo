<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
  protected $fillable = [ 'buyer_id', 'match_id', 'stock_id', 'price', 'status', 'quantity', 'sale_date', 'delivery_date', 'payment_term', 'payment_type', 'payment_currency', 'payment_status','defect_percentage', 'offer_id', 'trader_id'];

	public function buyer(){
	return $this->hasone('App\Buyer','id','buyer_id');
	}

	public function stock(){
	return $this->hasone('App\Stock','id','stock_id');
  }
  
   public function paymentType(){
      return $this->hasone('App\AppHead','id','payment_type');
    }

    public function paymentTerms(){
      return $this->hasone('App\AppHead','id','payment_term');
    }
	
	public function currencyId(){
      return $this->hasone('App\AppHead','id','payment_currency');
    }
	
	public function sellerId(){
      return $this->hasone('App\Stock','seller_id','id');
    }

    public function trucks()
    {
        return $this->hasmany('App\SaleTruck','sale_id','id');
    }
    public function product(){
      return $this->hasone('App\Product','id','product_id');
    }
    public function trucksone()
    {
        return $this->hasmany('App\SaleTruck','sale_id','id');
    }
}
