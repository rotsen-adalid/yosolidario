<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\CategoryCampaign;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str as Str;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->text(50); //$this->faker->unique()->sentence(50);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'extract' => $this->faker->text(250),
            'type_campaign' => 'PERSONAL',
            'period' => $this->faker->randomElement(['10','15','30', '45', '60']),
            'amount_target' => rand(3000,20000),
            'amount_collected' => 0,
            'amount_percentage_collected' => 0,
            'views' => 0,
            'collaborators' => 0,
            'shared' => 0,
            'followers' => 0,
            'locality' => $this->faker->text(50),
            'telephone' => 12345678,
            'status' => 'DRAFT',// $this->faker->randomElement(['DRAFT','IN_REVIEW', 'PUBLISHED']),
            'status_register'=> 'INCOMPLETE',
            'category_campaign_id' => CategoryCampaign::all()->random()->id,
            'country_id' => 1,
            'organization_id' => 1,
            'user_id' => User::all()->random()->id,
        ];
    }
}
