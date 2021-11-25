<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bizcards extends Model
{
    protected $table = 'bizcards';
    protected $fillable = ['user_id', 'biz_card_image', 'status']; 
}