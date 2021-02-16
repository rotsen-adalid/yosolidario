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
            'search' => 'Rotsen Adalid '.Str::slug('rotsen.adalid').' '.'rotsen.adalid@hotmail.com',
        ]);
        $default->accesess()->attach([1]);
        $default->accesess()->attach([2]);

        $users = User::factory(100)->create();
        foreach ($users as $user) {
            $user->accesess()->attach([2]);
        }
    }
}
