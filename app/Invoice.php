<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model{
    protected $fillable = ['date', 'amount', 'paid', 'status', 'buyer_id', 'seller_id', 'product_id', 'quantity_type', 'quantity', 'gross','net','vat','invoice_type','sale_id'];
    public function stock(){
        return $this->hasone('App\Stock','id','stock_id');
    }
    public function buyer(){
        return $this->hasone('App\Buyer','id','buyer_id');
    }
    public function seller(){
        return $this->hasone('App\Seller','id','seller_id');
    }
    public function product(){
        return $this->hasone('App\Product','id','product_id');
    }
}
