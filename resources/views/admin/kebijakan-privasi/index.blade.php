@extends('layout.admin.app')

@section('title', 'Kebijakan Privasi')

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kebijakan Privasi</h1>
            <p class="text-gray-600">Kelola halaman Kebijakan Privasi</p>
        </div>
        <a href="{{ route('admin.kebijakan-privasi.edit') }}"
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
    @if ($kebijakanPrivasi)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <!-- Status -->
                <div class="flex items-center mb-6">
                    <span class="text-sm font-medium text-gray-700 mr-3">Status:</span>
                    @if ($kebijakanPrivasi->is_active)
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Aktif</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">Tidak Aktif</span>
                    @endif
                </div>

                <!-- Judul -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Judul</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $kebijakanPrivasi->judul }}</p>
                </div>

                <!-- Tanggal Berlaku -->
                @if ($kebijakanPrivasi->tanggal_berlaku)
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Tanggal Berlaku</h3>
                        <p class="text-gray-700">{{ $kebijakanPrivasi->tanggal_berlaku->format('d F Y') }}</p>
                    </div>
                @endif

                <!-- Konten -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-4">Daftar Kebijakan</h3>
                    @php
                        $items = json_decode($kebijakanPrivasi->konten, true);
                    @endphp
                    
                    @if (is_array($items))
                        <div class="space-y-4">
                            @foreach ($items as $index => $item)
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-start">
                                        <span class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                            {{ $index + 1 }}
                                        </span>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 mb-2">{{ $item['judul'] ?? '' }}</h4>
                                            <p class="text-gray-700 whitespace-pre-line">{{ $item['isi'] ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="prose max-w-none text-gray-700 bg-gray-50 p-4 rounded-lg">
                            {!! $kebijakanPrivasi->konten !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-shield-alt text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data</h3>
            <p class="text-gray-600 mb-4">Kebijakan Privasi belum diatur</p>
            <a href="{{ route('admin.kebijakan-privasi.edit') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700">
                <i class="fas fa-plus mr-2"></i>Buat Sekarang
            </a>
        </div>
    @endif
@endsection
