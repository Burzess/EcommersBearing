@extends('layout.pelanggan.app')

@section('title', 'Hubungi Kami - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Hubungi Kami</h1>
                <p class="text-blue-100">Kami siap membantu Anda</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-headset text-white text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Informasi Kontak -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Card Alamat -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Alamat</h3>
                        <p class="text-gray-600 text-sm">Kunjungi toko kami</p>
                    </div>
                </div>
                <p class="text-gray-700">{{ $kontak->alamat }}</p>
            </div>

            <!-- Card Telepon -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-phone text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Telepon</h3>
                        <p class="text-gray-600 text-sm">Hubungi langsung</p>
                    </div>
                </div>
                <div class="space-y-1">
                    @if ($kontak->telepon)
                        <p><a href="tel:{{ $kontak->telepon }}" class="text-gray-700 hover:text-blue-600">{{ $kontak->telepon }}</a></p>
                    @endif
                    @if ($kontak->whatsapp)
                        <p><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontak->whatsapp) }}" target="_blank" class="text-gray-700 hover:text-green-600">
                            <i class="fab fa-whatsapp mr-1"></i>{{ $kontak->whatsapp }}
                        </a></p>
                    @endif
                </div>
            </div>

            <!-- Card Email -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-envelope text-orange-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Email</h3>
                        <p class="text-gray-600 text-sm">Kirim pesan</p>
                    </div>
                </div>
                @if ($kontak->email)
                    <a href="mailto:{{ $kontak->email }}" class="text-gray-700 hover:text-blue-600">{{ $kontak->email }}</a>
                @endif
            </div>

            <!-- Card Jam Operasional -->
            @if ($kontak->jam_operasional)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Jam Operasional</h3>
                            <p class="text-gray-600 text-sm">Kapan kami buka</p>
                        </div>
                    </div>
                    <p class="text-gray-700">{{ $kontak->jam_operasional }}</p>
                </div>
            @endif

            <!-- Social Media -->
            @if ($kontak->facebook || $kontak->instagram || $kontak->twitter)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        @if ($kontak->facebook)
                            <a href="{{ $kontak->facebook }}" target="_blank" class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center hover:bg-blue-200 transition-all">
                                <i class="fab fa-facebook-f text-blue-600"></i>
                            </a>
                        @endif
                        @if ($kontak->instagram)
                            <a href="{{ $kontak->instagram }}" target="_blank" class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center hover:bg-pink-200 transition-all">
                                <i class="fab fa-instagram text-pink-600"></i>
                            </a>
                        @endif
                        @if ($kontak->twitter)
                            <a href="{{ $kontak->twitter }}" target="_blank" class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center hover:bg-blue-200 transition-all">
                                <i class="fab fa-twitter text-blue-400"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Form & Map -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Google Maps -->
            @if ($kontak->google_maps_embed)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-map mr-2 text-blue-600"></i>Lokasi Kami
                    </h2>
                    <div class="bg-gray-100 rounded-lg p-6 text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-map-marker-alt text-red-500 text-2xl"></i>
                        </div>
                        <p class="text-gray-600 mb-4">Klik tombol di bawah untuk melihat lokasi kami di Google Maps</p>
                        <a href="{{ $kontak->google_maps_embed }}" target="_blank" 
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-external-link-alt mr-2"></i>Buka di Google Maps
                        </a>
                    </div>
                </div>
            @endif

            <!-- FAQ Section -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-question-circle mr-2 text-blue-600"></i>Pertanyaan Umum
                </h2>
                
                <div class="space-y-4">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-2">Bagaimana cara memesan produk?</h4>
                        <p class="text-gray-600 text-sm">Pilih produk yang diinginkan, tambahkan ke keranjang, dan lanjutkan ke checkout untuk menyelesaikan pesanan.</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-2">Berapa lama waktu pengiriman?</h4>
                        <p class="text-gray-600 text-sm">Waktu pengiriman bervariasi tergantung lokasi. Umumnya 2-5 hari kerja untuk area Pulau Jawa.</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-2">Apakah produk bergaransi?</h4>
                        <p class="text-gray-600 text-sm">Ya, semua produk kami adalah original dan bergaransi resmi dari distributor.</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-2">Bagaimana cara melacak pesanan?</h4>
                        <p class="text-gray-600 text-sm">Anda dapat melacak pesanan melalui halaman Riwayat Pembelian setelah login ke akun Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
