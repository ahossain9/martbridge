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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('third_title')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->string('link_text')->nullable();
            $table->float('base_price')->nullable();
            // price with only two decimal places
            $table->float('sale_price', 8, 2)->nullable();
            $table->float('discount_price')->nullable();
            $table->string('discount_text')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('slider_type')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
