<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Stock extends Model{
    protected $fillable = ['seller_id', 'product_id', 'variety', 'size_from', 'size_to', 'quantity', 'country','city','postalcode','street','price','note', 'image','exp_image', 'status','available_from_date', 'available_per_day','pallets_available','stock_status','load_status','price_currency'];

    public function product(){
    	return $this->hasone('App\Product','id','product_id');
    }
    
    public function offerProperty()
    {
        return $this->hasmany('App\StockProperty','stock_id');
    }

    public function StockProperty()
    {
        return $this->hasmany('App\StockProperty');
    }

    public function seller(){
      return $this->hasone('App\Seller','id','seller_id')->select(['id', 'name', 'username', 'email', 'phone', 'company', 'city', 'postalcode', 'address', 'country','trust_level','contact_email','contact_sms','contact_whatsapp']);
    }
	public function sellercountry(){
      return $this->hasone('App\Seller','id','seller_id')->select(['id','username','country']);
    }

	public function productname(){
    	return $this->hasone('App\Product','id','product_id')->select('id','name','image','homepage_image');
    }
    public function sellername(){
      return $this->hasone('App\Seller','id','seller_id')->select(['id', 'user_id', 'name', 'username']);
    }
    public function sales()
    {
        return $this->hasmany('App\Sale','stock_id','id');
    }

    public function salesAmount()
    {
        return $this->hasmany('App\Sale','stock_id','id')->select('id','stock_id','price');
    }
    public function purchase_order()
    {
        return $this->hasone('App\PurchaseOrder','seller_id','seller_id');
    }
    
    public function offerPropertyRel()
    {
        return $this->hasmany('App\StockProperty')->select(['id','stock_id','product_spec_id','product_spec_val_id', 'value', 'ecs']);
    }
}
