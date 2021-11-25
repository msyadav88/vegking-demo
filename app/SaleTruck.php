<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleTruck extends Model
{
  protected $fillable = [ 'sale_id', 'price', 'sale_date', 'delivery_date', 'delivery_location', 'truck_loads', 'load_status', 'number_delivery','deliveryid'];

	
}
