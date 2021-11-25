<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
     protected $table = 'log_activity';
	  protected $fillable = [
        'url', 'ip', 'agent', 'user_id', 'action','created_at','updated_at','sessionid'
    ];
}
