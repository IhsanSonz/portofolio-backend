<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
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
        $tags = Tag::get();

        foreach ($products as $product) {
            $faker->unique(true);
            for ($i = 0; $i < 4; $i++) {
                \DB::table('product_tags')->insert([
                    'product_id' => $product->_id,
                    'tag_id' => $faker->unique()->randomElement($tags)->_id,
                ]);
            }
        }
    }
}
