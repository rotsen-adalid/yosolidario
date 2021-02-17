<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str as Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = User::create([
            'name'=> 'Rotsen Adalid ',
            'slug' => 'rotsen_adalid',
            'email'=> 'rotsen.adalid@hotmail.com',
            'password'=> bcrypt(12345678),
            'status' => 'VERIFIED',
            'access_adm' => 'YES',
            'country_id' => 1,
            'agency_id' => 1,
            'search' => 'Rotsen Adalid '.Str::slug('rotsen.adalid').' '.'rotsen.adalid@hotmail.com',
        ])->assignRole('ceo');

        $default = User::create([
            'name'=> 'Yolandita',
            'slug' => 'yolandita',
            'email'=> 'yolandita@hotmail.com',
            'password'=> bcrypt(12345678),
            'status' => 'VERIFIED',
            'access_adm' => 'YES',
            'country_id' => 1,
            'agency_id' => 1,
            'search' => 'Yolandita '.Str::slug('yolandita').' '.'yolandita@hotmail.com',
        ])->assignRole('fundraising');

        $users = User::factory(100)->create();
        foreach ($users as $user) {
            $user->assignRole('organizer');
        }
    }
}
