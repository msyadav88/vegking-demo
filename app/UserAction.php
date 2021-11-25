<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class UserAction extends Model
{
    protected $table = 'user_actions';
    protected $fillable = ['trader_id', 'stock_id','user_action', 'entity','entity_id'];

    public function trader(){
        return $this->hasone('App\Models\Auth\User','id','trader_id')->select('id','first_name','last_name');
    }
    public function stock(){
        return $this->hasone('App\Stock','id','stock_id');
    }

    public function offerSent(){
        return $this->hasone('App\offerSent','match_id','id');
    }
    
    public static function saveAction($data){
        
    }
    
}