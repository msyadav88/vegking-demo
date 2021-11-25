<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppHead extends Model
{
    protected $fillable = ['name', 'desc', 'color_id', 'dry_matter', 'tuber_shape', 'type','is_active', 'colour_of_skin', 'depth_of_eyes', 'smoothness_of_skin', 'premium', 'default', 'order', 'parent', 'image', 'base_price', 'parent_ref', 'unique_hash', 'status', 'extra_supply_cost', 'extra_cost_to_buyer_factor', 'volume', 'product_id'];

    public function flesh_color(){
        return $this->hasone('App\AppHead','id','color_id');
    }

    public function product_id(){
        return $this->hasone('App\AppHead','id','product_id');
    }

    public function children(){
        return $this->hasMany( 'App\AppHead', 'parent_ref', 'id' );
    }

    public function parent(){
        return $this->hasOne( 'App\AppHead', 'id', 'parent_ref' );
    }
}
