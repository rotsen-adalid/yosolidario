<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str as Str;

class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word(20);
        $identification = rand(123456789,987654321);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            //'logo',
            'identification' => $identification,
            //'identification_image',
            'type' => $this->faker->randomElement(['COMPANY','ONG', 'FOUNDATION']),

            'address' => $this->faker->text(250),
            'longitude' => rand(123456789,987654321),
            'latigude' => rand(123456789,987654321),
            'locality' => $this->faker->text(10),

            'telephone' => 12345678,
            'telephone_movil' => 12345678,
            'email' => $this->faker->email,
            'website' => $this->faker->unique()->safeEmail,
            'references_contact' => $this->faker->text(250),

            'about' => $this->faker->text(500),
            'note' => $this->faker->text(500),

            'status_organization' => $this->faker->randomElement(['VERIFIED','UNVERIFIED']),
            'status_agreement' => $this->faker->randomElement(['ACTIVE', 'SUSPENDED', 'IN_PROCESS', 'INACTIVE']),
            
            'search' => $name.' '.Str::slug($name).' '.$identification,

            'user_id' => 1, //User::all()->random(1,2)->id, 
            'country_id' => 1//Country::all()->random(1,4)->id, 
        ];
    }
}
