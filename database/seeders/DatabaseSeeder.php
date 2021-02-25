<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/campaign_image');
        Storage::deleteDirectory('public/organization');
        Storage::deleteDirectory('public/campaign_question_image');
        Storage::deleteDirectory('public/profile-photos');
        //Storage::makeDirectory('public/campaign_image');
    }
}
