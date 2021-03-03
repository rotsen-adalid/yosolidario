<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Site();
        $role->name = 'yosolidario.com';
        $role->description = 'Plataform ';
        $role->save();
        $role = new Site();
        $role->name = 'admin.yosolidario.com';
        $role->description = 'Platform administration';
        $role->save();
    }
}
