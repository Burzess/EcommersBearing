<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

/**
 * Controller Dashboard Admin
 *
 * Menangani tampilan dan data untuk halaman dashboard administrator.
 * Menyediakan ringkasan statistik, grafik penjualan, dan informasi penting lainnya.
 *
 * @package App\Http\Controllers\Admin
 * @author  Bearing Shop Team
 * @version 1.0.0
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     *
     * Mengambil data statistik seperti:
     * - Total pesanan
     * - Total produk
     * - Total pelanggan
     * - Grafik penjualan 7 hari terakhir
     * - Pesanan terbaru
     * - Produk dengan stok menipis
     *
     * @return View
     */
    public function index(): View
    {
        $stats = DB::selectOne(
            'SELECT
                (SELECT COUNT(*) FROM orders) AS total_pesanan,
                (SELECT COUNT(*) FROM produks) AS total_produk,
                (SELECT COUNT(*) FROM users u INNER JOIN roles r ON r.id = u.role_id WHERE r.name = ?) AS total_pelanggan',
            ['pelanggan']
        );

        $totalPesanan = (int) ($stats->total_pesanan ?? 0);
        $totalProduk = (int) ($stats->total_produk ?? 0);
        $totalPelanggan = (int) ($stats->total_pelanggan ?? 0);

        // Grafik Penjualan 7 hari terakhir
        $penjualan7Hari = Order::where('status', 'delivered')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->selectRaw('DATE(created_at) as tanggal, SUM(total) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Pesanan Terbaru
        $pesananTerbaru = Order::query()
            ->select(['id', 'order_number', 'user_id', 'total', 'status', 'created_at'])
            ->with('user:id,name')
            ->latest()
            ->take(10)
            ->get();

        // Produk dengan Stok Menipis
        $produkStokMenipis = Produk::query()
            ->select(['id', 'merk_id', 'nama', 'stok', 'min_stok'])
            ->with('merk:id,nama')
            ->whereColumn('stok', '<=', 'min_stok')
            ->where('stok', '>', 0)
            ->orderBy('stok')
            ->take(10)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalPesanan',
            'totalProduk',
            'totalPelanggan',
            'penjualan7Hari',
            'pesananTerbaru',
            'produkStokMenipis'
        ));
    }
}
