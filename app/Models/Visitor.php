<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['post_code', 'refer_link', 'ip', 'did_logn', 'city', 'country', 'user_id'];
}
