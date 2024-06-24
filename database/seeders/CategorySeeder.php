<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category_name' => 'Jordan',
            'status' => 1
        ]);
        Category::create([
            'category_name' => 'Chạy bộ',
            'status' => 1
        ]);
        Category::create([
            'category_name' => 'Bóng rổ',
            'status' => 1
        ]);
        Category::create([
            'category_name' => 'Đá bóng',
            'status' => 1
        ]);
        Category::create([
            'category_name' => 'Tennis',
            'status' => 1
        ]);
        Category::create([
            'category_name' => 'Sneakers',
            'status' => 1
        ]);
        Category::create([
            'category_name' => 'Motosport',
            'status' => 1
        ]);
        Category::create([
            'category_name' => 'Cổ điển',
            'status' => 1
        ]);
        Category::create([
            'category_name' => 'VANS VAULT',
            'status' => 1
        ]);
        Category::create([
            'category_name' => 'VANS OLD SKOOL',
            'status' => 1
        ]);
    }
}
