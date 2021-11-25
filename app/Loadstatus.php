<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Loadstatus extends Model{

    protected $fillable = ['status'];
    protected $table = 'load_status';
}
