@extends('layout.pelanggan.app')

@section('title', $produk->nama . ' - Bearing Shop')

@section('content')
    <div class="mb-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
            <a href="{{ route('pelanggan.home.index') }}" class="hover:text-primary-600"><i class="fas fa-home"></i></a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('pelanggan.produk.index') }}" class="hover:text-primary-600">Produk</a>
            <i class="fas fa-chevron-right text-xs"></i>
            @if ($produk->kategori)
                <a href="{{ route('pelanggan.produk.index', ['kategori_id' => $produk->kategori_id]) }}" class="hover:text-primary-600">{{ $produk->kategori->nama }}</a>
                <i class="fas fa-chevron-right text-xs"></i>
            @endif
            <span class="text-gray-900 font-medium">{{ Str::limit($produk->nama, 40) }}</span>
        </nav>

        <!-- Detail Produk -->
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            <!-- Gambar Produk -->
            <div>
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-4">
                    <div class="aspect-square bg-gray-100 flex items-center justify-center">
                        @if ($produk->images->first())
                            <img src="{{ asset('storage/' . $produk->images->first()->image_path) }}" alt="{{ $produk->nama }}" 
                                id="mainImage" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <i class="fas fa-image text-gray-400 text-6xl"></i>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($produk->images->count() > 1)
                    <div class="grid grid-cols-4 gap-3">
                        @foreach ($produk->images as $index => $image)
                            <div class="aspect-square rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'border-primary-600' : 'border-gray-200' }} cursor-pointer hover:border-primary-400 transition-all"
                                onclick="changeImage('{{ asset('storage/' . $image->image_path) }}', this)">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Info Produk -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="mb-6">
                    @if ($produk->is_featured)
                        <span class="bg-primary-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Unggulan</span>
                    @endif
                    <h1 class="text-3xl font-bold text-gray-900 mt-2 mb-3">{{ $produk->nama }}</h1>
                    <div class="flex items-center space-x-4 text-sm">
                        <span class="text-gray-600">Brand: <span class="font-semibold text-gray-900">{{ $produk->merk->nama ?? '-' }}</span></span>
                        <span class="text-gray-300">|</span>
                        <span class="text-gray-600">SKU: <span class="font-mono">{{ $produk->sku }}</span></span>
                        <span class="text-gray-300">|</span>
                        <span class="text-gray-600">{{ $produk->sold_count }} Terjual</span>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Kategori: <span class="font-semibold">{{ $produk->kategori->nama ?? '-' }}</span></span>
                        <span class="text-gray-300">|</span>
                        <span class="text-gray-600">Dilihat: {{ $produk->views_count }}x</span>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="border-t border-b border-gray-200 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                @if ($produk->harga_diskon)
                                    <div class="flex items-center space-x-2 mb-1">
                                        <span class="text-lg text-gray-400 line-through">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                        <span class="bg-red-100 text-red-600 text-sm font-bold px-2 py-0.5 rounded">
                                            -{{ round((($produk->harga - $produk->harga_diskon) / $produk->harga) * 100) }}%
                                        </span>
                                    </div>
                                    <div class="text-3xl font-bold text-primary-600">Rp {{ number_format($produk->harga_diskon, 0, ',', '.') }}</div>
                                @else
                                    <div class="text-3xl font-bold text-primary-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-box {{ $produk->stok > $produk->min_stok ? 'text-green-600' : ($produk->stok > 0 ? 'text-orange-600' : 'text-red-600') }}"></i>
                        <span class="font-semibold {{ $produk->stok > $produk->min_stok ? 'text-green-600' : ($produk->stok > 0 ? 'text-orange-600' : 'text-red-600') }}">
                            {{ $produk->stok > 0 ? 'Stok: ' . $produk->stok : 'Stok Habis' }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-500 mt-1">Berat: {{ number_format($produk->berat) }} gram</div>
                </div>

                @auth
                    @if ($produk->stok > 0)
                        <form action="{{ route('pelanggan.keranjang.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            
                            <!-- Pemilih Jumlah -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Jumlah</label>
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button type="button" onclick="decreaseQty()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-l-lg">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $produk->stok }}"
                                            class="w-16 text-center border-x border-gray-300 py-2 focus:outline-none">
                                        <button type="button" onclick="increaseQty()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-r-lg">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <span class="text-sm text-gray-600">Maksimal {{ $produk->stok }} pcs</span>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <button type="submit"
                                    class="bg-primary-600 text-white py-3 rounded-lg font-semibold hover:bg-primary-700 transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                                    <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                                </button>
                                <button type="button" onclick="buyNow()"
                                    class="bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                                    <i class="fas fa-bolt mr-2"></i>Beli Sekarang
                                </button>
                            </div>
                        </form>
                        
                        <script>
                            function buyNow() {
                                const quantity = document.getElementById('quantity').value;
                                window.location.href = "{{ route('pelanggan.buy-now.form', $produk->id) }}?quantity=" + quantity;
                            }
                        </script>
                    @else
                        <div class="mb-6 p-4 bg-red-50 rounded-lg text-center">
                            <p class="text-red-600 font-semibold">Maaf, produk ini sedang tidak tersedia</p>
                        </div>
                    @endif
                @else
                    <div class="mb-6">
                        <a href="{{ route('login') }}"
                            class="block w-full bg-primary-600 text-white py-3 rounded-lg font-semibold hover:bg-primary-700 transition-all text-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login untuk Membeli
                        </a>
                    </div>
                @endauth

                <!-- Aksi Tambahan -->
                <div class="flex items-center justify-center space-x-6 pt-6 border-t border-gray-200">
                    <button onclick="shareProduct()"
                        class="flex items-center text-gray-600 hover:text-primary-500 transition-all">
                        <i class="fas fa-share-alt text-xl mr-2"></i>
                        <span class="text-sm">Bagikan</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tab Produk -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-8">
                    <button onclick="showTab('description')"
                        class="tab-button py-4 border-b-2 font-medium text-sm transition-all border-primary-600 text-primary-600"
                        data-tab="description">
                        Deskripsi Produk
                    </button>
                    <button onclick="showTab('specifications')"
                        class="tab-button py-4 border-b-2 font-medium text-sm transition-all border-transparent text-gray-500 hover:text-gray-700"
                        data-tab="specifications">
                        Spesifikasi
                    </button>
                </nav>
            </div>

            <!-- Isi Tab -->
            <div class="p-8">
                <!-- Tab Deskripsi -->
                <div id="description-content" class="tab-content">
                    <div class="prose max-w-none">
                        {!! $produk->deskripsi ?? '<p class="text-gray-500">Tidak ada deskripsi produk.</p>' !!}
                    </div>
                </div>

                <!-- Tab Spesifikasi -->
                <div id="specifications-content" class="tab-content hidden">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="font-medium text-gray-700">SKU</span>
                            <span class="text-gray-900">{{ $produk->sku }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Kategori</span>
                            <span class="text-gray-900">{{ $produk->kategori->nama ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Brand</span>
                            <span class="text-gray-900">{{ $produk->merk->nama ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Berat</span>
                            <span class="text-gray-900">{{ number_format($produk->berat) }} gram</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Stok</span>
                            <span class="text-gray-900">{{ $produk->stok }} pcs</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Terjual</span>
                            <span class="text-gray-900">{{ $produk->sold_count }} pcs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Terkait -->
        @if ($produkTerkait->count() > 0)
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($produkTerkait as $related)
                        <div class="bg-gray-50 rounded-xl overflow-hidden hover:shadow-lg transition-all group">
                            <div class="relative overflow-hidden">
                                @if ($related->images->first())
                                    <img src="{{ asset('storage/' . $related->images->first()->image_path) }}" alt="{{ $related->nama }}"
                                        class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="text-xs text-gray-500 mb-1">{{ $related->merk->nama ?? '-' }}</p>
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 text-sm">{{ $related->nama }}</h3>
                                <div class="flex items-center justify-between">
                                    @if ($related->harga_diskon)
                                        <span class="font-bold text-primary-600">Rp {{ number_format($related->harga_diskon, 0, ',', '.') }}</span>
                                    @else
                                        <span class="font-bold text-primary-600">Rp {{ number_format($related->harga, 0, ',', '.') }}</span>
                                    @endif
                                    <a href="{{ route('pelanggan.produk.show', $related->slug) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        // Ubah Gambar
        function changeImage(src, element) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.grid.grid-cols-4 > div').forEach(el => {
                el.classList.remove('border-primary-600');
                el.classList.add('border-gray-200');
            });
            element.classList.remove('border-gray-200');
            element.classList.add('border-primary-600');
        }

        // Fungsi Tab
        function showTab(tabName) {
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('border-primary-600', 'text-primary-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            document.querySelector(`[data-tab="${tabName}"]`).classList.remove('border-transparent', 'text-gray-500');
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('border-primary-600', 'text-primary-600');
            document.getElementById(`${tabName}-content`).classList.remove('hidden');
        }

        // Fungsi Jumlah
        function increaseQty() {
            const qty = document.getElementById('quantity');
            const max = parseInt(qty.max);
            const value = parseInt(qty.value);

            if (value < max) {
                qty.value = value + 1;
            }
        }

        function decreaseQty() {
            const qty = document.getElementById('quantity');
            const min = parseInt(qty.min);
            const value = parseInt(qty.value);

            if (value > min) {
                qty.value = value - 1;
            }
        }

        // Bagikan Produk
        function shareProduct() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $produk->nama }}',
                    text: 'Lihat produk {{ $produk->nama }} di Bearing Shop',
                    url: window.location.href
                });
            } else {
                // Fallback: salin ke clipboard
                navigator.clipboard.writeText(window.location.href);
                alert('Link produk berhasil disalin!');
            }
        }
    </script>
@endsection