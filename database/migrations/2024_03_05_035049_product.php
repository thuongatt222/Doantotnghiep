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
        Schema::create('product', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->integer('status');
            $table->text('description');
            $table->double('price');
            $table->double('discount')->nullable();
            $table->text('image');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('brand_id')->on('brand');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('category');
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
