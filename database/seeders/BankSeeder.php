<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = Bank::create([
            'denomination' => 'Banco Fie',
            'status' => 'ACTIVE',
            'country_id' => 1
        ]);
    }
}
