<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make(123456),
        //     'role' =>1,
        //     'avatar' =>'avatar.jpg',
        //     'status' => 1,
        // ]);
        $this->call([
            PaymentMethodSeeder::class,
            ShippingMethodSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
        ]);
    }
}
