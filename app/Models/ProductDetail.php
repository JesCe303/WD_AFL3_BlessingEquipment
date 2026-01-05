<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'tb_product_detail';
    protected $primaryKey = 'id_product_detail';
    public $timestamps = false;
    
    protected $fillable = ['id_product', 'weight_product', 'material_product'];
    
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
