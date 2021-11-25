<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Transshipper extends Model{
    protected $fillable = ['loadid','shipper','shipper_address','shipper_reference','shipper_date','created_at','updated_at'];

    protected $table = 'trans_shipper';
}
