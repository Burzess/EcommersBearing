<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Merk;
use App\Models\Produk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Controller Home Pelanggan
 *
 * Menangani tampilan halaman utama untuk pelanggan.
 * Menampilkan produk unggulan, kategori, merk premium, dan produk terbaru.
 *
 * @package App\Http\Controllers\Pelanggan
 * @author  Bearing Shop Team
 * @version 1.0.0
 */
class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama pelanggan.
     *
     * Menampilkan:
     * - Produk featured/unggulan
     * - Daftar kategori aktif
     * - Merk premium
     * - Produk terbaru
     *
     * @return View
     */
    public function index(): View
    {
        // Produk Featured/Unggulan
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
