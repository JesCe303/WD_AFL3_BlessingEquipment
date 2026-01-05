<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Cart Model - Represents shopping cart items for customers
 * Each cart item belongs to one user and contains one product with quantity
 */
class Cart extends Model
{
    protected $table = 'tb_cart';
    protected $primaryKey = 'id_cart';
    public $timestamps = false;
    
    protected $fillable = ['id_user', 'id_product', 'quantity'];

    /**
     * Relationship: Cart belongs to User (customer)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relationship: Cart contains one Product
     */
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
