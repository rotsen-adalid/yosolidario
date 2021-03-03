<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'ceo']);
        $role2 = Role::create(['name' => 'fundraising']);
        //$role3 = Role::create(['name' => 'organizer']);
        // 
        $permission = Permission::create(['name' => '/management/country/show'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => '/management/country/create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => '/management/country/update'])->syncRoles([$role1, $role2]);
    }
}
