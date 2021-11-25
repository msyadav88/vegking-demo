<?php

namespace App\Observers\User;

use App\Models\Auth\User;
use App\Models\Visitor;

/**
 * Class UserObserver.
 */
class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\Models\Auth\User  $user
     */
    public function created(User $user) : void
    {
        $this->logPasswordHistory($user);
        $ip =  \Request::ip();
        $visitor = Visitor::where('ip', $ip)->where('user_id', null)->first();
        if($visitor){
            $visitor->user_id = $user->id;
            $visitor->save();
        }

    }

    /**
     * Listen to the User updated event.
     *
     * @param  \App\Models\Auth\User  $user
     */
    public function updated(User $user) : void
    {
        // Only log password history on update if the password actually changed
        if ($user->isDirty('password')) {
            $this->logPasswordHistory($user);
        }
    }

    /**
     * @param User $user
     */
    private function logPasswordHistory(User $user) : void
    {
        if (config('access.users.password_history')) {
            $user->passwordHistories()->create([
                'password' => $user->password, // Password already hashed & saved so just take from model
            ]);
        }
    }
}
