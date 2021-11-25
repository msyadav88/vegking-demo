<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CarrierContact extends Model{
    protected $fillable = ['carrierid','type','transportname','transportemail','phone','created_at','updated_at'];

    protected $table = 'carriercontact';
}
