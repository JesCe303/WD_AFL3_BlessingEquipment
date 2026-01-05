<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'tb_product_image';
    protected $primaryKey = 'id_product_image';
    public $timestamps = false;
    
    protected $fillable = ['id_product', 'image_url', 'is_primary', 'display_order'];
    
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
