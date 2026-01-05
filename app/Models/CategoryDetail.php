<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    protected $table = 'tb_category_detail';
    protected $primaryKey = 'id_category_detail';
    public $timestamps = false;
    
    protected $fillable = ['id_category', 'additional_info'];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}
