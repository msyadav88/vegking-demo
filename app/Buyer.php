<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    //protected $fillable = ['username', 'name', 'email', 'phone', 'buyer2_contact', 'transport_contact', 'accounts_contact', 'company', 'address', 'city', 'country', 'postalcode', 'vat', 'delivery_address', 'delivery_same', 'credit_limit', 'product_prefs', 'product', 'variety', 'packing', 'dry_matter_content', 'transportation', 'price_prefs', 'size_range', 'soil', 'flesh_color', 'purposes', 'defects', 'note', 'status'];
	 protected $fillable = ['user_id','username', 'name', 'email', 'phone', 'buyer2_contact', 'transport_contact', 'accounts_contact', 'company', 'address', 'city', 'country', 'postalcode', 'vat', 'delivery_address', 'delivery_same', 'credit_limit','transportation','product_prefs', 'product', 'variety_premium', 'disc_upsc', 'size_range', 'note', 'total_prefs','truck_quantity','trust_level', 'status','all_varieties', 'contact_email', 'contact_sms', 'contact_whatsapp', 'nickname'];

    public function buyer_prefs(){
    	return $this->hasmany('App\BuyerPref','buyer_id','id');
    }

    public function product_detail(){
    	return $this->hasone('App\AppHead','id','product');
    }

    public function prefs(){
    	return $this->hasmany('App\BuyerPref','buyer_id');
    }
	
	public function balanceitems(){
    	return $this->hasmany('App\Sale','buyer_id')->where('payment_status','unpaid');
    }
    
    public function payment_details(){
    	return $this->hasmany('App\BuyerPaymentDetails','buyer_id');
    }
    public function user(){
      return $this->belongsTo('App\Models\Auth\User');
    }
}
