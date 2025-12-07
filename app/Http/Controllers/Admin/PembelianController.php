<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items']);
        
        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->dateRange($request->tanggal_mulai, $request->tanggal_akhir);
        }
        
        $orders = $query->latest()->paginate(20);
        
        return view('admin.pembelian.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.produk', 'statuses.createdBy'])->findOrFail($id);
        
        return view('admin.pembelian.detail', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,delivered,cancelled',
            'keterangan' => 'nullable|string',
        ]);
        
        $order->updateStatus($request->status, $request->keterangan, auth()->id());
        
        return back()->with('success', 'Status order berhasil diupdate.');
    }

    public function updateResi(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'kurir' => 'required|string',
            'resi' => 'required|string',
            'estimasi_sampai' => 'nullable|date',
        ]);
        
        $order->update([
            'kurir' => $request->kurir,
            'resi' => $request->resi,
            'estimasi_sampai' => $request->estimasi_sampai,
        ]);
        
        // Update status ke shipped jika belum
        if ($order->status !== 'shipped') {
            $order->updateStatus('shipped', 'Pesanan telah dikirim dengan kurir ' . $request->kurir, auth()->id());
        }
        
        return back()->with('success', 'Nomor resi berhasil diupdate.');
    }

    public function export()
    {
        // TODO: Implement Excel export
        return back()->with('info', 'Fitur export akan segera tersedia.');
    }
}
