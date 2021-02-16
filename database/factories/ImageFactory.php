<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => 'campaign_image/' . $this->faker->image('storage/app/public/campaign_image', 640, 480, null, false) // posts/image.jpg 
            // 'url' => 'public/posts/' . $this->faker->image('public/posts', 640, 480, null, false)
        ];
    }
}
