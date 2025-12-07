<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kategori_id',
        'merk_id',
        'nama',
        'slug',
        'sku',
        'deskripsi',
        'harga',
        'harga_diskon',
        'stok',
        'min_stok',
        'berat',
        'unit',
        'is_featured',
        'is_active',
        'inner_diameter',
        'outer_diameter',
        'width',
        'material',
        'seal_type',
        'cage_type',
        'views',
        'sold_count',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'harga_diskon' => 'decimal:2',
        'berat' => 'decimal:2',
        'inner_diameter' => 'decimal:2',
        'outer_diameter' => 'decimal:2',
        'width' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke Merk
     */
    public function merk()
    {
        return $this->belongsTo(Merk::class);
    }

    /**
     * Relasi ke ProdukImage
     */
    public function images()
    {
        return $this->hasMany(ProdukImage::class, 'produk_id');
    }

    /**
     * Relasi ke Keranjang
     */
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class, 'produk_id');
    }

    /**
     * Relasi ke OrderItem
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'produk_id');
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
     * Get formatted harga
     */
    public function getHargaFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Get diskon persentase
     */
    public function getDiskonPersenAttribute()
    {
        if ($this->harga_diskon && $this->harga > 0) {
            return round((($this->harga - $this->harga_diskon) / $this->harga) * 100);
        }
        return 0;
    }

    /**
     * Get status stok
     */
    public function getStokStatusAttribute()
    {
        if ($this->stok <= 0) {
            return 'Stok Habis';
        } elseif ($this->stok <= $this->min_stok) {
            return 'Stok Menipis';
        }
        return 'Tersedia';
    }

    /**
     * Get primary image
     */
    public function getPrimaryImageAttribute()
    {
        return $this->images()->where('is_primary', true)->first() 
            ?? $this->images()->first();
    }

    /**
     * Scope produk aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope produk featured
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope produk in stock
     */
    public function scopeInStock($query)
    {
        return $query->where('stok', '>', 0);
    }

    /**
     * Scope produk low stock
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stok', '<=', 'min_stok')
                     ->where('stok', '>', 0);
    }

    /**
     * Scope by kategori
     */
    public function scopeByKategori($query, $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    /**
     * Scope by merk
     */
    public function scopeByMerk($query, $merkId)
    {
        return $query->where('merk_id', $merkId);
    }

    /**
     * Scope search
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('nama', 'like', "%{$keyword}%")
              ->orWhere('sku', 'like', "%{$keyword}%")
              ->orWhere('deskripsi', 'like', "%{$keyword}%");
        });
    }

    /**
     * Increment views
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Decrement stok
     */
    public function decrementStok($qty)
    {
        $this->decrement('stok', $qty);
    }

    /**
     * Increment stok
     */
    public function incrementStok($qty)
    {
        $this->increment('stok', $qty);
    }
}
