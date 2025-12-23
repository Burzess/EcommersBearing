<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Model Merk
 *
 * Model untuk mengelola data merk/brand produk bearing.
 * Mendukung klasifikasi premium dan status aktif.
 *
 * @package App\Models
 * @author  Bearing Shop Team
 * @version 1.0.0
 *
 * @property int         $id
 * @property string      $nama
 * @property string      $slug
 * @property string|null $logo
 * @property string|null $deskripsi
 * @property bool        $is_premium
 * @property bool        $is_active
 */
class Merk extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'slug',
        'logo',
        'deskripsi',
        'is_premium',
        'is_active',
    ];

    /**
     * Atribut yang harus di-cast ke tipe native.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_premium' => 'boolean',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan semua produk dengan merk ini.
     *
     * @return HasMany<Produk>
     */
    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'merk_id');
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * Mutator untuk auto-generate slug dari nama.
     *
     * @param string $value
     * @return void
     */
    public function setNamaAttribute(string $value): void
    {
        $this->attributes['nama'] = $value;

        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * Scope untuk filter merk yang aktif.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk filter merk premium.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePremium(Builder $query): Builder
    {
        return $query->where('is_premium', true);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan total produk dari merk ini.
     *
     * @return int
     */
    public function getTotalProdukAttribute(): int
    {
        return $this->produks()->count();
    }
}
