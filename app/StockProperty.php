<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockProperty extends Model
{
    protected $fillable = ['stock_id','product_spec_id','product_spec_val_id','value','ecs',
    'additional_parameters'];

    public function stock(){
        return $this->hasone('App\Stock','id','stock_id');
    }
    
    public function productSpec(){
        return $this->hasone('App\ProductSpecification','id','product_spec_id')->withDefault();
    }

    public function productSpecValue(){
        return $this->hasone('App\ProductSpecificationValue','id','product_spec_val_id')->withDefault();
    }
    
    public function productSpecRel(){
        return $this->hasone('App\ProductSpecification','id','product_spec_id')->select(['id','type_name','display_name','field_type'])->withDefault();
    }

    public function productSpecValueRel(){
        return $this->hasone('App\ProductSpecificationValue','id','product_spec_val_id')->select(['id','product_specification_id','value'])->withDefault();
    }
    
}
