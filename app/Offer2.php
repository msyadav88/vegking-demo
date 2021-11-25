<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Offer2 extends Model{
    protected $table = 'offers2';

    protected $fillable = ['match_id', 'pref_id', 'stock_id', 'avgsaleprice', 'saleprice', 'offerprice'];
}