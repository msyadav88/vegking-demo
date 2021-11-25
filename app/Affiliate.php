<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model{
    protected $table = 'affiliate_data';
    protected $fillable = ['u_id', 'aff_code', 'user_code'];  
}
