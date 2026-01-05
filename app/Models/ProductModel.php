<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Product Model - Represents spare parts products
 * Each product belongs to one branch and one category
 */
class ProductModel extends Model
{
    // Table name in database
    protected $table = 'tb_product';

    // Primary key column name
    protected $primaryKey = 'id_product';
    
    // Disable timestamps
    public $timestamps = false;

    // Allow mass assignment for all fields except id_product
    // This means all columns can be filled using create() or update()
    protected $guarded = ['id_product'];

    /**
     * Relationship: Product belongs to Branch
     * Each product is assigned to one specific branch (Surabaya or Jakarta)
     * Used to filter products by branch in product list
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_branch', 'id_branch');
    }

    /**
     * Relationship: Product belongs to Category
     * Each product has one category (e.g., Bakery Equipment, Restaurant Equipment)
     * Used to display category name in product table
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    /**
     * Relationship: Product has many Images
     * Each product can have multiple product images
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_product', 'id_product')
            ->orderBy('display_order');
    }
}
