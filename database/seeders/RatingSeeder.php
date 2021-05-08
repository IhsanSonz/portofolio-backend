<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::get();
        $users = User::where('role', 'like', 'customer%')->get();

        foreach ($products as $product) {
            foreach ($users as $user) {
                \DB::table('ratings')->insert([
                    'rate' => rand(1, 5),
                    'user_id' => $user->_id,
                    'product_id' => $product->_id,
                ]);
            }
        }
    }
}
