<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending','processing','shipped','delivered','cancelled'])->default('pending')->after('shop_id');
            $table->decimal('total_amount', 10, 2)->after('status');
            $table->string('delivery_address')->after('total_amount');
            $table->string('payment_method')->default('cash')->after('delivery_address');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['status', 'total_amount', 'delivery_address', 'payment_method']);
        });
    }
};