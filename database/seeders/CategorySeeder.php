<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        // $categories = [
        //     ['name' => 'Tops'],
        //     ['name' => 'Bottoms'],
        //     ['name' => 'Outerwear'],
        //     ['name' => 'Footwear'],
        //     ['name' => 'Accessories'],
        //     ['name' => 'Dresses'],
        //     ['name' => 'Activewear'],
        //     ['name' => 'Swimwear'],
        //     ['name' => 'Formal Wear'],
        //     ['name' => 'Casual Wear']
        // ];

        $categories = [
            ["name"=>"Men","created_at"=>Carbon::now(),"updated_at"=>Carbon::now()],
            ["name"=>"Women","created_at"=>Carbon::now(),"updated_at"=>Carbon::now()],
            ["name"=>"Jacket","created_at"=>Carbon::now(),"updated_at"=>Carbon::now()],
            ["name"=>"Coat","created_at"=>Carbon::now(),"updated_at"=>Carbon::now()],
            ["name"=>"Shirt","created_at"=>Carbon::now(),"updated_at"=>Carbon::now()],
            // ["name"=>"Jean","created_at"=>Carbon::now(),"updated_at"=>Carbon::now()],
        ];

        DB::table('categories')->insert($categories);
    }
}
