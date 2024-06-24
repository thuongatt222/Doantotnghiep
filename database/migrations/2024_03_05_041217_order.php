<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('address');
            $table->string('name');
            $table->string('phone_number');
            $table->integer('status');
            $table->string('shipping_code')->nullable();
            $table->double('total');
            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')->references('payment_method_id')->on('payment_method');
            $table->unsignedBigInteger('shipping_method_id');
            $table->foreign('shipping_method_id')->references('shipping_method_id')->on('shipping_method');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('user_id')->on('users');
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->foreign('voucher_id')->references('voucher_id')->on('voucher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
