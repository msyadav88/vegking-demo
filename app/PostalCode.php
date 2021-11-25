<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    protected $fillable = ['name', 'code', 'ph_code', 'postal_code', 'postal_code_short', 'country', 'price', 'type', 'status'];
}
