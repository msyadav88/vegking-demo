<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerProductPref extends Model
{
    protected $fillable = [ 'key', 'value', 'premium', 'buyer_pref_id'];
	
    public function productSpec(){
      return $this->hasone('App\ProductSpecification','id','key');
    }

    public function productSpecValue(){
      return $this->hasone('App\ProductSpecificationValue','id','value');
    }

}
