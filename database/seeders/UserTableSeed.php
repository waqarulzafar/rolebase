<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = new Role();
        $roleAdmin->name = 'Admin';
        $roleAdmin->desc = 'Admin User';
        $roleAdmin->status = 'active';
        $roleAdmin->save();

        $roleAdmin1 = new Role();
        $roleAdmin1->name = 'staff';
        $roleAdmin1->desc = 'Staff User';
        $roleAdmin1->status = 'active';
        $roleAdmin1->save();

        $adminUser = new User();
        $adminUser->name = 'Admin';
        $adminUser->email = 'admin@gmail.com';
        $adminUser->password = bcrypt('123456');
        $adminUser->save();

        $adminUser->roles()->attach($roleAdmin);

        $adminUser = new User();
        $adminUser->name = 'Admin';
        $adminUser->email = 'staff@gmail.com';
        $adminUser->password = bcrypt('123456');
        $adminUser->save();

        $adminUser->roles()->attach($roleAdmin1);
    }
}
