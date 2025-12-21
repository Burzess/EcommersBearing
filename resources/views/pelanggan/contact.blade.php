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

    <!-- Alert Messages menggunakan komponen -->
    @if (session('success'))
        @include('pelanggan.component.alert', ['type' => 'success', 'slot' => session('success')])
    @endif

    @if (session('error'))
        @include('pelanggan.component.alert', ['type' => 'error', 'slot' => session('error')])
    @endif

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
                <p class="text-gray-700">
                    Jl. Industri Bearing No. 123<br>
                    Surabaya, Jawa Timur 60123<br>
                    Indonesia
                </p>
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
                <p class="text-gray-700">
                    <a href="tel:+6231123456" class="hover:text-blue-600">+62 31 123 456</a><br>
                    <a href="tel:+6281234567890" class="hover:text-blue-600">+62 812 3456 7890</a>
                </p>
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
                <p class="text-gray-700">
                    <a href="mailto:info@bearingshop.com" class="hover:text-blue-600">info@bearingshop.com</a><br>
                    <a href="mailto:sales@bearingshop.com" class="hover:text-blue-600">sales@bearingshop.com</a>
                </p>
            </div>

            <!-- Card Jam Operasional -->
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
                <div class="text-gray-700 space-y-1">
                    <div class="flex justify-between">
                        <span>Senin - Jumat</span>
                        <span class="font-medium">08:00 - 17:00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Sabtu</span>
                        <span class="font-medium">08:00 - 14:00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Minggu</span>
                        <span class="font-medium text-red-600">Tutup</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Kontak -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-paper-plane mr-2 text-blue-600"></i>Kirim Pesan
                </h2>
                
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            @include('pelanggan.component.input-label', ['value' => 'Nama Lengkap'])
                            <input type="text" name="nama" required placeholder="Masukkan nama lengkap"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            @include('pelanggan.component.input-error', ['messages' => $errors->get('nama')])
                        </div>
                        <div>
                            @include('pelanggan.component.input-label', ['value' => 'Email'])
                            <input type="email" name="email" required placeholder="Masukkan email"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            @include('pelanggan.component.input-error', ['messages' => $errors->get('email')])
                        </div>
                    </div>

                    <div>
                        @include('pelanggan.component.input-label', ['value' => 'Subjek'])
                        <input type="text" name="subjek" required placeholder="Masukkan subjek pesan"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        @include('pelanggan.component.input-error', ['messages' => $errors->get('subjek')])
                    </div>

                    <div>
                        @include('pelanggan.component.input-label', ['value' => 'Pesan'])
                        <textarea name="pesan" rows="5" required placeholder="Tuliskan pesan Anda..."
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all resize-none"></textarea>
                        @include('pelanggan.component.input-error', ['messages' => $errors->get('pesan')])
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- FAQ Section -->
            <div class="bg-white rounded-xl shadow-md p-6 mt-6">
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
