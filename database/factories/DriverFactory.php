<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Driver;
use Illuminate\Support\Str;

class DriverFactory extends Factory
{
    // /**
    //  * Define the model's default state.
    //  *
    //  * @return array
    //  */
    protected $model = Driver::class;

    public function definition()
    {
      
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => random_int(0,1),
            'birthdate' => $this->faker->dateTimeThisMonth(),
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->email,
            'mobile' => $this->faker->phoneNumber,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'approval' => random_int(0,1),
            'status' => random_int(0,1),
            'vehicle_type' => random_int(0,1),
            'zipcode' => $this->faker->postcode,



        ];
    }
}
