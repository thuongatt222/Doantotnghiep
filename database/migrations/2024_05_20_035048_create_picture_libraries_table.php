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
        Schema::create('picture_libraries', function (Blueprint $table) {
            $table->id('picture_id');
            $table->string('title');
            $table->text('image');
            $table->unsignedBigInteger('product_detail_id');
            $table->foreign('product_detail_id')->references('product_detail_id')->on('product_detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picture_libraries');
    }
};
