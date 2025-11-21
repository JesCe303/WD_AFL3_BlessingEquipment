<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Cart Model - Represents shopping cart items for customers
 * Each cart item belongs to one user and contains one product with quantity
 */
class Cart extends Model
{
    protected $fillable = ['user_id', 'id_product', 'quantity'];

    /**
     * Relationship: Cart belongs to User (customer)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Cart contains one Product
     */
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
