<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StoreUser;
use Illuminate\Support\Str;

class StoreUserFactory extends Factory
{

    protected $model = StoreUser::class;

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
            'merchant_id' => random_int(0,20),



        ];
    }
}
