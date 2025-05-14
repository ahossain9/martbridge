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
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_value_id')->constrained();
            $table->integer('total_stock');
            $table->integer('available_stock');
            $table->integer('reserved_stock')->default(0);
            $table->integer('sold_stock')->default(0);
            $table->integer('damaged_stock')->default(0);
            $table->integer('lost_stock')->default(0);
            $table->float('retail_price')->default(0);
            $table->float('unit_price');
            $table->float('unit_sale_price');
            $table->float('unit_cost')->default(0);
            $table->float('total_price')->default(0);
            $table->float('total_sale_price')->default(0);
            $table->float('total_cost')->default(0);
            $table->float('total_profit')->default(0);
            $table->float('total_profit_percentage')->default(0);
            $table->float('total_discount')->default(0);
            $table->float('total_discount_percentage')->default(0);
            $table->float('total_tax')->default(0);
            $table->float('total_tax_percentage')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stocks');
    }
};
