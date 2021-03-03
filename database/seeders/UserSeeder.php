<?php

namespace Database\Seeders;

use App\Models\Site;
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
        $default1 = User::create([
            'name'=> 'Rotsen Adalid ',
            'slug' => 'rotsen_adalid',
            'email'=> 'rotsen.adalid@hotmail.com',
            'password'=> bcrypt(12345678),
            'status' => 'PUBLIC',
            'country_id' => 1,
            'agency_id' => 1,
            'search' => 'Rotsen Adalid '.Str::slug('rotsen.adalid').' '.'rotsen.adalid@hotmail.com',
        ])->assignRole('ceo');

        $default1->sites()->attach(Site::where('name', 'yosolidario.com')->first());
        $default1->sites()->attach(Site::where('name', 'admin.yosolidario.com')->first());

        $default2 = User::create([
            'name'=> 'Yolandita',
            'slug' => 'yolandita',
            'email'=> 'yolandita@hotmail.com',
            'password'=> bcrypt(12345678),
            'status' => 'PUBLIC',
            'country_id' => 1,
            'agency_id' => 1,
            'search' => 'Yolandita '.Str::slug('yolandita').' '.'yolandita@hotmail.com',
        ])->assignRole('fundraising');

        $default2->sites()->attach(Site::where('name', 'yosolidario.com')->first());
        $default2->sites()->attach(Site::where('name', 'admin.yosolidario.com')->first());

        $users = User::factory(100)->create();
        foreach ($users as $user) {
            //$user->assignRole('organizer');
            $user->sites()->attach(Site::where('name', 'yosolidario.com')->first());
        }
    }
}
