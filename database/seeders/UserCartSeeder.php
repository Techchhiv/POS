<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\UserCart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        $userCart = [];

        for($i = 0; $i<20; $i++){
            $user = $users->random();
            $product = $products->random();

            $quantity = rand(1,5);

            $userCart[] = [
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'total' => $product->price * $quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        UserCart::insert($userCart);
    }
}
