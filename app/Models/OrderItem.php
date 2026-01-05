<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * OrderItem Model - Represents individual items in an order
 */
class OrderItem extends Model
{
    protected $table = 'tb_order_items';
    protected $primaryKey = 'id_order_item';
    
    protected $fillable = [
        'id_order',
        'id_product',
        'quantity',
        'price',
        'subtotal'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Relationship: Order Item belongs to Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }

    /**
     * Relationship: Order Item belongs to Product
     */
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
