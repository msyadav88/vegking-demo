<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVarieties extends Model{

    protected $fillable = ['id', 'user_id', 'product_id', 'URL', 'higher_taxon','genus','species','parentage','breeder','breeder_agent','status'];

    public function product(){
        return $this->hasone('App\Product','id','product_id');
    }

}
