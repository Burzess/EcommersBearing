@extends('layout.pelanggan.app')

@section('title', 'Beli Sekarang - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('pelanggan.produk.show', $produk->slug) }}"
                    class="inline-flex mb-4 items-center text-white hover:text-white transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Produk
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Beli Sekarang</h1>
                <p class="text-blue-100">Selesaikan pembelian Anda</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-bolt text-white text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        @include('pelanggan.component.alert', ['type' => 'success', 'slot' => session('success')])
    @endif

    @if (session('error'))
        @include('pelanggan.component.alert', ['type' => 'error', 'slot' => session('error')])
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span class="font-semibold">Terjadi kesalahan:</span>
            </div>
            <ul class="list-disc list-inside ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggan.buy-now') }}" method="POST">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">
        
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Alamat & Produk -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Alamat Pengiriman -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Alamat Pengiriman
                    </h2>
                    
                    @if ($alamats->count() > 0)
                        <div class="space-y-3">
                            @foreach ($alamats as $alamat)
                                <label class="block cursor-pointer">
                                    <div class="flex items-start space-x-3 p-4 border-2 rounded-lg hover:border-blue-500 transition-all {{ $defaultAlamat && $defaultAlamat->id == $alamat->id ? 'border-blue-600 bg-blue-50' : 'border-gray-200' }}">
                                        <input type="radio" name="alamat_id" value="{{ $alamat->id }}" 
                                            class="mt-1 w-5 h-5 text-blue-600"
                                            {{ $defaultAlamat && $defaultAlamat->id == $alamat->id ? 'checked' : '' }}
                                            {{ old('alamat_id') == $alamat->id ? 'checked' : '' }}>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="font-bold text-gray-900">{{ $alamat->label }}</span>
                                                @if ($alamat->is_default)
                                                    <span class="bg-blue-100 text-blue-600 text-xs px-2 py-0.5 rounded-full">Utama</span>
                                                @endif
                                            </div>
                                            <p class="text-gray-900 font-medium">{{ $alamat->penerima }}</p>
                                            <p class="text-gray-600 text-sm">{{ $alamat->telepon }}</p>
                                            <p class="text-gray-600 text-sm mt-1">
                                                {{ $alamat->alamat_lengkap }}, {{ $alamat->kecamatan }}, 
                                                {{ $alamat->kota }}, {{ $alamat->provinsi }} {{ $alamat->kode_pos }}
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @include('pelanggan.component.input-error', ['messages' => $errors->get('alamat_id')])
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-map-marker-alt text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-600 mb-4">Anda belum memiliki alamat pengiriman</p>
                            <a href="{{ route('pelanggan.profil.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                                <i class="fas fa-plus mr-2"></i>Tambah Alamat
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Produk yang Dibeli -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-box mr-2 text-blue-600"></i>Produk yang Dibeli
                    </h2>
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
                        <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                            @if ($produk->images->first())
                                <img src="{{ asset('storage/' . $produk->images->first()->image_path) }}" 
                                    alt="{{ $produk->nama }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">{{ $produk->merk->nama ?? '-' }}</p>
                            <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $produk->nama }}</h4>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600">{{ $quantity }} × Rp {{ number_format($harga, 0, ',', '.') }}</p>
                                <p class="font-bold text-blue-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-credit-card mr-2 text-blue-600"></i>Metode Pembayaran
                    </h2>
                    <div class="space-y-3">
                        <label class="block cursor-pointer">
                            <div class="flex items-center space-x-3 p-4 border-2 rounded-lg hover:border-blue-500 transition-all {{ old('metode_pembayaran', 'Transfer Bank BCA') == 'Transfer Bank BCA' ? 'border-blue-600 bg-blue-50' : 'border-gray-200' }}">
                                <input type="radio" name="metode_pembayaran" value="Transfer Bank BCA" 
                                    class="w-5 h-5 text-blue-600" {{ old('metode_pembayaran', 'Transfer Bank BCA') == 'Transfer Bank BCA' ? 'checked' : '' }}>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">Transfer Bank BCA</p>
                                    <p class="text-sm text-gray-600">No. Rek: 1234567890 a.n Bearing Shop</p>
                                </div>
                            </div>
                        </label>
                        <label class="block cursor-pointer">
                            <div class="flex items-center space-x-3 p-4 border-2 rounded-lg hover:border-blue-500 transition-all {{ old('metode_pembayaran') == 'Transfer Bank Mandiri' ? 'border-blue-600 bg-blue-50' : 'border-gray-200' }}">
                                <input type="radio" name="metode_pembayaran" value="Transfer Bank Mandiri" 
                                    class="w-5 h-5 text-blue-600" {{ old('metode_pembayaran') == 'Transfer Bank Mandiri' ? 'checked' : '' }}>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">Transfer Bank Mandiri</p>
                                    <p class="text-sm text-gray-600">No. Rek: 9876543210 a.n Bearing Shop</p>
                                </div>
                            </div>
                        </label>
                        <label class="block cursor-pointer">
                            <div class="flex items-center space-x-3 p-4 border-2 rounded-lg hover:border-blue-500 transition-all {{ old('metode_pembayaran') == 'Transfer Bank BNI' ? 'border-blue-600 bg-blue-50' : 'border-gray-200' }}">
                                <input type="radio" name="metode_pembayaran" value="Transfer Bank BNI" 
                                    class="w-5 h-5 text-blue-600" {{ old('metode_pembayaran') == 'Transfer Bank BNI' ? 'checked' : '' }}>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">Transfer Bank BNI</p>
                                    <p class="text-sm text-gray-600">No. Rek: 1122334455 a.n Bearing Shop</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    @include('pelanggan.component.input-error', ['messages' => $errors->get('metode_pembayaran')])
                </div>

                <!-- Catatan -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-sticky-note mr-2 text-blue-600"></i>Catatan Pesanan (Opsional)
                    </h2>
                    <textarea name="catatan" rows="3" placeholder="Contoh: Tolong packing dengan bubble wrap"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none">{{ old('catatan') }}</textarea>
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Belanja</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Total Harga ({{ $quantity }} barang)</span>
                            <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Ongkos Kirim</span>
                            <span class="font-semibold text-green-600">GRATIS</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @if ($alamats->count() > 0)
                        <button type="submit"
                            class="w-full bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                            <i class="fas fa-bolt mr-2"></i>Beli Sekarang
                        </button>
                    @else
                        <button type="button" disabled
                            class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg font-semibold cursor-not-allowed flex items-center justify-center">
                            <i class="fas fa-bolt mr-2"></i>Tambahkan Alamat Terlebih Dahulu
                        </button>
                    @endif

                    <!-- Info Keamanan -->
                    <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-shield-alt text-green-600 mt-1"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Transaksi Aman</p>
                                <p class="text-xs text-gray-600">Data Anda dilindungi dengan enkripsi SSL</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-undo text-blue-600 mt-1"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Garansi Uang Kembali</p>
                                <p class="text-xs text-gray-600">Jika produk tidak sesuai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
