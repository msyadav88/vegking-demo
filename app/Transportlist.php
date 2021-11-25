<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Transportlist extends Model{
    protected $fillable = ['salesid','carrier','trailer_type','temperature','plate_numbers','drivers_name','drivers_phone_number','created_at','updated_at','salestatus'];

    protected $table = 'transport_list';
}
