<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::firstOrCreate(['email' => 'admin@cotrader.com'],[
            'first_name' => 'Veg',
            'last_name' => 'King',
            'email' => 'admin@cotrader.com',
            'phone' => '00000000000',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::firstOrCreate(['email' => 'executive@cotrader.com'],[
            'first_name' => 'Backend',
            'last_name' => 'User',
            'email' => 'executive@cotrader.com',
            'phone' => '00000000000',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        // User::firstOrCreate(['email' => 'user@cotrader.com'],[
        //     'first_name' => 'Default',
        //     'last_name' => 'User',
        //     'email' => 'user@cotrader.com',
        //     'phone' => '00000000000',
        //     'password' => 'secret',
        //     'confirmation_code' => md5(uniqid(mt_rand(), true)),
        //     'confirmed' => true,
        // ]);

        User::firstOrCreate(['email' => 'seller@cotrader.com'],[
            'first_name' => 'Seller',
            'last_name' => 'User',
            'email' => 'seller@cotrader.com',
            'phone' => '00000000000',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::firstOrCreate(['email' => 'buyer@cotrader.com'],[
            'first_name' => 'Buyer',
            'last_name' => 'User',
            'email' => 'buyer@cotrader.com',
            'phone' => '00000000000',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        $this->enableForeignKeys();
    }
}
