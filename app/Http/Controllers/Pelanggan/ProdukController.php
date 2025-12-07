<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Merk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with(['kategori', 'merk', 'images'])
            ->active()
            ->inStock();
        
        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        
        // Filter by merk
        if ($request->filled('merk_id')) {
            $query->where('merk_id', $request->merk_id);
        }
        
        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        // Sort
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

    public function show($slug)
    {
        $produk = Produk::with(['kategori', 'merk', 'images'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();
        
        // Increment views
        $produk->incrementViews();
        
        // Produk terkait (same kategori)
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
