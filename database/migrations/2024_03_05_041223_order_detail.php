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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id('order_detail_id');
            $table->integer('quantity');
            $table->double('price');
            $table->unsignedBigInteger('product_detail_id');
            $table->foreign('product_detail_id')->references('product_detail_id')->on('product_detail');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('order_id')->on('order');
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
