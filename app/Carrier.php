<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model{
    protected $fillable = ['name','vat','country','city','address','postal','created_at','updated_at'];

    protected $table = 'carrier';
}
