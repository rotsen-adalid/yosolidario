<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str as Str;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Bolivia',
            'slug' => Str::slug('Bolivia'),
            'code_coi' => 'BOL',
            'telephone_prefix' => '+591',
            'currency_symbol' => 'Bs',
            'currency_iso' => 'BOB',
            'status_published_campaign' => 'ACTIVE',
            'search' => 'Bolivia BOL'.Str::slug('Bolivia'),
        ]);
        Country::create([
            'name' => 'Argentina',
            'slug' => Str::slug('Argentina'),
            'code_coi' => 'ARG',
            'telephone_prefix' => '+54',
            'currency_symbol' => '$',
            'currency_iso' => 'ARS',
            'status_published_campaign' => 'INACTIVE',
            'search' => 'Argentina ARG '.Str::slug('Argentina'),
        ]);
        Country::create([
            'name' => 'Brasil',
            'slug' => Str::slug('Brasil'),
            'code_coi' => 'BRA',
            'telephone_prefix' => '+55',
            'currency_symbol' => 'R$',
            'currency_iso' => 'BRL',
            'status_published_campaign' => 'INACTIVE',
            'search' => 'Brasil BRA '.Str::slug('Brasil'),
        ]);
        Country::create([
            'name' => 'Chile',
            'slug' => Str::slug('Chile'),
            'code_coi' => 'CHI',
            'telephone_prefix' => '+56',
            'currency_symbol' => '$',
            'currency_iso' => 'CLP',
            'status_published_campaign' => 'INACTIVE',
            'search' => 'Chile CHI '.Str::slug('Chile'),
        ]);
        Country::create([
            'name' => 'Colombia',
            'slug' => Str::slug('Colombia'),
            'code_coi' => 'COL',
            'telephone_prefix' => '+57',
            'currency_symbol' => '$',
            'currency_iso' => 'COP',
            'status_published_campaign' => 'INACTIVE',
            'search' => 'Colombia COL '.Str::slug('Colombia'),
        ]);
        Country::create([
            'name' => 'Ecuador',
            'slug' => Str::slug('Ecuador'),
            'code_coi' => 'ECU',
            'telephone_prefix' => '+593',
            'currency_symbol' => '$us',
            'currency_iso' => 'USD',
            'status_published_campaign' => 'INACTIVE',
            'search' => 'Ecuador ECU '.Str::slug('Ecuador'),
        ]);
        Country::create([
            'name' => 'Paraguay',
            'slug' => Str::slug('Paraguay'),
            'code_coi' => 'PAR',
            'telephone_prefix' => '+595',
            'currency_symbol' => '₲',
            'currency_iso' => 'PRY',
            'status_published_campaign' => 'INACTIVE',
            'search' => 'Paraguay PAR '.Str::slug('Paraguay'),
        ]);
        Country::create([
            'name' => 'Peru',
            'slug' => Str::slug('Peru'),
            'code_coi' => 'PER',
            'telephone_prefix' => '+54',
            'currency_symbol' => 'S/',
            'currency_iso' => 'PEN',
            'status_published_campaign' => 'INACTIVE',
            'search' => 'Peru PER '.Str::slug('Peru'),
        ]);
        Country::create([
            'name' => 'Uruguay',
            'slug' => Str::slug('Uruguay'),
            'code_coi' => 'URU',
            'telephone_prefix' => '+598',
            'currency_symbol' => '$',
            'currency_iso' => 'UYU',
            'status_published_campaign' => 'INACTIVE',
            'search' => 'Uruguay URU '.Str::slug('Uruguay'),
        ]);
        Country::create([
            'name' => 'Venezuela',
            'slug' => Str::slug('Venezuela'),
            'code_coi' => 'VES',
            'telephone_prefix' => '+58',
            'currency_symbol' => 'Bs',
            'currency_iso' => 'VEN',
            'status_published_campaign' => 'INACTIVE',
            'search' => 'Venezuela VEN '.Str::slug('Venezuela'),
        ]);

        $countries = array("México","Afganistán","Albania","Alemania","Andorra","Angola",
        "Antigua y Barbuda","Arabia Saudita","Argelia","Armenia","Australia",
        "Austria","Azerbaiyán","Bahamas","Bangladés","Barbados","Baréin","Bélgica","Belice"
        ,"Benín","Bielorrusia","Birmania","Bosnia y Herzegovina","Botsuana",
        "Brunéi","Bulgaria","Burkina Faso","Burundi","Bután","Cabo Verde","Camboya","Camerún",
        "Canadá","Catar","Chad","China","Chipre","Ciudad del Vaticano",
        "Comoras","Corea del Norte","Corea del Sur","Costa de Marfil","Costa Rica","Croacia",
        "Cuba","Dinamarca","Dominica","Egipto","El Salvador","Emiratos Árabes Unidos",
        "Eritrea","Eslovaquia","Eslovenia","España","Estados Unidos","Estonia","Etiopía","Filipinas",
        "Finlandia","Fiyi","Francia","Gabón","Gambia","Georgia","Ghana","Granada","Grecia","Guatemala",
        "Guyana","Guinea","Guinea ecuatorial","Guinea-Bisáu","Haití","Honduras","Hungría","India",
        "Indonesia","Irak","Irán","Irlanda","Islandia","Islas Marshall","Islas Salomón","Israel",
        "Italia","Jamaica","Japón","Jordania","Kazajistán","Kenia","Kirguistán","Kiribati","Kuwait",
        "Laos","Lesoto","Letonia","Líbano","Liberia","Libia","Liechtenstein","Lituania","Luxemburgo",
        "Madagascar","Malasia","Malaui","Maldivas","Malí","Malta","Marruecos","Mauricio","Mauritania",
        "Micronesia","Moldavia","Mónaco","Mongolia","Montenegro","Mozambique","Namibia","Nauru","Nepal",
        "Nicaragua","Níger","Nigeria","Noruega","Nueva Zelanda","Omán","Países Bajos","Pakistán","Palaos",
        "Panamá","Papúa Nueva Guinea","Polonia","Portugal","Reino Unido","República Centroafricana",
        "República Checa","República de Macedonia","República del Congo","República Democrática del Congo",
        "República Dominicana","República Sudafricana","Ruanda","Rumanía","Rusia","Samoa","San Cristóbal y Nieves",
        "San Marino","San Vicente y las Granadinas","Santa Lucía","Santo Tomé y Príncipe","Senegal",
        "Serbia","Seychelles","Sierra Leona","Singapur","Siria","Somalia","Sri Lanka","Suazilandia",
        "Sudán","Sudán del Sur","Suecia","Suiza","Surinam","Tailandia","Tanzania","Tayikistán",
        "Timor Oriental","Togo","Tonga","Trinidad y Tobago","Túnez","Turkmenistán","Turquía","Tuvalu","Ucrania",
        "Uganda","Uzbekistán","Vanuatu","Vietnam","Yemen","Yibuti","Zambia","Zimbabue");

        foreach ($countries as $country){
            Country::create([
                'name' => $country,
                'slug' => Str::slug($country),
                'status_published_campaign' => 'INACTIVE',
                'search' => $country.Str::slug($country),
              ]);
        }

    }
}
