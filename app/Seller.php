<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = ['user_id', 'username', 'phone', 'company', 'vat','name','email','city', 'postalcode', 'address', 'country', 'seller2_contact','transport_contact','accounts_contact','note','status', 'invite_sent', 'verified', 'available_stocks','trust_level', 'truck_loads_day', 'truck_loads_week', 'truck_loads_total','contact_email','contact_sms','contact_whatsapp','nickname'];
    public function stocks()
    {
      return $this->hasmany('App\Stock');
    }
    public function user(){
      return $this->belongsTo('App\Models\Auth\User');
    }
}
