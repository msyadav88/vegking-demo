<?php

namespace App\Events\Frontend\Auth;

use App\Models\Auth\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

/**
 * Class UserRegistered.
 */
class UserRegistered
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;
    public $buyer_seller;

    /**
     * @param $user
     */
    public function __construct(User $user, $buyer_seller)
    {
        $this->user = $user;
        $this->buyer_seller = $buyer_seller;
    }
}
