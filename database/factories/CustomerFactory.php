<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    // /**
    //  * Define the model's default state.
    //  *
    //  * @return array
    //  */
    protected $model = Customer::class;

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
            'is_verified' => random_int(0,1),
            'approval' => random_int(0,1),
            'status' => random_int(0,1),


        ];
    }
}
