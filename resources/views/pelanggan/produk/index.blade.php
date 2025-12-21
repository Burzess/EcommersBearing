@extends('layout.pelanggan.app')

@section('title', 'Katalog Produk - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl p-8 mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Katalog Produk Bearing</h1>
        <p class="text-blue-100">Temukan bearing berkualitas tinggi dari berbagai brand ternama</p>
    </div>

    <div class="grid lg:grid-cols-4 gap-6">
        <!-- Sidebar Filter -->
        <div class="lg:col-span-1">
            <form action="{{ route('pelanggan.produk.index') }}" method="GET" id="filterForm">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-filter mr-2 text-blue-600"></i>Filter Produk
                    </h3>

                    <!-- Pencarian -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Filter Kategori -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Kategori</label>
                        <select name="kategori_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Brand -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Brand</label>
                        <select name="merk_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Brand</option>
                            @foreach ($merks as $merk)
                                <option value="{{ $merk->id }}" {{ request('merk_id') == $merk->id ? 'selected' : '' }}>
                                    {{ $merk->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Urutkan -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Urutkan</label>
                        <select name="sort" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                        </select>
                    </div>

                    <!-- Tombol Filter -->
                    <div class="space-y-2">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition-all">
                            <i class="fas fa-filter mr-2"></i>Terapkan Filter
                        </button>
                        <a href="{{ route('pelanggan.produk.index') }}" 
                            class="block w-full bg-gray-100 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-200 transition-all text-center">
                            <i class="fas fa-redo mr-2"></i>Reset Filter
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            <!-- Toolbar -->
            <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-sm">Menampilkan</span>
                    <span class="font-semibold text-blue-600">{{ $produks->total() }}</span>
                    <span class="text-gray-600 text-sm">produk</span>
                </div>
                <div class="text-sm text-gray-500">
                    Halaman {{ $produks->currentPage() }} dari {{ $produks->lastPage() }}
                </div>
            </div>

            <!-- Products Grid -->
            @if ($produks->count() > 0)
                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
                    @foreach ($produks as $produk)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all overflow-hidden group">
                            <div class="relative overflow-hidden bg-gray-100">
                                @if ($produk->images->first())
                                    <img src="{{ asset('storage/' . $produk->images->first()->image_path) }}" alt="{{ $produk->nama }}"
                                        class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                                
                                @if ($produk->is_featured)
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                            Unggulan
                                        </span>
                                    </div>
                                @endif

                                @if ($produk->harga_diskon)
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                            -{{ round((($produk->harga - $produk->harga_diskon) / $produk->harga) * 100) }}%
                                        </span>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <a href="{{ route('pelanggan.produk.show', $produk->slug) }}"
                                        class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all">
                                        <i class="fas fa-eye mr-2"></i>Lihat Detail
                                    </a>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs text-gray-500 font-medium">{{ $produk->merk->nama ?? '-' }}</span>
                                    <span class="text-xs {{ $produk->stok > $produk->min_stok ? 'text-green-600' : 'text-orange-600' }} font-medium">
                                        <i class="fas fa-box mr-1"></i>Stok: {{ $produk->stok }}
                                    </span>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 h-12">{{ $produk->nama }}</h3>
                                <div class="flex items-center mb-3">
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        {{ $produk->kategori->nama ?? '-' }}
                                    </span>
                                    <span class="text-xs text-gray-500 ml-2">
                                        {{ $produk->sold_count }} terjual
                                    </span>
                                </div>
                                <div class="mb-4">
                                    @if ($produk->harga_diskon)
                                        <div class="text-sm text-gray-400 line-through">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                        <div class="text-xl font-bold text-blue-600">Rp {{ number_format($produk->harga_diskon, 0, ',', '.') }}</div>
                                    @else
                                        <div class="text-xl font-bold text-blue-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                    @endif
                                </div>
                                @auth
                                    <form action="{{ route('pelanggan.keranjang.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="w-full cursor-pointer bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-all flex items-center justify-center">
                                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-all flex items-center justify-center">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Login untuk Beli
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $produks->withQueryString()->links() }}
                </div>
            @else
                <!-- Status Kosong -->
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-gray-400 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Produk Tidak Ditemukan</h3>
                    <p class="text-gray-600 mb-4">Coba ubah filter pencarian Anda</p>
                    <a href="{{ route('pelanggan.produk.index') }}"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all inline-block">
                        Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection