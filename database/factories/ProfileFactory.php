<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str as Str;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'telephone' => rand(1234567, 7654321),
            'facebook' => Str::slug($this->faker->text('10')),
            'twitter' => Str::slug($this->faker->text('10')),
            'instagram' => Str::slug($this->faker->text('10')),
            'biography' => $this->faker->text('250'),
            'status' => $this->faker->randomElement(['PUBLIC', 'PRIVATE']),
            
            'user_id' => 1,//User::all()->random(1,4)->id, 
            //'country_id' => 1, //Country::all()->random(1,2)->id, 
        ];
    }
}
