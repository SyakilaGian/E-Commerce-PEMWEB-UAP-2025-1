<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // status pesanan: pending, paid, shipped, completed, cancelled
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled'])
                  ->default('pending')
                  ->after('payment_status');

            // nomor resi pengiriman
            $table->string('shipping_receipt')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['status', 'shipping_receipt']);
        });
    }
};