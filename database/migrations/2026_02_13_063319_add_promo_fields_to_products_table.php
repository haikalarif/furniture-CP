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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_promo')->default(false)->after('is_featured');
            $table->decimal('promo_price', 12, 2)->nullable()->after('price');
            $table->integer('discount_percentage')->nullable()->after('promo_price');
            $table->date('promo_start_date')->nullable()->after('discount_percentage');
            $table->date('promo_end_date')->nullable()->after('promo_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_promo', 'promo_price', 'discount_percentage', 'promo_start_date', 'promo_end_date']);
        });
    }
};
