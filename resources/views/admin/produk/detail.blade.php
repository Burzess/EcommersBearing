@extends('layout.admin.app')

@section('title', 'Detail Produk - Admin')

@section('content')
    <!-- Header -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('admin.produk.index') }}"
                    class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Detail Produk</h1>
                <p class="text-blue-100">{{ $produk->nama }}</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-box text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Gambar Produk -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6">
                @if ($produk->images->count() > 0)
                    <img src="{{ asset('storage/' . $produk->images->first()->image_path) }}" 
                        alt="{{ $produk->nama }}" class="w-full h-64 object-cover rounded-lg mb-4">
                    
                    @if ($produk->images->count() > 1)
                        <div class="grid grid-cols-4 gap-2">
                            @foreach ($produk->images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                    alt="Gambar" class="w-full h-16 object-cover rounded cursor-pointer hover:opacity-75 transition-all">
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="w-full h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-6xl"></i>
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="mt-6 pt-6 border-t border-gray-200 space-y-2">
                    <a href="{{ route('admin.produk.edit', $produk->id) }}" 
                        class="w-full block px-4 py-2 bg-blue-600 text-white text-center rounded-lg font-semibold hover:bg-blue-700 transition-all">
                        <i class="fas fa-edit mr-2"></i>Edit Produk
                    </a>
                    <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" 
                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all">
                            <i class="fas fa-trash mr-2"></i>Hapus Produk
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Produk -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Dasar -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informasi Produk
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Produk</label>
                        <p class="text-gray-900 font-medium mt-1">{{ $produk->nama }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">SKU</label>
                        <p class="text-gray-900 font-medium mt-1">{{ $produk->sku }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Kategori</label>
                        <p class="text-gray-900 font-medium mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $produk->kategori->nama ?? '-' }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Merk</label>
                        <p class="text-gray-900 font-medium mt-1">{{ $produk->merk->nama ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <p class="mt-1">
                            @if ($produk->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-pause-circle mr-1"></i>Tidak Aktif
                                </span>
                            @endif
                            @if ($produk->is_featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 ml-1">
                                    <i class="fas fa-star mr-1"></i>Featured
                                </span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Slug</label>
                        <p class="text-gray-900 font-medium mt-1">{{ $produk->slug }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-gray-500">Deskripsi</label>
                        <p class="text-gray-900 mt-1">{{ $produk->deskripsi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Harga & Stok -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-tag mr-2 text-blue-600"></i>Harga & Stok
                </h2>

                <div class="grid md:grid-cols-4 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Harga Normal</label>
                        <p class="text-xl font-bold text-gray-900 mt-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Harga Diskon</label>
                        <p class="text-xl font-bold text-green-600 mt-1">
                            {{ $produk->harga_diskon ? 'Rp ' . number_format($produk->harga_diskon, 0, ',', '.') : '-' }}
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Stok</label>
                        <p class="text-xl font-bold mt-1">
                            {{ $produk->stok }}
                            @if ($produk->stok == 0)
                                <span class="text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full ml-2">Habis</span>
                            @elseif ($produk->stok <= $produk->min_stok)
                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full ml-2">Menipis</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Min Stok</label>
                        <p class="text-xl font-bold text-gray-900 mt-1">{{ $produk->min_stok }}</p>
                    </div>
                </div>
            </div>

            <!-- Spesifikasi Teknis -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-cog mr-2 text-blue-600"></i>Spesifikasi Teknis
                </h2>

                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-500">Inner Diameter</label>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $produk->inner_diameter ? $produk->inner_diameter . ' mm' : '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-500">Outer Diameter</label>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $produk->outer_diameter ? $produk->outer_diameter . ' mm' : '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-500">Width</label>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $produk->width ? $produk->width . ' mm' : '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-500">Material</label>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $produk->material ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-500">Seal Type</label>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $produk->seal_type ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-500">Cage Type</label>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $produk->cage_type ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Info Tambahan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-clock mr-2 text-blue-600"></i>Informasi Tambahan
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Dibuat</label>
                        <p class="text-gray-900 font-medium mt-1">{{ $produk->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Terakhir Diupdate</label>
                        <p class="text-gray-900 font-medium mt-1">{{ $produk->updated_at->format('d M Y H:i') }} ({{ $produk->updated_at->diffForHumans() }})</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection