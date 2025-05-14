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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('brand_name');
            $table->foreignId('product_category_id')->constrained()->onDelete('cascade');
            $table->string('category_name');
            $table->foreignId('product_sub_category_id')->constrained()->onDelete('cascade');
            $table->string('sub_category_name');
            $table->string('name');
            $table->string('slug');
            $table->string('label')->nullable()
                ->comment('New, Hot, Sale, etc.');
            $table->string('featured_image')->nullable();
            $table->string('video_link')->nullable();
            $table->longText('description')->nullable();
            $table->longText('short_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('added_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
