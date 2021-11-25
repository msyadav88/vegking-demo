<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecificationValue extends Model
{
    protected $fillable = ['product_id', 'product_specification_id', 'value', 'parent_id','status', 'extra_supply_cost', 'extra_cost_to_buyer_factor', 'volume', 'premium', 'default','description','ec','ecbf','image','numeric_value', 'related_spec_id', 'related_spec_val_id','tags','shortcode'];
	
    public function product(){
      return $this->hasone('App\Product','id','product_id')->select(['id', 'name']);
    }
    
    public function product_specification(){
      return $this->hasone('App\ProductSpecification','id','product_specification_id')->select(['id', 'display_name','reference_id']);
    }
    
     public function children(){
        return $this->hasMany( 'App\ProductSpecificationValue', 'parent_id', 'id' );
    }



}
