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
            ['product_id' => 1, 'category_id' => 1],
            ['product_id' => 1, 'category_id' => 10],

            // Product 2
            ['product_id' => 2, 'category_id' => 2],
            ['product_id' => 2, 'category_id' => 10],

            // Product 3
            ['product_id' => 3, 'category_id' => 1],
            ['product_id' => 3, 'category_id' => 7],

            // Product 4
            ['product_id' => 4, 'category_id' => 3],
            ['product_id' => 4, 'category_id' => 10],

            // Product 5
            ['product_id' => 5, 'category_id' => 4],
            ['product_id' => 5, 'category_id' => 8],

            // Product 6
            ['product_id' => 6, 'category_id' => 6],
            ['product_id' => 6, 'category_id' => 10],

            // Product 7
            ['product_id' => 7, 'category_id' => 3],
            ['product_id' => 7, 'category_id' => 5],

            // Product 8
            ['product_id' => 8, 'category_id' => 2],
            ['product_id' => 8, 'category_id' => 7],

            // Product 9
            ['product_id' => 9, 'category_id' => 1],
            ['product_id' => 9, 'category_id' => 10],

            // Product 10
            ['product_id' => 10, 'category_id' => 9],
            ['product_id' => 10, 'category_id' => 10],

            // Product 11
            ['product_id' => 11, 'category_id' => 2],
            ['product_id' => 11, 'category_id' => 7],

            // Product 12
            ['product_id' => 12, 'category_id' => 3],
            ['product_id' => 12, 'category_id' => 6],

            // Product 13
            ['product_id' => 13, 'category_id' => 2],
            ['product_id' => 13, 'category_id' => 10],

            // Product 14
            ['product_id' => 14, 'category_id' => 1],
            ['product_id' => 14, 'category_id' => 10],

            // Product 15
            ['product_id' => 15, 'category_id' => 3],
            ['product_id' => 15, 'category_id' => 10],

            // Product 16
            ['product_id' => 16, 'category_id' => 4],
            ['product_id' => 16, 'category_id' => 6],

            // Product 17
            ['product_id' => 17, 'category_id' => 1],
            ['product_id' => 17, 'category_id' => 5],

            // Product 18
            ['product_id' => 18, 'category_id' => 2],
            ['product_id' => 18, 'category_id' => 10],

            // Product 19
            ['product_id' => 19, 'category_id' => 2],
            ['product_id' => 19, 'category_id' => 5],

            // Product 20
            ['product_id' => 20, 'category_id' => 1],
            ['product_id' => 20, 'category_id' => 10],
            ['product_id' => 20, 'category_id' => 5],
        ];

        DB::table('category_product')->insert($category_product);
    }
}