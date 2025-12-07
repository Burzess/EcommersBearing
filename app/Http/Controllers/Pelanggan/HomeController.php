<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Merk;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Featured Products
        $featuredProducts = Produk::with(['kategori', 'merk', 'images'])
            ->active()
            ->featured()
            ->inStock()
            ->take(8)
            ->get();
        
        // Kategori Aktif
        $kategoris = Kategori::active()->ordered()->get();
        
        // Merk Premium
        $merksPremium = Merk::active()->premium()->take(6)->get();
        
        // Produk Terbaru
        $produkTerbaru = Produk::with(['kategori', 'merk', 'images'])
            ->active()
            ->inStock()
            ->latest()
            ->take(8)
            ->get();
        
        return view('pelanggan.home.index', compact(
            'featuredProducts',
            'kategoris',
            'merksPremium',
            'produkTerbaru'
        ));
    }
}
