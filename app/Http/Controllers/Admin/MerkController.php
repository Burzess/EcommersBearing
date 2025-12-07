<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MerkRequest;
use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    public function index(Request $request)
    {
        $query = Merk::query();
        
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        $merks = $query->orderBy('nama')->paginate(20);
        
        return view('admin.merk.index', compact('merks'));
    }

    public function create()
    {
        return view('admin.merk.create');
    }

    public function store(MerkRequest $request)
    {
        $data = $request->validated();
        
        // Upload logo
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/merk', $logoName);
            $data['logo'] = 'merk/' . $logoName;
        }
        
        Merk::create($data);
        
        return redirect()->route('admin.merk.index')->with('success', 'Merk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $merk = Merk::findOrFail($id);
        
        return view('admin.merk.edit', compact('merk'));
    }

    public function update(MerkRequest $request, $id)
    {
        $merk = Merk::findOrFail($id);
        
        $data = $request->validated();
        
        // Upload logo
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/merk', $logoName);
            $data['logo'] = 'merk/' . $logoName;
        }
        
        $merk->update($data);
        
        return redirect()->route('admin.merk.index')->with('success', 'Merk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $merk = Merk::findOrFail($id);
        
        // Check jika ada produk terkait
        if ($merk->produks()->count() > 0) {
            return back()->with('error', 'Merk tidak bisa dihapus karena masih ada produk terkait.');
        }
        
        $merk->delete();
        
        return back()->with('success', 'Merk berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $merk = Merk::findOrFail($id);
        $merk->update(['is_active' => !$merk->is_active]);
        
        return back()->with('success', 'Status merk berhasil diupdate.');
    }
}
