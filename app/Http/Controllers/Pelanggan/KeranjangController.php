<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Controller Keranjang Pelanggan
 *
 * Menangani operasi keranjang belanja pelanggan.
 * Termasuk tambah, update, hapus item, dan kosongkan keranjang.
 *
 * @package App\Http\Controllers\Pelanggan
 * @author  Bearing Shop Team
 * @version 1.0.0
 */
class KeranjangController extends Controller
{
    /**
     * Menampilkan isi keranjang belanja.
     *
     * @return View
     */
    public function index(): View
    {
        $keranjangs = Keranjang::with('produk.images')
            ->where('user_id', auth()->id())
            ->get();

        $subtotal = Keranjang::getGrandTotal(auth()->id());

        return view('pelanggan.keranjang.index', compact('keranjangs', 'subtotal'));
    }

    /**
     * Menambahkan produk ke keranjang.
     *
     * Jika produk sudah ada di keranjang, quantity akan ditambahkan.
     * Validasi stok dilakukan sebelum menambahkan.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        // Validasi ketersediaan stok
        if ($produk->stok < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $produk->stok);
        }

        // Cek apakah produk sudah ada di keranjang
        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('produk_id', $request->produk_id)
            ->first();

        if ($keranjang) {
            // Update quantity jika produk sudah ada
            $newQuantity = $keranjang->quantity + $request->quantity;

            if ($produk->stok < $newQuantity) {
                return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $produk->stok);
            }

            $keranjang->update(['quantity' => $newQuantity]);
        } else {
            // Tambah item baru ke keranjang
            Keranjang::create([
                'user_id' => auth()->id(),
                'produk_id' => $request->produk_id,
                'quantity' => $request->quantity,
                'harga' => $produk->harga_diskon ?? $produk->harga,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Memperbarui quantity item di keranjang.
     *
     * @param Request $request
     * @param int     $id ID keranjang
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $keranjang = Keranjang::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Validasi ketersediaan stok
        if ($keranjang->produk->stok < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $keranjang->produk->stok);
        }

        $keranjang->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang berhasil diupdate.');
    }

    /**
     * Menghapus item dari keranjang.
     *
     * @param int $id ID keranjang
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $keranjang = Keranjang::where('user_id', auth()->id())->findOrFail($id);
        $keranjang->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Mengosongkan seluruh keranjang.
     *
     * @return RedirectResponse
     */
    public function clear(): RedirectResponse
    {
        Keranjang::where('user_id', auth()->id())->delete();

        return back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
