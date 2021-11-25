<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class TransLoad extends Model{
    protected $fillable = ['salesid','transport_id','goods','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','packaging_type','number_of_packing_units','requirements','freight_cost','payment_term','payment_type','transport_invoice_no','transport_invoice_due_date','payment_status','payment_status','notes_from_accounting','documents','notes','created_at','updated_at','customername'];

    
    public function transportdata(){
	return $this->hasone('App\Transportlist','id','transport_id')->select(array('id', 'carrier','plate_numbers'));
	}
	public function salesdata(){
	return $this->hasone('App\Sale','id','salesid')->select(array('id', 'stock_id','buyer_id'));
	}
	public function trucks(){
	return $this->hasone('App\SaleTruck','sale_id','salesid')->select(array('sale_id', 'delivery_date','delivery_location'));
	}
	public function product(){
      return $this->hasone('App\Product','id','goods')->select(array('id', 'name', 'image','homepage_image','type'));
    }
    public function productspecvalue(){
        return $this->hasone('App\ProductSpecificationValue','id','variety')->select(array('id', 'value'));
      }
	
	public function offerget()
    {
		return $this->hasOneThrough(
            'App\Stock',
            'App\Sale',
            'id', // Foreign key on users table...
            'id', // Foreign key on history table...
            'salesid', // Local key on suppliers table...
            'stock_id' // Local key on users table...
        )->select(array('country'));
	}
	 
	public function buyerget()
    {
		return $this->hasOneThrough(
            'App\Buyer',
            'App\Sale',
            'id', // Foreign key on users table...
            'id', // Foreign key on history table...
            'salesid', // Local key on suppliers table...
            'buyer_id' // Local key on users table...
        )->select(array('username','buyers.id'));
	}
	
	public function sellerget()
    {
		return $this->hasOneThrough(
            'App\Seller',
            'App\Sale',
            'id', // Foreign key on users table...
            'id', // Foreign key on history table...
            'salesid', // Local key on suppliers table...
            'stock_id' // Local key on users table...
        )->select(array('username','sellers.id'));
	}
	
}
