@extends('layout.pelanggan.app')

@section('title', 'Home - Bearing Shop')

@section('content')
   
    <div class="relative rounded-2xl shadow-xl mb-8 bg-linear-to-r from-blue-600 via-blue-700 to-blue-900">

        <!-- Pembungkus khusus SVG agar overflow-nya tidak mengganggu dropdown -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <svg class="w-full h-full opacity-[0.18]" xmlns="http://www.w3.org/2000/svg">
                <path d="M-50 100 C 200 0, 600 220, 1100 60" stroke="white" stroke-width="2.5" fill="none"
                    stroke-linecap="round" />
                <path d="M-50 340 C 200 240, 600 380, 1100 300" stroke="white" stroke-width="3" fill="none"
                    stroke-linecap="round" />
                <path d="M-50 420 C 250 310, 650 450, 1100 360" stroke="white" stroke-width="2.5" fill="none"
                    stroke-linecap="round" />
                <path d="M-50 500 C 240 390, 640 520, 1100 440" stroke="white" stroke-width="3" fill="none"
                    stroke-linecap="round" />
            </svg>
        </div>

        <div class="px-8 py-12 lg:px-12 lg:py-16 relative z-0">
            <div class="grid lg:grid-cols-2 gap-8 items-center">

                <div class="text-white">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                        Bearing Berkualitas <br>untuk Industri Anda
                    </h1>
                    <p class="text-blue-100 text-lg mb-6">
                        Temukan berbagai jenis bearing dari brand ternama dengan harga kompetitif.
                        Pengiriman cepat ke seluruh Indonesia.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('pelanggan.produk.index') }}"
                            class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-shopping-bag mr-2"></i>Belanja Sekarang
                        </a>

                        <a href="#categories"
                            class="bg-blue-500 bg-opacity-30 backdrop-blur-sm text-white px-8 py-3 rounded-lg font-semibold hover:bg-opacity-40 transition-all border-2 border-white border-opacity-30">
                            <i class="fas fa-th-large mr-2"></i>Lihat Kategori
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="absolute inset-0 bg-white opacity-10 rounded-full blur-3xl"></div>
                        <img src="{{ asset('assets/semua bearing.jpg') }}" alt="Bearing Products"
                            class="relative rounded-2xl shadow-xl">
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Bagian Fitur -->
    <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
            <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-shipping-fast text-blue-600 text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Pengiriman Cepat</h3>
            <p class="text-gray-600 text-sm">Gratis ongkir untuk pembelian di atas 1 juta</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
            <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Produk Original</h3>
            <p class="text-gray-600 text-sm">100% bearing original bergaransi resmi</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
            <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-headset text-orange-600 text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Support 24/7</h3>
            <p class="text-gray-600 text-sm">Tim support siap membantu kapan saja</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
            <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-tag text-purple-600 text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Harga Terbaik</h3>
            <p class="text-gray-600 text-sm">Dapatkan penawaran harga terbaik</p>
        </div>
    </div>

    <!-- Bagian Kategori -->
    <div id="categories" class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Kategori Bearing</h2>
                <p class="text-gray-600">Pilih kategori sesuai kebutuhan Anda</p>
            </div>
        </div>
        <div class="grid md:grid-cols-3 lg:grid-cols-6 gap-4">
            @forelse($kategoris as $kategori)
                <a href="{{ route('pelanggan.produk.index', ['kategori' => $kategori->slug]) }}"
                    class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4 mx-auto group-hover:bg-blue-200 transition-all">
                        @if($kategori->icon)
                            <img src="{{ asset('storage/' . $kategori->icon) }}" alt="{{ $kategori->nama }}" class="w-12 h-12 object-contain">
                        @else
                            <i class="fas fa-cog text-blue-600 text-3xl"></i>
                        @endif
                    </div>
                    <h3 class="font-bold text-gray-900 text-center mb-1 text-sm">{{ $kategori->nama }}</h3>
                    <p class="text-gray-500 text-xs text-center">{{ $kategori->total_produk }} produk</p>
                </a>
            @empty
                <div class="col-span-6 text-center py-8 text-gray-500">
                    <i class="fas fa-box-open text-4xl mb-2"></i>
                    <p>Belum ada kategori</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Bagian Produk Terpopuler -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Produk Terpopuler</h2>
                <p class="text-gray-600">Produk bearing yang paling banyak diminati</p>
            </div>
            <a href="{{ route('pelanggan.produk.index', ['sort' => 'popular']) }}"
                class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($featuredProducts as $produk)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden group">
                    <div class="relative overflow-hidden">
                        @if($produk->primary_image)
                            <img src="{{ asset('storage/' . $produk->primary_image) }}" 
                                 alt="{{ $produk->nama }}"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <img src="{{ asset('assets/semua bearing.jpg') }}" 
                                 alt="{{ $produk->nama }}"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        @endif
                        @if($produk->is_featured)
                            <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold">
                                <i class="fas fa-fire mr-1"></i>Featured
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="text-xs text-gray-500 mb-1">{{ $produk->kategori->nama ?? '' }} - {{ $produk->merk->nama ?? '' }}</p>
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 min-h-12">{{ $produk->nama }}</h3>
                        <div class="flex items-center gap-2 mb-3">
                            @if($produk->harga_diskon)
                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($produk->harga_diskon, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-400 line-through">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                            @else
                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                            <span><i class="fas fa-box mr-1"></i>Stok: {{ $produk->stok }}</span>
                            <span><i class="fas fa-shopping-cart mr-1"></i>{{ $produk->sold_count ?? 0 }} terjual</span>
                        </div>
                        <a href="{{ route('pelanggan.produk.show', $produk->slug) }}"
                            class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-8 text-gray-500">
                    <i class="fas fa-box-open text-4xl mb-2"></i>
                    <p>Belum ada produk featured</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Bagian Produk Terbaru -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Produk Terbaru</h2>
                <p class="text-gray-600">Produk bearing terbaru di katalog kami</p>
            </div>
            <a href="{{ route('pelanggan.produk.index', ['sort' => 'latest']) }}"
                class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($produkTerbaru as $produk)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden group">
                    <div class="relative overflow-hidden">
                        @if($produk->primary_image)
                            <img src="{{ asset('storage/' . $produk->primary_image) }}" 
                                 alt="{{ $produk->nama }}"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <img src="{{ asset('assets/semua bearing.jpg') }}" 
                                 alt="{{ $produk->nama }}"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        @endif
                        <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-semibold">
                            <i class="fas fa-star mr-1"></i>Baru
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-xs text-gray-500 mb-1">{{ $produk->kategori->nama ?? '' }} - {{ $produk->merk->nama ?? '' }}</p>
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 min-h-12">{{ $produk->nama }}</h3>
                        <div class="flex items-center gap-2 mb-3">
                            @if($produk->harga_diskon)
                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($produk->harga_diskon, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-400 line-through">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                            @else
                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                            <span><i class="fas fa-box mr-1"></i>Stok: {{ $produk->stok }}</span>
                            <span class="text-green-600"><i class="fas fa-check-circle mr-1"></i>Tersedia</span>
                        </div>
                        <a href="{{ route('pelanggan.produk.show', $produk->slug) }}"
                            class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-8 text-gray-500">
                    <i class="fas fa-box-open text-4xl mb-2"></i>
                    <p>Belum ada produk terbaru</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection