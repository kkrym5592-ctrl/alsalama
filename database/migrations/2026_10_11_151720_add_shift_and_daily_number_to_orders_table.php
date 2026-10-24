<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('shift_id')
                ->nullable()
                ->constrained('shifts')
                ->nullOnDelete();

            $table->unsignedInteger('daily_order_number')
                ->nullable();

            $table->unique(
                ['shift_id', 'daily_order_number'],
                'orders_shift_daily_number_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropUnique('orders_shift_daily_number_unique');
            $table->dropConstrainedForeignId('shift_id');
            $table->dropColumn('daily_order_number');
        });
    }
};