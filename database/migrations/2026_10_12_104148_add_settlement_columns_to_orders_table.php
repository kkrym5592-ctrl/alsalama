<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('settlement_name')->nullable();
            $table->decimal('settlement_weight', 10, 2)->nullable();
            $table->decimal('settlement_price', 10, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'settlement_name',
                'settlement_weight',
                'settlement_price',
            ]);
        });
    }
};
