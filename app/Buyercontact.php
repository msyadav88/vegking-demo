<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyercontact extends Model
{
	 protected $fillable = ['name','email', 'phone', 'product_id','prefered_method','notes','email_verified','email_verification_code'];


}
