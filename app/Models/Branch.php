<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'tb_branch';
    protected $primaryKey = 'id_branch';
    protected $guarded = ['id_branch'];
    protected $fillable = ['name_branch', 'address_branch', 'type_branch', 'image_branch'];

    // Relasi: Branch has many Products
    public function products()
    {
        return $this->hasMany(ProductModel::class, 'id_branch', 'id_branch');
    }
}
