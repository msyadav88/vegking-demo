<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin = Role::firstOrCreate(['name' => config('access.users.admin_role')]);
        $executive = Role::firstOrCreate(['name' => 'executive']);
        // $user = Role::firstOrCreate(['name' => config('access.users.default_role')]);
        $seller = Role::firstOrCreate(['name' => 'seller']);
        $buyer = Role::firstOrCreate(['name' => 'buyer']);
        $buyer = Role::firstOrCreate(['name' => 'trader']);
        $buyer = Role::firstOrCreate(['name' => 'trans']);
        $usermanager = Role::firstOrCreate(['name' => 'usermanager']);

        // Create Permissions
        $permissions = ['view backend','view order','view loads','view vehicles', 'view offer sent','offer sent - send PDF','view stock','add stock','edit stock','delete stock','view sales','add sales', 'edit sales', 'delete sales','sales - view PDF', 'edit match','match - invoice', 'match - all send invoice','view buyer','add buyer','edit buyer','delete buyer','view buyer pref','add buyer pref','edit buyer pref','delete buyer pref','view buyer leads','delete buyer leads','view seller','add seller','edit seller','delete seller','seller -resend invite link','view trade setting','add trade setting','edit trade setting','delete trade setting','view products','add products','edit products','delete products','view product spec','add product spec','edit product spec','delete product spec','view product spec values','add product spec values','edit product spec values','delete product spec values','view purchase order','add purchase order','edit purchase order','delete purchase order','view postal code','add postal code','edit postal code','delete postal code','view transport list','add transport list','edit transport list','delete transport list','view translations','add translations','edit translations','delete translations','view currency rate','add currency rate','edit currency rate','delete currency rate','view pages','add pages','edit pages','delete pages','view email templates','add email templates','edit email templates','delete email templates','view user','add user','edit user','delete user','view role','add role','edit role','delete role','user login as','user change password','user deactive','export sales','view matches','export buyers','export sellers','export products','export stocks','export product spec','export product spec values','add vehicles','edit vehicles','delete vehicles','import buyers','import sellers','system settings','view log viewer','view transport list import'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission],['name' => $permission]);
        }

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo(Permission::all());

        // Assign Permissions to other Roles
        $executive->givePermissionTo('view backend', 'view stock', 'view order', 'view sales', 'view loads', 'view vehicles');
        $seller->givePermissionTo('view stock');
        $buyer->givePermissionTo('view order');
        $usermanager->givePermissionTo('view user');

        $this->enableForeignKeys();
    }
}
