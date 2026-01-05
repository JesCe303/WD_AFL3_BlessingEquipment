<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Order Model - Represents customer orders/transactions
 * Connected to Midtrans payment gateway
 */
class Order extends Model
{
    protected $table = 'tb_orders';
    protected $primaryKey = 'id_order';
    
    protected $fillable = [
        'id_user',
        'order_number',
        'total_amount',
        'status',
        'payment_type',
        'snap_token',
        'transaction_id',
        'transaction_time',
        'payment_response'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'transaction_time' => 'datetime',
        'payment_response' => 'array', // Auto convert JSON to array
    ];

    /**
     * Relationship: Order belongs to User (customer)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relationship: Order has many Order Items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
    }

    /**
     * Generate unique order number
     * Format: ORD-YYYYMMDD-XXXXX
     */
    public static function generateOrderNumber()
    {
        $date = date('Ymd');
        $lastOrder = self::whereDate('created_at', today())
            ->orderBy('id_order', 'desc')
            ->first();
        
        $number = $lastOrder ? (int) substr($lastOrder->order_number, -5) + 1 : 1;
        
        return 'ORD-' . $date . '-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
