<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
     protected $fillable = ['site_name', 'email', 'phone', 'address', 'footer_about', 'currency', 'site_logo', 'site_favicon'];
}
