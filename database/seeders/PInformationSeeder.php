<?php

namespace Database\Seeders;

use App\Models\PInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = DB::table('products')->pluck('id');

        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
        $colors = ['Red', 'Blue', 'Green', 'Yellow', 'Black', 'White', 'Purple', 'Gray'];


        $pinformations = [];

        foreach ($product as $p){
            for($i = 0; $i<rand(1,3); $i++){
                $quantities = rand(2, 50); // Quantities from 1 to 50
                $pinformations[] = [
                    'product_id' => $p,
                    'size' => $sizes[array_rand($sizes)],
                    'color' => $colors[array_rand($colors)],
                    'quantity'=> $quantities,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        PInformation::insert($pinformations);
    }
}
