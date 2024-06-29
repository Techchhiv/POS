<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Tops'],
            ['name' => 'Bottoms'],
            ['name' => 'Outerwear'],
            ['name' => 'Footwear'],
            ['name' => 'Accessories'],
            ['name' => 'Dresses'],
            ['name' => 'Activewear'],
            ['name' => 'Swimwear'],
            ['name' => 'Formal Wear'],
            ['name' => 'Casual Wear']
        ];

        DB::table('categories')->insert($categories);
    }
}