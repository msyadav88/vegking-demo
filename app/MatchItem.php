<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchItem extends Model
{
    protected $fillable = ['match_id', 'product_specification_id', 'value', 'matched'];

    public function match(){
      return $this->belongsTo('App\Match');
    }
    public function product_specification(){
      return $this->hasone('App\ProductSpecification','id','product_specification_id');
    }
}
