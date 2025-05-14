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
        Schema::create('product_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('combination_string')->nullable();
            $table->string('unique_string_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->float('base_price')->default(0);
            $table->float('sale_price')->default(0);
            $table->boolean('allow_coupon')->default(false);
            $table->string('stock')->default(0);
            $table->string('moq')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_values');
    }
};
