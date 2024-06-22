<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::create([
            'color' => 'Xanh',
            'status' => 1
        ]);

        Color::create([
            'color' => 'Đỏ',
            'status' => 1
        ]);
        Color::create([
            'color' => 'Cam',
            'status' => 1
        ]);
        Color::create([
            'color' => 'Vàng',
            'status' => 1
        ]);
        Color::create([
            'color' => 'Đen',
            'status' => 1
        ]);
        Color::create([
            'color' => 'Xanh biển',
            'status' => 1
        ]);
        Color::create([
            'color' => 'Xanh than',
            'status' => 1
        ]);
        Color::create([
            'color' => 'Hồng',
            'status' => 1
        ]);
        Color::create([
            'color' => 'Nâu',
            'status' => 1
        ]);
    }
}
