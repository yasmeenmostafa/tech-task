<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'name' => $faker->word,
                'price' => $faker->randomFloat(2, 10, 1000), // random price between 10 and 1000
                'quantity' => $faker->numberBetween(1, 100), // random quantity between 1 and 100
                'category_id' => rand(1, 5) // Assuming you have 5 categories, replace with the correct number of categories
            ]);
        }
    }
}
