<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str as Str;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = Agency::create([
            'denomination'=> 'YoSolidario Bolivia',
            'slug' => Str::slug('YoSolidario Bolivia'),
            'identification'=> '6052128010',
            'identification_image' => null,
            'addresses'=> 'El Alto, Urbanizacion Loza, Calle: Provincia Camacho, #1464',
            'email_contact' => 'info@yosolidario.com',
            'representative' => 'Rotsen Adalid Luque Copa',
            'country_id' => 1,
            'type' => 'MATRIX_HOUSE',
            'status' => 'ACTIVE',
            'search' => 'YoSolidario Bolivia '.Str::slug('YoSolidario Bolivia'),
        ]);
    }
}
