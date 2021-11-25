<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
  protected $fillable = [ 'order_id', 'cash', 'wire', 'amount', 'due_date', 'type', 'purchase', 'date', 'paid', 'date_paid'];
	public function buyer(){
	return $this->hasone('App\Order','id','order_id');
    }
}
