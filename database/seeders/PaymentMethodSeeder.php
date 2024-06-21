<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'payment_method' => 'COD',
            'status' => 1
        ]);

        Payment::create([
            'payment_method' => 'Momo',
            'status' => 1
        ]);
    }
}
