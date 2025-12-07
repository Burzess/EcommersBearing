<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Merk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'logo',
        'deskripsi',
        'is_premium',
        'is_active',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Produk
     */
    public function produks()
    {
        return $this->hasMany(Produk::class, 'merk_id');
    }

    /**
     * Auto generate slug dari nama
     */
    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    /**
     * Scope untuk merk aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk merk premium
     */
    public function scopePremium($query)
    {
        return $query->where('is_premium', true);
    }

    /**
     * Get total produk
     */
    public function getTotalProdukAttribute()
    {
        return $this->produks()->count();
    }
}
