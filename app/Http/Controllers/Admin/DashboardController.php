<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Pendapatan (sum dari order yang status delivered)
        $totalPendapatan = Order::where('status', 'delivered')->sum('total');
        
        // Total Pesanan
        $totalPesanan = Order::count();
        
        // Total Produk
        $totalProduk = Produk::count();
        
        // Total Pelanggan
        $totalPelanggan = User::whereHas('role', function($q) {
            $q->where('name', 'pelanggan');
        })->count();
        
        // Grafik Penjualan 7 hari
        $penjualan7Hari = Order::where('status', 'delivered')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->selectRaw('DATE(created_at) as tanggal, SUM(total) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        
        // Pesanan Terbaru
        $pesananTerbaru = Order::with('user')
            ->latest()
            ->take(10)
            ->get();
        
        // Produk Stok Menipis
        $produkStokMenipis = Produk::with(['kategori', 'merk'])
            ->whereColumn('stok', '<=', 'min_stok')
            ->where('stok', '>', 0)
            ->orderBy('stok')
            ->take(10)
            ->get();
        
        return view('admin.dashboard.index', compact(
            'totalPendapatan',
            'totalPesanan',
            'totalProduk',
            'totalPelanggan',
            'penjualan7Hari',
            'pesananTerbaru',
            'produkStokMenipis'
        ));
    }
}
