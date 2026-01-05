<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'tb_role';
    protected $primaryKey = 'id_role';
    public $timestamps = false;
    
    protected $fillable = ['name_role'];
    
    public function users()
    {
        return $this->hasMany(User::class, 'id_role', 'id_role');
    }
}
