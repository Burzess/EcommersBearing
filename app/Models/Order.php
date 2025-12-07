<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'alamat_id',
        'alamat_penerima',
        'alamat_telepon',
        'alamat_lengkap',
        'alamat_provinsi',
        'alamat_kota',
        'alamat_kecamatan',
        'alamat_kode_pos',
        'subtotal',
        'ongkir',
        'total',
        'kurir',
        'resi',
        'estimasi_sampai',
        'metode_pembayaran',
        'bukti_pembayaran',
        'paid_at',
        'status',
        'cancelled_reason',
        'cancelled_at',
        'catatan',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'ongkir' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'estimasi_sampai' => 'date',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Alamat
     */
    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }

    /**
     * Relasi ke OrderItem
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relasi ke OrderStatus
     */
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning">Menunggu</span>',
            'paid' => '<span class="badge bg-info">Dibayar</span>',
            'processing' => '<span class="badge bg-primary">Diproses</span>',
            'shipped' => '<span class="badge bg-secondary">Dikirim</span>',
            'delivered' => '<span class="badge bg-success">Selesai</span>',
            'cancelled' => '<span class="badge bg-danger">Dibatalkan</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'processing' => 'Sedang Diproses',
            'shipped' => 'Dalam Pengiriman',
            'delivered' => 'Pesanan Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        return $labels[$this->status] ?? 'Unknown';
    }

    /**
     * Scope by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope search
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('order_number', 'like', "%{$keyword}%")
              ->orWhere('alamat_penerima', 'like', "%{$keyword}%")
              ->orWhere('alamat_telepon', 'like', "%{$keyword}%");
        });
    }

    /**
     * Scope date range
     */
    public function scopeDateRange($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start, $end]);
    }

    /**
     * Generate order number
     */
    public static function generateOrderNumber()
    {
        $date = Carbon::now()->format('Ymd');
        $lastOrder = static::whereDate('created_at', Carbon::today())
                          ->orderBy('id', 'desc')
                          ->first();
        
        $number = $lastOrder ? intval(substr($lastOrder->order_number, -4)) + 1 : 1;
        
        return 'ORD-' . $date . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Update status order
     */
    public function updateStatus($status, $keterangan = null, $adminId = null)
    {
        $this->update(['status' => $status]);
        
        // Jika status paid, update paid_at
        if ($status === 'paid' && !$this->paid_at) {
            $this->update(['paid_at' => now()]);
        }
        
        // Jika status cancelled, update cancelled_at
        if ($status === 'cancelled' && !$this->cancelled_at) {
            $this->update(['cancelled_at' => now()]);
        }
        
        // Create status history
        OrderStatus::create([
            'order_id' => $this->id,
            'status' => $status,
            'keterangan' => $keterangan,
            'created_by' => $adminId,
        ]);
    }

    /**
     * Calculate total
     */
    public function calculateTotal()
    {
        $this->subtotal = $this->items()->sum('subtotal');
        $this->total = $this->subtotal + $this->ongkir;
        $this->save();
    }

    /**
     * Check if order is paid
     */
    public function isPaid()
    {
        return $this->paid_at !== null;
    }

    /**
     * Check if order can be cancelled
     */
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'paid']);
    }

    /**
     * Cancel order
     */
    public function cancel($reason)
    {
        if (!$this->canBeCancelled()) {
            return false;
        }
        
        $this->update([
            'status' => 'cancelled',
            'cancelled_reason' => $reason,
            'cancelled_at' => now(),
        ]);
        
        // Restore stok produk
        foreach ($this->items as $item) {
            $item->produk->incrementStok($item->quantity);
        }
        
        // Create status history
        OrderStatus::create([
            'order_id' => $this->id,
            'status' => 'cancelled',
            'keterangan' => $reason,
        ]);
        
        return true;
    }
}
