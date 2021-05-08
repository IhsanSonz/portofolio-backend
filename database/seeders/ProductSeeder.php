<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $user = User::where('role', 'designer')->first();
        $categories = Category::get();

        foreach ($categories as $category) {
            for ($i = 0; $i < 2; $i++) {
                \DB::table('products')->insert([
                    'name' => $faker->company,
                    'desc' => $faker->streetName,
                    'price' => $faker->sentence(10, true),
                    'user_id' => $user->_id,
                    'category_id' => $category->_id,
                ]);
            }
        }
    }
}
