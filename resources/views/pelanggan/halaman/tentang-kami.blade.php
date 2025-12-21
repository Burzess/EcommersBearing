@extends('layout.pelanggan.app')

@section('title', 'Tentang Kami - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">{{ $tentangKami->judul }}</h1>
                <p class="text-blue-100">Mengenal lebih dekat Bearing Shop</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-info-circle text-white text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Konten Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Deskripsi -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="prose max-w-none text-gray-700">
                    {!! $tentangKami->konten !!}
                </div>
            </div>

            <!-- Gambar -->
            @if ($tentangKami->gambar)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <img src="{{ asset('storage/' . $tentangKami->gambar) }}" alt="Tentang Kami" class="w-full rounded-lg">
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Visi -->
            @if ($tentangKami->visi)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-eye text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Visi</h3>
                    </div>
                    <p class="text-gray-700">{{ $tentangKami->visi }}</p>
                </div>
            @endif

            <!-- Misi -->
            @if ($tentangKami->misi)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-bullseye text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Misi</h3>
                    </div>
                    <ul class="space-y-2">
                        @foreach (explode("\n", $tentangKami->misi) as $misi)
                            @if (trim($misi))
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                    <span class="text-gray-700">{{ trim($misi) }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Kenapa Pilih Kami -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-star text-orange-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Keunggulan Kami</h3>
                </div>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-shield-alt text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-gray-900">Produk Original</p>
                            <p class="text-sm text-gray-600">100% produk asli bergaransi resmi</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-truck text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-gray-900">Pengiriman Cepat</p>
                            <p class="text-sm text-gray-600">Ke seluruh Indonesia</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-headset text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-gray-900">Support 24/7</p>
                            <p class="text-sm text-gray-600">Tim support profesional</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
