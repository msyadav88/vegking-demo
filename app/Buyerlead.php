<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyerlead extends Model
{
    protected $table = 'buyercontacts';
	protected $fillable = ['name','email', 'phone','company', 'product_id','prefered_method','notes','email_verified_at','email_verification_code','referral','product_sub_type'];


}
