@extends('layout.admin.app')

@section('title', 'Kontak')

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Informasi Kontak</h1>
            <p class="text-gray-600">Kelola informasi kontak perusahaan</p>
        </div>
        <a href="{{ route('admin.kontak.edit') }}"
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
    @if ($kontak)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <!-- Status -->
                <div class="flex items-center mb-6">
                    <span class="text-sm font-medium text-gray-700 mr-3">Status:</span>
                    @if ($kontak->is_active)
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Aktif</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">Tidak Aktif</span>
                    @endif
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Info Utama -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Nama Perusahaan</h3>
                            <p class="text-gray-900 font-semibold">{{ $kontak->nama_perusahaan }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Alamat</h3>
                            <p class="text-gray-700">{{ $kontak->alamat }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Jam Operasional</h3>
                            <p class="text-gray-700">{{ $kontak->jam_operasional ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Telepon</h3>
                            <p class="text-gray-700">{{ $kontak->telepon ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">WhatsApp</h3>
                            <p class="text-gray-700">{{ $kontak->whatsapp ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Email</h3>
                            <p class="text-gray-700">{{ $kontak->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Media Sosial</h3>
                    <div class="flex flex-wrap gap-4">
                        @if ($kontak->facebook)
                            <a href="{{ $kontak->facebook }}" target="_blank" class="flex items-center text-primary-600 hover:underline">
                                <i class="fab fa-facebook mr-2"></i>Facebook
                            </a>
                        @endif
                        @if ($kontak->instagram)
                            <a href="{{ $kontak->instagram }}" target="_blank" class="flex items-center text-pink-600 hover:underline">
                                <i class="fab fa-instagram mr-2"></i>Instagram
                            </a>
                        @endif
                        @if ($kontak->twitter)
                            <a href="{{ $kontak->twitter }}" target="_blank" class="flex items-center text-blue-400 hover:underline">
                                <i class="fab fa-twitter mr-2"></i>Twitter
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-phone text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data</h3>
            <p class="text-gray-600 mb-4">Informasi kontak belum diatur</p>
            <a href="{{ route('admin.kontak.edit') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700">
                <i class="fas fa-plus mr-2"></i>Buat Sekarang
            </a>
        </div>
    @endif
@endsection
