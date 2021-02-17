<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Campaign;
use App\Models\Organization;
use App\Models\Profile;
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
        // \App\Models\User::factory(10)->create();
        Storage::deleteDirectory('public/campaign_image');
        Storage::deleteDirectory('public/organization');
        Storage::deleteDirectory('public/campaign_question_image');
        Storage::deleteDirectory('public/profile-photos');
        Storage::makeDirectory('public/campaign_image');
        $this->call(RoleSeeder::class);
        $this->call([
            CountrySeeder::class,
            BankSeeder::class,
            AgencySeeder::class,
            CategoryCampaignSeeder::class
        ]);
        $this->call(UserSeeder::class);
        Organization::factory(1)->create();
        Profile::factory(1)->create();
    }
}
