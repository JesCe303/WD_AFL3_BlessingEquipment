<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    // initialize table products
    protected $table = 'tb_product';

    // initialize primary key inside table products
    protected $primaryKey = 'id_product';

    // initialize data that can be filled
    // protected $fillable = [
    //     'product_name',
    //     'product_price',
    //     'product_stock'
    // ];

    // initialize data that cannot be filled
    protected $guarded = ['id_product'];
}
