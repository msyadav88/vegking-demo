<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerPaymentDetails extends Model
{
    /*protected $fillable = ['order_id', 'stock_id', 'product_id', 'seller_id', 'buyer_id', 'status'];
	*/
    public function paymentType(){
      return $this->hasone('App\AppHead','id','payment_type');
    }

    public function paymentTerms(){
      return $this->hasone('App\AppHead','id','payment_terms');
    }
	
	public function currencyId(){
      return $this->hasone('App\AppHead','id','currency');
    }

}
