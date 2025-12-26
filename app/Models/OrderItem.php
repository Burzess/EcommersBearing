<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model OrderItem
 *
 * Model untuk mengelola item dalam sebuah order.
 * Menyimpan detail produk saat pembelian (snapshot).
 *
 * @package App\Models
 * @author  Bearing Shop Team
 * @version 1.0.0
 *
 * @property int         $id
 * @property int         $order_id
 * @property int         $produk_id
 * @property string      $produk_nama
 * @property string      $produk_sku
 * @property string|null $produk_image
 * @property float       $harga
 * @property int         $quantity
 * @property float       $subtotal
 */
class OrderItem extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'produk_id',
        'produk_nama',
        'produk_sku',
        'produk_image',
        'harga',
        'quantity',
        'subtotal',
    ];

    /**
     * Atribut yang harus di-cast ke tipe native.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'harga' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan order yang memiliki item ini.
     *
     * @return BelongsTo<Order, OrderItem>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Mendapatkan produk asli (jika masih ada).
     *
     * @return BelongsTo<Produk, OrderItem>
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
