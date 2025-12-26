<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Merk;
use App\Models\Produk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Controller Produk Pelanggan
 *
 * Menangani tampilan katalog dan detail produk untuk pelanggan.
 * Mendukung filter, pencarian, dan pengurutan produk.
 *
 * @package App\Http\Controllers\Pelanggan
 * @author  Bearing Shop Team
 * @version 1.0.0
 */
class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk dengan filter dan sorting.
     *
     * Mendukung filter berdasarkan:
     * - Kategori
     * - Merk
     * - Pencarian keyword
     *
     * Mendukung sorting berdasarkan:
     * - Terbaru (default)
     * - Harga terendah
     * - Harga tertinggi
     * - Terpopuler
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Produk::with(['kategori', 'merk', 'images'])
            ->active()
            ->inStock();

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter berdasarkan merk
        if ($request->filled('merk_id')) {
            $query->where('merk_id', $request->merk_id);
        }

        // Pencarian produk
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Pengurutan produk
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('harga', 'desc');
                break;
            case 'popular':
                $query->orderBy('sold_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $produks = $query->paginate(12);
        $kategoris = Kategori::active()->ordered()->get();
        $merks = Merk::active()->orderBy('nama')->get();

        return view('pelanggan.produk.index', compact('produks', 'kategoris', 'merks'));
    }

    /**
     * Menampilkan detail produk.
     *
     * Juga menampilkan produk terkait dari kategori yang sama.
     * Mencatat jumlah view produk.
     *
     * @param string $slug Slug produk
     * @return View
     */
    public function show(string $slug): View
    {
        $produk = Produk::with(['kategori', 'merk', 'images'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Increment jumlah views
        $produk->incrementViews();

        // Produk terkait dari kategori yang sama
        $produkTerkait = Produk::with(['kategori', 'merk', 'images'])
            ->where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->active()
            ->inStock()
            ->take(4)
            ->get();

        return view('pelanggan.produk.detail', compact('produk', 'produkTerkait'));
    }
}
