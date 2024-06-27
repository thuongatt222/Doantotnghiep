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
        Schema::create('momos', function (Blueprint $table) {
            $table->id();
            $table->string('partnerCode');
            $table->string('orderId');
            $table->string('requestId');
            $table->string('amount');
            $table->string('orderInfo');
            $table->string('orderType');
            $table->string('transId');
            $table->string('payType');
            $table->string('signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('momos');
    }
};
