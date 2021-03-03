<?php

namespace Database\Seeders;

use App\Models\CategoryCampaign;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str as Str;

class CategoryCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryCampaign::create([
            'name' => 'Animals and pets',
            'slug' => Str::slug('Animals and pets'),
            'name_icon' => 'Animals',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Animals and pets '.Str::slug('Animals and pets'),
        ]);
        CategoryCampaign::create([
            'name' => 'Accidents and emergencies',
            'slug' => Str::slug('Accidents and emergencies'),
            'name_icon' => 'Emergencies',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Accidents and emergencies '.Str::slug('Accidents and emergencies'),
        ]);
        CategoryCampaign::create([
            'name' => 'Baby children and family',
            'slug' => Str::slug('Baby children and family'),
            'name_icon' => 'Family',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Baby children and family '.Str::slug('Baby children and family'),
        ]);
        CategoryCampaign::create([
            'name' => 'Weddings and honeymoons',
            'slug' => Str::slug('Weddings and honeymoons'),
            'name_icon' => 'Wedding',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Weddings and honeymoons '.Str::slug('Weddings and honeymoons'),
        ]);
        CategoryCampaign::create([
            'name' => 'Celebrations and events',
            'slug' => Str::slug('Celebrations and events'),
            'name_icon' => 'Celebrations',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Celebrations and events '.Str::slug('Celebrations and events'),
        ]);
        CategoryCampaign::create([
            'name' => 'Competitions and contests',
            'slug' => Str::slug('Competitions and contests'),
            'name_icon' => 'Competitions',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Competitions and contests '.Str::slug('Competitions and contests'),
        ]);
        CategoryCampaign::create([
            'name' => 'Community and neighbors',
            'slug' => Str::slug('Community and neighbors'),
            'name_icon' => 'AnimCommunityals',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Community and neighbors '.Str::slug('Community and neighbors'),
        ]);
        CategoryCampaign::create([
            'name' => 'Sports teams and clubs',
            'slug' => Str::slug('Sports teams and clubs'),
            'name_icon' => 'Sports',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Sports teams and clubs'.Str::slug('Sports teams and clubs'),
        ]);
        CategoryCampaign::create([
            'name' => 'Education and formation',
            'slug' => Str::slug('Education and formation'),
            'name_icon' => 'Education',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Education and formation '.Str::slug('Education and formation'),
        ]);
        CategoryCampaign::create([
            'name' => 'Funerals and reminders',
            'slug' => Str::slug('Funerals and reminders'),
            'name_icon' => 'Funerals',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Funerals and reminders'.Str::slug('Funerals and reminders'),
        ]);
        CategoryCampaign::create([
            'name' => 'Medicine, disease and health',
            'slug' => Str::slug('Medicine, disease and health'),
            'name_icon' => 'Medical',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Medicine, disease and health '.Str::slug('Medicine, disease and health'),
        ]);
        CategoryCampaign::create([
            'name' => 'Environment and ecology',
            'slug' => Str::slug('Environment and ecology'),
            'name_icon' => 'Ecology',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Environment and ecology'.Str::slug('Environment and ecology'),
        ]);
        CategoryCampaign::create([
            'name' => 'Business and entrepreneurship',
            'slug' => Str::slug('Business and entrepreneurship'),
            'name_icon' => 'Business',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Business and entrepreneurship'.Str::slug('Business and entrepreneurship'),
        ]);
        CategoryCampaign::create([
            'name' => 'Religion',
            'slug' => Str::slug('Religion'),
            'name_icon' => 'Religion',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Religion'.Str::slug('Religion'),
        ]);
        CategoryCampaign::create([
            'name' => 'Dreams, hopes and wishes',
            'slug' => Str::slug('Dreams, hopes and wishes'),
            'name_icon' => 'Wishes',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Dreams, hopes and wishes'.Str::slug('Dreams, hopes and wishes'),
        ]);
        CategoryCampaign::create([
            'name' => 'Travel and adventure',
            'slug' => Str::slug('Travel and adventure'),
            'name_icon' => 'Travel',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Travel and adventure '.Str::slug('Travel and adventure'),
        ]);
        CategoryCampaign::create([
            'name' => 'Volunteering and services',
            'slug' => Str::slug('Volunteering and services'),
            'name_icon' => 'Volunteering',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Volunteering and services '.Str::slug('Volunteering and services'),
        ]);
       
        //// 
        CategoryCampaign::create([
            'name' => 'Journalism and publishing',
            'slug' => Str::slug('Journalism and publishing'),
            'name_icon' => 'Journalism',
            'type' => 'SOCIAL_IMPACT',
            'status' => 'ACTIVE',
            'search' => 'Journalism and publishing'.Str::slug('Journalism and publishing'),
        ]);
        CategoryCampaign::create([
            'name' => 'Theater and dance',
            'slug' => Str::slug('Theater and dance and dance'),
            'name_icon' => 'Theater',
            'type' => 'PROJECT',
            'status' => 'ACTIVE',
            'search' => 'Theater and dance'.Str::slug('Theater and dance'),
        ]);
        CategoryCampaign::create([
            'name' => 'Games',
            'slug' => Str::slug('Games'),
            'name_icon' => 'Games',
            'type' => 'PROJECT',
            'status' => 'ACTIVE',
            'search' => 'Games'.Str::slug('Games'),
        ]);
        CategoryCampaign::create([
            'name' => 'Photography',
            'slug' => Str::slug('Photography'),
            'name_icon' => 'Photography',
            'type' => 'PROJECT',
            'status' => 'ACTIVE',
            'search' => 'Photography'.Str::slug('Photography'),
        ]);
        CategoryCampaign::create([
            'name' => 'Comics',
            'slug' => Str::slug('Comics'),
            'name_icon' => 'Comics',
            'type' => 'PROJECT',
            'status' => 'ACTIVE',
            'search' => 'Comics '.Str::slug('Comics'),
        ]);
        CategoryCampaign::create([
            'name' => 'Science and Technology',
            'slug' => Str::slug('Science and Technology'),
            'name_icon' => 'Technology',
            'type' => 'PROJECT',
            'status' => 'ACTIVE',
            'search' => 'Science and Technology '.Str::slug('Science and Technology'),
        ]);
        CategoryCampaign::create([
            'name' => 'Town planning',
            'slug' => Str::slug('Town planning'),
            'name_icon' => 'Town planning',
            'type' => 'PROJECT',
            'status' => 'ACTIVE',
            'search' => 'Town planning '.Str::slug('Town planning'),
        ]);
        CategoryCampaign::create([
            'name' => 'Aandicrafts',
            'slug' => Str::slug('Aandicrafts'),
            'name_icon' => 'Aandicrafts',
            'type' => 'PROJECT',
            'status' => 'ACTIVE',
            'search' => 'Aandicrafts '.Str::slug('Aandicrafts'),
        ]);
        CategoryCampaign::create([
            'name' => 'Film and video',
            'slug' => Str::slug('Film and video'),
            'name_icon' => 'Film',
            'type' => 'PROJECT',
            'status' => 'ACTIVE',
            'search' => 'Film and video '.Str::slug('Film and video'),
        ]);
        CategoryCampaign::create([
            'name' => 'Food',
            'slug' => Str::slug('Food'),
            'name_icon' => 'Food',
            'type' => 'PROJECT',
            'status' => 'ACTIVE',
            'search' => 'Food '.Str::slug('Food'),
        ]);
        
    }
}
