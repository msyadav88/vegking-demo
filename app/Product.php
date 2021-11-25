<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{

    protected $fillable = ['name', 'status', 'image', 'homepage_image', 'type', 'name_pl', 'name_de','base_price'];

    public function variety_detail(){
    	return $this->hasone('App\AppHead','id','variety');
    }

    public function packing_detail(){
    	return $this->hasone('App\AppHead','id','packing');
    }

    public function soil_detail(){
    	return $this->hasone('App\AppHead','id','soil');
    }

    public function flesh_color_detail(){
    	return $this->hasone('App\AppHead','id','flesh_color');
    }

    public function product_varieties()
    {
        return $this->hasone('App\ProductVarieties','product_id','product_id');
    }

}
