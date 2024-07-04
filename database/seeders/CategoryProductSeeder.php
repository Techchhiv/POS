<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_product = [
            // Product 1
            ['product_id' => 1, 'category_id' => 2],
            ['product_id' => 1, 'category_id' => 3],

            // Product 2
            ['product_id' => 2, 'category_id' => 1],
            ['product_id' => 2, 'category_id' => 3],

            // Product 3
            ['product_id' => 3, 'category_id' => 2],
            ['product_id' => 3, 'category_id' => 3],

            // Product 4
            ['product_id' => 4, 'category_id' => 3],
            ['product_id' => 4, 'category_id' => 4],

            // Product 5
            ['product_id' => 5, 'category_id' => 1],
            ['product_id' => 5, 'category_id' => 2],
            ['product_id' => 5, 'category_id' => 4],

            // Product 6
            ['product_id' => 6, 'category_id' => 2],
            ['product_id' => 6, 'category_id' => 3],

            // Product 7
            ['product_id' => 7, 'category_id' => 1],
            ['product_id' => 7, 'category_id' => 5],

            // Product 8
            ['product_id' => 8, 'category_id' => 1],
            ['product_id' => 8, 'category_id' => 5],

            // Product 9
            ['product_id' => 9, 'category_id' => 1],
            ['product_id' => 9, 'category_id' => 3],
        ];

        DB::table('category_product')->insert($category_product);
    }
}