<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVisits extends Model
{
    protected $table = 'user_visits';
    protected $fillable = ['user_id', 'ip', 'country', 'thisUrl', 'fromUrl', 'toUrl']; 
}