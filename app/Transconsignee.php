<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Transconsignee extends Model{
    protected $fillable = ['loadid','consignee','consignee_address','consignee_reference','consignee_date','created_at','updated_at'];

    protected $table = 'trans_consignee';
}
