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
        Schema::table('reservations', function (Blueprint $table) {
            $table->boolean('pets')->default(false)->after('breakfast');
            $table->decimal('total_price', 12, 2)->nullable()->after('payment_method');
            $table->decimal('tax_amount', 12, 2)->default(1000)->after('total_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['pets', 'total_price', 'tax_amount']);
        });
    }
};
