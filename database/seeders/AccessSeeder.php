<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Access;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Access::create([
            'name' => 'admin',
            'description' => 'Administration system'
        ]);
        Access::create([
            'name' => 'client',
            'description' => 'Client access to the platform'
        ]);
    }
}
