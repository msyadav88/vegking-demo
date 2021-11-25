<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model{

    protected $fillable = ['buyer_id', 'seller_id', 'stock_id', 'price', 'delivery_date','sale_id'];

    public function stock(){
        return $this->hasone('App\Stock','id','stock_id');
    }

    public function buyer(){
        return $this->hasone('App\Buyer','id','buyer_id');
    }

    public function seller(){
        return $this->hasone('App\Seller','id','seller_id');
    }

}
