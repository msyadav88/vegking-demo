<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMessages extends Model
{
    protected $fillable = ['type', 'opened', 'clicked'];
}
