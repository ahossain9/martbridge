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
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('subtotal_price')->default(0)->after('delivery_method');
            $table->integer('discount_amount')->default(0)->after('subtotal_price');
            $table->integer('discount_type')->nullable()->after('discount_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('subtotal_price');
            $table->dropColumn('discount_amount');
            $table->dropColumn('discount_type');
        });
    }
};
