<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'delivery_user_id',
        'shift_id',
        'daily_order_number',

        // Order type
        'order_type',
        'order_kind',

        // Order status
        'status',
        'payment_method',
        'payment_status',

        // Normal order prices
        'subtotal',
        'delivery_fee',
        'total',
        'notes',

        // Settlement details
        'settlement_name',
        'settlement_weight',
        'settlement_price',
    ];

    protected $attributes = [
        'status' => 'pending',
        'payment_status' => 'pending',
        'order_kind' => 'regular',
    ];

    protected $casts = [
    'daily_order_number' => 'integer',
];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delivery_user_id');
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check whether this order is a settlement.
     */
    public function isSettlement(): bool
    {
        return $this->order_kind === 'settlement';
    }
}
