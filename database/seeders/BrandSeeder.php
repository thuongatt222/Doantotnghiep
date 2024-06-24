<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'brand_name' => 'Puma',
            'status' => 1
        ]);
        Brand::create([
            'brand_name' => 'Nike',
            'status' => 1
        ]);
        Brand::create([
            'brand_name' => 'Adidas',
            'status' => 1
        ]);
        Brand::create([
            'brand_name' => 'New Balance',
            'status' => 1
        ]);
        Brand::create([
            'brand_name' => 'Converse',
            'status' => 1
        ]);
        Brand::create([
            'brand_name' => 'Vans',
            'status' => 1
        ]);
    }
}
