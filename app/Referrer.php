<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Referrer extends Model{
    protected $table = 'referrer';
    protected $fillable = ['user_id', 'ip', 'browser_name', 'os_name', 'os_version'];

   
}
