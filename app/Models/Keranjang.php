<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produk_id',
        'quantity',
        'harga',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    /**
     * Get subtotal
     */
    public function getSubtotalAttribute()
    {
        return $this->harga * $this->quantity;
    }

    /**
     * Get total items dalam keranjang user
     */
    public static function getTotalItems($userId)
    {
        return static::where('user_id', $userId)->sum('quantity');
    }

    /**
     * Get grand total keranjang user
     */
    public static function getGrandTotal($userId)
    {
        $items = static::where('user_id', $userId)->get();
        return $items->sum(function($item) {
            return $item->subtotal;
        });
    }
}
