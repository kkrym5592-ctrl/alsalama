<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY order_type ENUM('delivery', 'pickup', 'تسوية')
            NOT NULL DEFAULT 'delivery'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY order_type ENUM('delivery', 'pickup')
            NOT NULL DEFAULT 'delivery'
        ");
    }
};
