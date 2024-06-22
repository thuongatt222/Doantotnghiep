<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create([
            'size' => '33',
            'status' => 1
        ]);
        Size::create([
            'size' => '34',
            'status' => 1
        ]);
        Size::create([
            'size' => '35',
            'status' => 1
        ]);
        Size::create([
            'size' => '36',
            'status' => 1
        ]);
        Size::create([
            'size' => '37',
            'status' => 1
        ]);
        Size::create([
            'size' => '38',
            'status' => 1
        ]);
        Size::create([
            'size' => '39',
            'status' => 1
        ]);
        Size::create([
            'size' => '40',
            'status' => 1
        ]);
        Size::create([
            'size' => '41',
            'status' => 1
        ]);
        Size::create([
            'size' => '42',
            'status' => 1
        ]);
        Size::create([
            'size' => '43',
            'status' => 1
        ]);
    }
}
