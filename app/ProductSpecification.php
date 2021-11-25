<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $fillable = ['product_id', 'field', 'display_name', 'importance', 'order', 'buyer_hasmany', 'required', 'parent_id', 'stock_hasmany','reference_id','buyer_pref_anylogic', 'display_in_transport', 'can_edit', 'type_name','tags','shortcode'];
	
    public function product(){
      return $this->hasone('App\Product','id','product_id')->select(['id', 'name']);
    }
    
    
    public function parent_spec(){
        return $this->hasOne( 'App\ProductSpecification', 'id', 'parent_id' );
    }
    
    public function children(){
        return $this->hasMany( 'App\ProductSpecification', 'parent_id', 'id' );
    }

	public function options(){
        return $this->hasMany( 'App\ProductSpecificationValue', 'product_specification_id', 'id' );
    }

}
