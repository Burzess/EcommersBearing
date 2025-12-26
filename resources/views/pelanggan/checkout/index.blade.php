@extends('layout.pelanggan.app')

@section('title', 'Checkout - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-primary-600 to-primary-800 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('pelanggan.keranjang.index') }}"
                    class="inline-flex mb-4 items-center text-white hover:text-white transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Keranjang
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Checkout</h1>
                <p class="text-primary-100">Lengkapi pesanan Anda</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-credit-card text-white text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages menggunakan komponen -->
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

    <form action="{{ route('pelanggan.checkout.process') }}" method="POST">
        @csrf
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Alamat & Produk -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Alamat Pengiriman -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>Alamat Pengiriman
                    </h2>
                    
                    @if ($alamats->count() > 0)
                        <div class="space-y-3">
                            @foreach ($alamats as $alamat)
                                <label class="block cursor-pointer">
                                    <div class="flex items-start space-x-3 p-4 border-2 rounded-lg hover:border-primary-500 transition-all {{ $defaultAlamat && $defaultAlamat->id == $alamat->id ? 'border-primary-600 bg-primary-50' : 'border-gray-200' }}">
                                        <input type="radio" name="alamat_id" value="{{ $alamat->id }}" 
                                            class="alamat-radio mt-1 w-5 h-5 text-primary-600"
                                            data-provinsi="{{ $alamat->provinsi }}"
                                            {{ $defaultAlamat && $defaultAlamat->id == $alamat->id ? 'checked' : '' }}
                                            {{ old('alamat_id') == $alamat->id ? 'checked' : '' }}>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="font-bold text-gray-900">{{ $alamat->label }}</span>
                                                @if ($alamat->is_default)
                                                    <span class="bg-primary-100 text-primary-600 text-xs px-2 py-0.5 rounded-full">Utama</span>
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
                        <input type="hidden" name="ongkir" id="input-ongkir" value="0">
                        @include('pelanggan.component.input-error', ['messages' => $errors->get('alamat_id')])
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-map-marker-alt text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-600 mb-4">Anda belum memiliki alamat pengiriman</p>
                            <a href="{{ route('pelanggan.profil.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700">
                                <i class="fas fa-plus mr-2"></i>Tambah Alamat
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Produk yang Dipesan -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-box mr-2 text-primary-600"></i>Produk yang Dipesan
                    </h2>
                    <div class="space-y-4">
                        @foreach ($keranjangs as $item)
                            <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                                    @if ($item->produk->images->first())
                                        <img src="{{ asset('storage/' . $item->produk->images->first()->image_path) }}" 
                                            alt="{{ $item->produk->nama }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-gray-500 mb-1">{{ $item->produk->merk->nama ?? '-' }}</p>
                                    <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $item->produk->nama }}</h4>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm text-gray-600">{{ $item->quantity }} × Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                        <p class="font-bold text-primary-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-credit-card mr-2 text-primary-600"></i>Metode Pembayaran
                    </h2>
                    <div class="space-y-3">
                        @forelse ($metodes as $metode)
                            <label class="block cursor-pointer">
                                <div class="flex items-center space-x-3 p-4 border-2 rounded-lg hover:border-primary-500 transition-all {{ old('metode_pembayaran_id') == $metode->id ? 'border-primary-600 bg-primary-50' : 'border-gray-200' }}">
                                    <input type="radio" name="metode_pembayaran_id" value="{{ $metode->id }}" 
                                        class="w-5 h-5 text-primary-600" 
                                        @if ($loop->first) checked @endif
                                        {{ old('metode_pembayaran_id') == $metode->id ? 'checked' : '' }}>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900">{{ $metode->nama }}</p>
                                        <p class="text-sm text-gray-600">{{ $metode->deskripsi }}</p>
                                        @if ($metode->tipe === 'transfer' && $metode->bank_nama)
                                            <p class="text-xs text-gray-500 mt-1">
                                                <i class="fas fa-university mr-1"></i>{{ $metode->bank_nama }} - {{ $metode->bank_rekening }} a.n {{ $metode->bank_atas_nama }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="text-center py-6 text-gray-500">
                                <p>Belum ada metode pembayaran yang tersedia</p>
                            </div>
                        @endforelse
                    </div>
                    @include('pelanggan.component.input-error', ['messages' => $errors->get('metode_pembayaran_id')])
                </div>

                <!-- Catatan -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-sticky-note mr-2 text-primary-600"></i>Catatan Pesanan (Opsional)
                    </h2>
                    <textarea name="catatan" rows="3" placeholder="Contoh: Tolong packing dengan bubble wrap"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ old('catatan') }}</textarea>
                    @include('pelanggan.component.input-error', ['messages' => $errors->get('catatan')])
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Belanja</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Total Harga ({{ $keranjangs->sum('quantity') }} barang)</span>
                            <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Ongkos Kirim</span>
                            <span id="ongkir-display" class="font-semibold text-gray-500">
                                <i class="fas fa-spinner fa-spin mr-1"></i>Menghitung...
                            </span>
                        </div>
                        <div id="estimasi-container" class="hidden">
                            <div class="flex justify-between text-gray-500 text-sm">
                                <span>Estimasi Pengiriman</span>
                                <span id="estimasi-display">-</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                            <span id="total-display" class="text-2xl font-bold text-primary-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @if ($alamats->count() > 0)
                        <button type="submit"
                            class="w-full bg-primary-600 text-white py-3 rounded-lg font-semibold hover:bg-primary-700 transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                            <i class="fas fa-lock mr-2"></i>Buat Pesanan
                        </button>
                    @else
                        <button type="button" disabled
                            class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg font-semibold cursor-not-allowed flex items-center justify-center">
                            <i class="fas fa-lock mr-2"></i>Tambahkan Alamat Terlebih Dahulu
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
                            <i class="fas fa-undo text-primary-600 mt-1"></i>
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

    <script>
        const subtotal = {{ $subtotal }};
        let currentOngkir = 0;

        // Format currency
        function formatRupiah(number) {
            return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Hitung ongkir berdasarkan alamat yang dipilih
        async function hitungOngkir(alamatId) {
            const ongkirDisplay = document.getElementById('ongkir-display');
            const estimasiContainer = document.getElementById('estimasi-container');
            const estimasiDisplay = document.getElementById('estimasi-display');
            const totalDisplay = document.getElementById('total-display');
            const inputOngkir = document.getElementById('input-ongkir');

            // Loading state
            ongkirDisplay.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Menghitung...';
            ongkirDisplay.className = 'font-semibold text-gray-500';
            estimasiContainer.classList.add('hidden');

            try {
                const response = await fetch('/api/ongkir/hitung-by-alamat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ alamat_id: alamatId })
                });

                const data = await response.json();

                if (data.success) {
                    currentOngkir = data.data.tarif;
                    inputOngkir.value = currentOngkir;
                    
                    // Update display
                    ongkirDisplay.textContent = data.data.tarif_formatted;
                    ongkirDisplay.className = 'font-semibold text-primary-600';
                    
                    // Show estimasi
                    estimasiDisplay.textContent = data.data.estimasi;
                    estimasiContainer.classList.remove('hidden');
                    
                    // Update total
                    const total = subtotal + currentOngkir;
                    totalDisplay.textContent = formatRupiah(total);
                } else {
                    ongkirDisplay.textContent = 'Gagal menghitung';
                    ongkirDisplay.className = 'font-semibold text-red-500';
                }
            } catch (error) {
                console.error('Error:', error);
                ongkirDisplay.textContent = 'Error';
                ongkirDisplay.className = 'font-semibold text-red-500';
            }
        }

        // Event listener untuk radio button alamat
        document.querySelectorAll('.alamat-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                hitungOngkir(this.value);
            });
        });

        // Hitung ongkir untuk alamat yang sudah terpilih saat load
        document.addEventListener('DOMContentLoaded', function() {
            const selectedAlamat = document.querySelector('.alamat-radio:checked');
            if (selectedAlamat) {
                hitungOngkir(selectedAlamat.value);
            } else {
                document.getElementById('ongkir-display').textContent = 'Pilih alamat dulu';
                document.getElementById('ongkir-display').className = 'font-semibold text-gray-500';
            }
        });
    </script>
@endsection
