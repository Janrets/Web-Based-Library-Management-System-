<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Merchant;
use Faker\Factory as Faker;
use DB;

class MerchantsTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Merchant::create(
        //     [
        //         "first_name" => "jaba"
        //     ]
        //     ); insert data manually

        // $faker = Faker\Factory::create();
        // for ($i=0; $i < 20; $i++) { 
        //     Merchant::create([
        //         "first_name" => $faker->firstName,
        //         "last_name" => $faker->lastName
        //     ]);
        // }

        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            DB::table('merchants')->insert([
                'firstname'=> $faker->firstName
            ]);
        }
    }
}
