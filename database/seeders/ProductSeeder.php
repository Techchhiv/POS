<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $products = [
        //     [
        //         'name' => 'Basic T-Shirt',
        //         'description' => 'A comfortable and versatile basic t-shirt.',
        //         'image' => 'images/products/basic-t-shirt.jpg',
        //         'barcode' => '123456789012',
        //         'price' => 10.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Slim Fit Jeans',
        //         'description' => 'Stylish slim fit jeans for everyday wear.',
        //         'image' => 'images/products/slim-fit-jeans.jpg',
        //         'barcode' => '123456789013',
        //         'price' => 39.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Hooded Sweatshirt',
        //         'description' => 'Cozy hooded sweatshirt for chilly days.',
        //         'image' => 'images/products/hooded-sweatshirt.jpg',
        //         'barcode' => '123456789014',
        //         'price' => 29.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Leather Jacket',
        //         'description' => 'Classic leather jacket with a modern twist.',
        //         'image' => 'images/products/leather-jacket.jpg',
        //         'barcode' => '123456789015',
        //         'price' => 89.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Sneakers',
        //         'description' => 'Comfortable and stylish sneakers.',
        //         'image' => 'images/products/sneakers.jpg',
        //         'barcode' => '123456789016',
        //         'price' => 49.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Summer Dress',
        //         'description' => 'Light and airy summer dress.',
        //         'image' => 'images/products/summer-dress.jpg',
        //         'barcode' => '123456789017',
        //         'price' => 24.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Denim Jacket',
        //         'description' => 'Classic denim jacket for casual outfits.',
        //         'image' => 'images/products/denim-jacket.jpg',
        //         'barcode' => '123456789018',
        //         'price' => 59.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Casual Shorts',
        //         'description' => 'Comfortable casual shorts for summer.',
        //         'image' => 'images/products/casual-shorts.jpg',
        //         'barcode' => '123456789019',
        //         'price' => 19.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Graphic Tee',
        //         'description' => 'Cool graphic tee with unique designs.',
        //         'image' => 'images/products/graphic-tee.jpg',
        //         'barcode' => '123456789020',
        //         'price' => 14.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Formal Shirt',
        //         'description' => 'Elegant formal shirt for special occasions.',
        //         'image' => 'images/products/formal-shirt.jpg',
        //         'barcode' => '123456789021',
        //         'price' => 34.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Chino Pants',
        //         'description' => 'Smart chino pants for a polished look.',
        //         'image' => 'images/products/chino-pants.jpg',
        //         'barcode' => '123456789022',
        //         'price' => 44.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Puffer Jacket',
        //         'description' => 'Warm puffer jacket for cold weather.',
        //         'image' => 'images/products/puffer-jacket.jpg',
        //         'barcode' => '123456789023',
        //         'price' => 79.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Sweatpants',
        //         'description' => 'Comfortable sweatpants for lounging.',
        //         'image' => 'images/products/sweatpants.jpg',
        //         'barcode' => '123456789024',
        //         'price' => 25.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Floral Blouse',
        //         'description' => 'Chic floral blouse for a feminine touch.',
        //         'image' => 'images/products/floral-blouse.jpg',
        //         'barcode' => '123456789025',
        //         'price' => 29.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Trench Coat',
        //         'description' => 'Stylish trench coat for rainy days.',
        //         'image' => 'images/products/trench-coat.jpg',
        //         'barcode' => '123456789026',
        //         'price' => 99.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Ankle Boots',
        //         'description' => 'Trendy ankle boots for a fashionable look.',
        //         'image' => 'images/products/ankle-boots.jpg',
        //         'barcode' => '123456789027',
        //         'price' => 69.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Knit Sweater',
        //         'description' => 'Cozy knit sweater for cool evenings.',
        //         'image' => 'images/products/knit-sweater.jpg',
        //         'barcode' => '123456789028',
        //         'price' => 35.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Maxi Skirt',
        //         'description' => 'Elegant maxi skirt for a stylish outfit.',
        //         'image' => 'images/products/maxi-skirt.jpg',
        //         'barcode' => '123456789029',
        //         'price' => 39.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Cargo Pants',
        //         'description' => 'Utility cargo pants with multiple pockets.',
        //         'image' => 'images/products/cargo-pants.jpg',
        //         'barcode' => '123456789030',
        //         'price' => 45.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Bomber Jacket',
        //         'description' => 'Trendy bomber jacket for a cool look.',
        //         'image' => 'images/products/bomber-jacket.jpg',
        //         'barcode' => '123456789031',
        //         'price' => 59.99,
        //         'status' => true
        //     ],
        //     [
        //         'name' => 'Tank Top',
        //         'description' => 'Lightweight tank top for hot days.',
        //         'image' => 'images/products/tank-top.jpg',
        //         'barcode' => '123456789032',
        //         'price' => 12.99,
        //         'status' => true
        //     ],
        // ];

        $products = [
            [
                "name" => "Cinq à Sept Women's Cheyenne Lilac Vine Blazer",
                "price" => 19.99,
                "description" => "A stunning blazer featuring delicate floral embroidery on the side panels and a flattering, tailored fit.",
                "image" => "CinqASept.png",
                'barcode' => Str::random(5) . random_int(1, 10),
                'status' => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Off-White Patch-detail Bomber Jacket in Red",
                "price" => 59.99,
                "description" => "Red varsity jacket with white sleeves and blue detailing",
                "image" => "OffWhite.png",
                'barcode' => Str::random(5) . random_int(1, 10),
                'status' => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Black Suede Jacket with Gold Buttons",
                "price" => 79.99,
                "description" => "Black suede jacket with a soft, supple feel",
                "image" => "BlackSuede.png",
                'barcode' => Str::random(5) . random_int(1, 10),
                'status' => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Tan Trench Coat with Belted Waist",
                "price" => 29.99,
                "description" => "Comfortable sneakers for kids",
                "image" => "TanTrench.png",
                'barcode' => Str::random(5) . random_int(1, 10),
                'status' => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Double-Breasted Blazer with Gold Buttons",
                "price" => 69.99,
                "description" => "Double-breasted blazer in a forest green color",
                "image" => "Blazer.png",
                'barcode' => Str::random(5) . random_int(1, 10),
                'status' => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Rhude Cigaretta-print Silk Shirt in Red",
                "price" => 29.99,
                "description" => "Red silk shirt with an all-over print of cigarettes",
                "image" => "RhudeCigaretta.png",
                'barcode' => Str::random(5) . random_int(1, 10),
                'status' => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Black and White Checkered Button-Down Shirt",
                "price" => 44.99,
                "description" => "Material is difficult to determine from the image, but it could be cotton, polyester, or a blend",
                "image" => "Checkered.png",
                'barcode' => Str::random(5) . random_int(1, 10),
                'status' => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Grey Wool Peacoat with Double Breasted Closure",
                "price" => 54.99,
                "description" => "Navy blue puffer jacket with a regular fit that Stand collar with a toggle closure Full zip closure with a branded zipper pull",
                "image" => "Denim.png",
                'barcode' => Str::random(5) . random_int(1, 10),
                'status' => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Premium Checkerboard Cotton T-shirt",
                "price" => 29.99,
                "description" => "Experience comfort and style with our Premium Checkerboard Cotton T-shirt. Made from high-quality cotton, this T-shirt combines a classic checkerboard pattern with modern design. Perfect for casual occasions and a versatile addition to your wardrobe.",
                "image" => "CheckerBoard.png",
                'barcode' => Str::random(5) . random_int(1, 10),
                'status' => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
