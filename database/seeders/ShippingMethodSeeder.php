<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shipping::create([
            'shipping_method' => 'Nhanh',
            'status' => 1
        ]);

        Shipping::create([
            'shipping_method' => 'Tiêu chuẩn',
            'status' => 1
        ]);
    }
}
