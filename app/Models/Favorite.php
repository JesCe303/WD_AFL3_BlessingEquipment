<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'tb_favorite';
    protected $primaryKey = 'id_favorite';
    public $timestamps = false;
    
    protected $fillable = ['id_user', 'id_product'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
