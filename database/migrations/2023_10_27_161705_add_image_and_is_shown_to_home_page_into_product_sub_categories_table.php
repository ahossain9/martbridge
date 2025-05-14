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
        Schema::table('product_sub_categories', function (Blueprint $table) {
            $table->string('image')->nullable()->after('slug');
            $table->boolean('is_shown_to_home_page')->default(0)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sub_categories', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('is_shown_to_home_page');
        });
    }
};
