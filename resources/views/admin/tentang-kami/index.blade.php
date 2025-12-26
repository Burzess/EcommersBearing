@extends('layout.admin.app')

@section('title', 'Tentang Kami')

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tentang Kami</h1>
            <p class="text-gray-600">Kelola halaman Tentang Kami</p>
        </div>
        <a href="{{ route('admin.tentang-kami.edit') }}"
            class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-colors">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
    </div>

    <!-- Alert -->
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

    <!-- Content -->
    @if ($tentangKami)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <!-- Status -->
                <div class="flex items-center mb-6">
                    <span class="text-sm font-medium text-gray-700 mr-3">Status:</span>
                    @if ($tentangKami->is_active)
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Aktif</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">Tidak Aktif</span>
                    @endif
                </div>

                <!-- Judul -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Judul</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $tentangKami->judul }}</p>
                </div>

                <!-- Konten -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Konten</h3>
                    <div class="prose max-w-none text-gray-700 bg-gray-50 p-4 rounded-lg">
                        {!! $tentangKami->konten !!}
                    </div>
                </div>

                <!-- Visi -->
                @if ($tentangKami->visi)
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Visi</h3>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $tentangKami->visi }}</p>
                    </div>
                @endif

                <!-- Misi -->
                @if ($tentangKami->misi)
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Misi</h3>
                        <div class="text-gray-700 bg-gray-50 p-4 rounded-lg whitespace-pre-line">{{ $tentangKami->misi }}</div>
                    </div>
                @endif

                <!-- Gambar -->
                @if ($tentangKami->gambar)
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Gambar</h3>
                        <img src="{{ asset('storage/' . $tentangKami->gambar) }}" alt="Gambar Tentang Kami" class="max-w-md rounded-lg shadow">
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data</h3>
            <p class="text-gray-600 mb-4">Halaman Tentang Kami belum diatur</p>
            <a href="{{ route('admin.tentang-kami.edit') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700">
                <i class="fas fa-plus mr-2"></i>Buat Sekarang
            </a>
        </div>
    @endif
@endsection
