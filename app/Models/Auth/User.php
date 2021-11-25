<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Relationship\UserRelationship;

/**
 * Class User.
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;    


    public function userTracking(){
        return $this->hasMany(UserTracking::class, 'user_id');
    }
    public function buyer(){
      return $this->hasOne('\App\Buyer','user_id');
    }
    public function seller(){
      return $this->hasOne('\App\Seller','user_id');
    }
}
