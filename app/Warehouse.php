<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse';
    protected $fillable = [ 'stock_id', 'sale_id', 'country', 'city', 'postcode', 'tons', 'product','dateStored','notes'];

    public function stock(){
	    return $this->hasone('App\Stock','id','stock_id');
    }
    
	public function sale(){
	    return $this->hasone('App\Sale','id','sale_id');
	}
}
