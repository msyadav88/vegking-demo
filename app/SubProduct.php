<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model{

    protected $table = 'sub_product';
    protected $fillable = ['product_id', 'sub_pro_name_en', 'sub_pro_name_pl', 'sub_pro_name_de', 'image', 'sub_pro_type', 'status'];

    public function product(){
        return $this->hasone('App\Product','id','product_id')->select(['id', 'name']);
    }

}