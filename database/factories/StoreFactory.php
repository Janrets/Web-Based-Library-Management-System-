<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;
use Illuminate\Support\Str;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition()
    {
      
        return [
            'store_name' => $this->faker->colorName,
            'address' => $this->faker->address,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'open_time' => $this->faker->time,
            'close_time' => $this->faker->time,
            'store_users_id' => random_int(0,100),

        ];
    }
}
