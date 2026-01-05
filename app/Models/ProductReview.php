<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $table = 'tb_product_review';
    protected $primaryKey = 'id_review';
    public $timestamps = false;
    
    protected $fillable = ['id_user', 'id_product', 'rating', 'review_text', 'review_date'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
