<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            // [
            //     'first_name' => 'John',
            //     'last_name' => 'Doe',
            //     'email' => 'john.doe@example.com',
            //     'phone' => '123-456-7890',
            //     'address' => '123 Main St, Anytown, USA',
            //     'avatar' => 'avatars/john_doe.jpg',
            //     'user_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            // [
            //     'first_name' => 'Jane',
            //     'last_name' => 'Smith',
            //     'email' => 'jane.smith@example.com',
            //     'phone' => '987-654-3210',
            //     'address' => '456 Oak St, Anytown, USA',
            //     'avatar' => 'avatars/jane_smith.jpg',
            //     'user_id' => 2,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            // // Add more customers as needed
            // [
            //     'first_name' => 'Alice',
            //     'last_name' => 'Johnson',
            //     'email' => 'alice.johnson@example.com',
            //     'phone' => '123-555-7890',
            //     'address' => '789 Pine St, Anytown, USA',
            //     'avatar' => 'avatars/alice_johnson.jpg',
            //     'user_id' => 3,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            // [
            //     'first_name' => 'Bob',
            //     'last_name' => 'Brown',
            //     'email' => 'bob.brown@example.com',
            //     'phone' => '123-456-7891',
            //     'address' => '101 Maple St, Anytown, USA',
            //     'avatar' => 'avatars/bob_brown.jpg',
            //     'user_id' => 4,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            [
                'first_name' => 'Carol',
                'last_name' => 'Davis',
                'email' => 'carol.davis@example.com',
                'phone' => '987-654-3211',
                'address' => '202 Birch St, Anytown, USA',
                'avatar' => 'avatars/carol_davis.jpg',
                'user_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Miller',
                'email' => 'david.miller@example.com',
                'phone' => '123-555-7891',
                'address' => '303 Cedar St, Anytown, USA',
                'avatar' => 'avatars/david_miller.jpg',
                'user_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Emma',
                'last_name' => 'Wilson',
                'email' => 'emma.wilson@example.com',
                'phone' => '123-456-7892',
                'address' => '404 Elm St, Anytown, USA',
                'avatar' => 'avatars/emma_wilson.jpg',
                'user_id' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Frank',
                'last_name' => 'Moore',
                'email' => 'frank.moore@example.com',
                'phone' => '987-654-3212',
                'address' => '505 Walnut St, Anytown, USA',
                'avatar' => 'avatars/frank_moore.jpg',
                'user_id' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Grace',
                'last_name' => 'Taylor',
                'email' => 'grace.taylor@example.com',
                'phone' => '123-555-7892',
                'address' => '606 Poplar St, Anytown, USA',
                'avatar' => 'avatars/grace_taylor.jpg',
                'user_id' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Henry',
                'last_name' => 'Anderson',
                'email' => 'henry.anderson@example.com',
                'phone' => '123-456-7893',
                'address' => '707 Cherry St, Anytown, USA',
                'avatar' => 'avatars/henry_anderson.jpg',
                'user_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('customers')->insert($customers);
    }
}
