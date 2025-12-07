<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::query();
        
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        $kategoris = $query->ordered()->paginate(20);
        
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(KategoriRequest $request)
    {
        $data = $request->validated();
        
        // Handle icon upload if exists
        if ($request->hasFile('icon')) {
            $iconName = time() . '.' . $request->file('icon')->getClientOriginalExtension();
            $request->file('icon')->storeAs('public/kategori', $iconName);
            $data['icon'] = 'kategori/' . $iconName;
        }
        
        Kategori::create($data);
        
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(KategoriRequest $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        
        $data = $request->validated();
        
        // Handle icon upload if exists
        if ($request->hasFile('icon')) {
            $iconName = time() . '.' . $request->file('icon')->getClientOriginalExtension();
            $request->file('icon')->storeAs('public/kategori', $iconName);
            $data['icon'] = 'kategori/' . $iconName;
        }
        
        $kategori->update($request->all());
        
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Check jika ada produk terkait
        if ($kategori->produks()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih ada produk terkait.');
        }
        
        $kategori->delete();
        
        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update(['is_active' => !$kategori->is_active]);
        
        return back()->with('success', 'Status kategori berhasil diupdate.');
    }
}
