@extends('layout.admin.app')

@section('title', 'Manajemen Produk - Admin')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-primary-700 to-primary-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Manajemen Produk</h1>
                <p class="text-primary-100">Kelola katalog produk bearing</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-box text-primary-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Produk</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $produks->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-boxes text-primary-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Stok Menipis</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $produks->where('stok', '<=', 'min_stok')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Stok Habis</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $produks->where('stok', 0)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Produk Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $produks->where('is_active', 1)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-4">
        <form action="{{ route('admin.produk.index') }}" method="GET" class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 flex-1 w-full lg:w-auto">
                <div class="md:col-span-1">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk, SKU..."
                            class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                </div>

                <div>
                    <select name="kategori_id"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="merk_id"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="">Semua Merk</option>
                        @foreach ($merks as $merk)
                            <option value="{{ $merk->id }}" {{ request('merk_id') == $merk->id ? 'selected' : '' }}>
                                {{ $merk->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="is_active"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-2 w-full lg:w-auto">
                <button type="submit"
                    class="flex-1 lg:flex-none px-4 py-2.5 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-all">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
                <a href="{{ route('admin.produk.index') }}"
                    class="flex-1 lg:flex-none px-4 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition-all text-center">
                    <i class="fas fa-undo mr-2"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel Produk -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($produks as $index => $produk)
                        <tr class="hover:bg-gray-50 transition-all">
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $produks->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if ($produk->images->first())
                                        <img src="{{ asset('storage/' . $produk->images->first()->image_path) }}" 
                                            alt="{{ $produk->nama }}" class="w-14 h-14 object-cover rounded-lg mr-4">
                                    @else
                                        <div class="w-14 h-14 bg-gray-100 rounded-lg mr-4 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ Str::limit($produk->nama, 30) }}</div>
                                        <div class="text-sm text-gray-500">SKU: {{ $produk->sku }}</div>
                                        <div class="text-xs text-primary-600 mt-1">{{ $produk->merk->nama ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                    {{ $produk->kategori->nama ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                @if ($produk->harga_diskon)
                                    <div class="text-xs text-green-600">
                                        <i class="fas fa-tag mr-1"></i>Rp {{ number_format($produk->harga_diskon, 0, ',', '.') }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $produk->stok }}</div>
                                @if ($produk->stok == 0)
                                    <span class="inline-flex items-center mt-1 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full">
                                        <i class="fas fa-times-circle mr-1"></i>Habis
                                    </span>
                                @elseif ($produk->stok <= $produk->min_stok)
                                    <span class="inline-flex items-center mt-1 text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Menipis
                                    </span>
                                @else
                                    <span class="inline-flex items-center mt-1 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i>Tersedia
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($produk->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-circle mr-1 text-xs"></i>Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-circle mr-1 text-xs"></i>Nonaktif
                                    </span>
                                @endif
                                @if ($produk->is_featured)
                                    <span class="inline-flex items-center mt-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-star mr-1"></i>Featured
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.produk.show', $produk->id) }}" 
                                        class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg transition-all" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.produk.edit', $produk->id) }}" 
                                        class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-all" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-box-open text-gray-300 text-5xl mb-4"></i>
                                    <p class="text-gray-500 text-lg">Tidak ada data produk</p>
                                    <p class="text-gray-400 text-sm mb-4">Mulai tambahkan produk baru</p>
                                    <a href="{{ route('admin.produk.create') }}" 
                                        class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-all">
                                        <i class="fas fa-plus mr-2"></i>Tambah Produk
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($produks->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $produks->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection