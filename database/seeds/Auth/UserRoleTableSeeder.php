<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    { 
        $this->disableForeignKeys();
        User::where('email','=', 'admin@cotrader.com')->first()->assignRole(config('access.users.admin_role'));
        User::where('email','=', 'executive@cotrader.com')->first()->assignRole('executive');
        // User::where('email','=', 'user@cotrader.com')->first()->assignRole(config('access.users.default_role'));
        User::where('email','=', 'seller@cotrader.com')->first()->assignRole('seller');
        User::where('email','=', 'buyer@cotrader.com')->first()->assignRole('buyer');

        $this->enableForeignKeys();
    }
}
