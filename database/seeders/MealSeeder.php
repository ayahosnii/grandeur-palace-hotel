<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MealSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seed 8 meals for each category
        $categories = ['breakfast', 'lunch', 'dinner'];

        foreach ($categories as $category) {
            for ($i = 1; $i <= 8; $i++) {
                DB::table('meals')->insert([
                    'name' => $faker->word,
                    'price' => $faker->randomFloat(2, 5, 50),
                    'description' => $faker->sentence,
                    'category' => $category,
                    'image' => 'image' . $i . '.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
