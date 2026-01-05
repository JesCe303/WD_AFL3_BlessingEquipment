<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name_user',
        'email_user',
        'password',
        'id_role',
    ];

    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName(): string
    {
        return 'id_user';
    }

    /**
     * Get the column name for the "email" field (for authentication).
     */
    public function getEmailForPasswordReset(): string
    {
        return $this->email_user;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship: User belongs to Role
     */
    public function roleRelation()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    /**
     * Accessor: Get role name (for backward compatibility)
     */
    public function getRoleAttribute()
    {
        return $this->roleRelation ? $this->roleRelation->name_role : null;
    }
}
