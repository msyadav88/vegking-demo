<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIps extends Model
{
    protected $table = 'userips';
    protected $fillable = ['userid', 'ip','didlogin', 'date','time']; 

}
