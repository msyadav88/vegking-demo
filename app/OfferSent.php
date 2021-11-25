<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferSent extends Model
{
    protected $table = 'offersent';

    protected $fillable = [ 'buyer_id', 'stock_id', 'match_id', 'offerprice', 'time_sent','notes'];

	public function buyer(){
	return $this->hasone('App\Buyer','id','buyer_id');
	}

    public function stock(){
        return $this->hasone('App\Stock','id','stock_id');
    }

	public function match(){
	return $this->hasone('App\Match','id','match_id');
    }
}
