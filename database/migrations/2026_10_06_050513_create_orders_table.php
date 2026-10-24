
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Customer
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Delivery user
            $table->foreignId('delivery_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Shift
            $table->foreignId('shift_id')
                ->nullable()
                ->constrained('shifts')
                ->nullOnDelete();

            // Daily order number
            $table->unsignedInteger('daily_order_number')->nullable();

            // Order classification
            $table->enum('order_type', ['delivery', 'pickup', 'تسوية'])
    ->default('delivery');

            $table->string('order_kind')->default('regular');

            // Settlement details
            $table->string('settlement_name')->nullable();
            $table->decimal('settlement_weight', 10, 3)->nullable();
            $table->decimal('settlement_price', 10, 2)->nullable();

            // Order status
            $table->enum('status', [
                'pending',
                'preparing',
                'completed',
                'out_for_delivery',
                'delivered',
                'cancelled',
            ])->default('pending');

            // Payment
            $table->enum('payment_method', [
                'cash',
                'card',
                'wallet',
            ])->default('cash');

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
            ])->default('pending');

            // Prices
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);

            // Notes
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['shift_id', 'daily_order_number']);
            $table->index(['order_kind', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
