<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * Relasi ke Users
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope untuk role admin
     */
    public function scopeAdmin($query)
    {
        return $query->where('name', 'admin');
    }

    /**
     * Scope untuk role pelanggan
     */
    public function scopePelanggan($query)
    {
        return $query->where('name', 'pelanggan');
    }
}
