<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\CampaignQuestion;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaings = Campaign::factory(20)->create();
        foreach ($campaings as $item) {
            Image::factory(1)->create([
                'imageable_id' => $item->id,
                'imageable_type' => Campaign::class
            ]);
            Video::factory(1)->create([
                'videoable_id' => $item->id,
                'videoable_type' => Campaign::class
            ]);
            
            CampaignQuestion::factory(1)->create([
                'about' => null,
                'about_url' => null,
                'use_of_money' => null,
                'use_of_money_url' => null,
                'about_promoter' => null,
                'about_promoter_url' => null,
                'delivery_of_awards' => null,
                'delivery_of_awards_url' => null,
                'contact_promoter' => null,
                'contact_promoter_url'=> null,
                'campaign_id' =>  $item->id,
            ]);
        }
    }
}
