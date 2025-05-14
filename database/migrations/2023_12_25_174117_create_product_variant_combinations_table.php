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
        Schema::create('product_variant_combinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('name');
            $table->integer('price')->default(0);
            $table->integer('stock_quantity')->default(0);
            $table->string('sku')->nullable();
            $table->float('discount')->default(0);
            $table->enum('discount_type', ['fixed', 'percentage'])->default('fixed');
            $table->float('weight')->default(0);
            $table->float('length')->default(0);
            $table->float('width')->default(0);
            $table->float('height')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_combinations');
    }
};
