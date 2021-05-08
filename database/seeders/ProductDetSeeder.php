<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductDetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $products = Product::get();
        $sizes = ['s', 'm', 'l', 'xl', 'xxl'];
        $photos = ['stefan.jpg', 'klaus.jpg'];

        foreach ($products as $product) {
            for ($i = 0; $i < 3; $i++) {
                \DB::table('product_dets')->insert([
                    'size' => $faker->randomElement($sizes),
                    'color' => $faker->safeColorName,
                    'stock' => $faker->numberBetween(100, 200),
                    'photos' => $faker->randomElement($photos),
                    'product_id' => $product->_id,
                ]);
            }
        }
    }
}
