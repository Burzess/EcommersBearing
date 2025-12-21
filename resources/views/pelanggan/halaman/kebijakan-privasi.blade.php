@extends('layout.pelanggan.app')

@section('title', 'Kebijakan Privasi - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">{{ $kebijakanPrivasi->judul }}</h1>
                <p class="text-blue-100">
                    @if ($kebijakanPrivasi->tanggal_berlaku)
                        Berlaku sejak {{ $kebijakanPrivasi->tanggal_berlaku->format('d F Y') }}
                    @else
                        Informasi privasi dan keamanan data Anda
                    @endif
                </p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-shield-alt text-white text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-4 gap-6">
        <!-- Konten Utama -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
                @php
                    $items = json_decode($kebijakanPrivasi->konten, true);
                @endphp
                
                @if (is_array($items))
                    <div class="space-y-6">
                        @foreach ($items as $index => $item)
                            <div class="border-b border-gray-100 pb-6 last:border-b-0 last:pb-0">
                                <div class="flex items-start">
                                    <span class="flex-shrink-0 w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg mr-4">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="flex-1">
                                        <h2 class="text-xl font-bold text-gray-900 mb-3">{{ $item['judul'] ?? '' }}</h2>
                                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $item['isi'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="prose max-w-none text-gray-700">
                        {!! $kebijakanPrivasi->konten !!}
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Info Keamanan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-lock text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Keamanan</h3>
                </div>
                <p class="text-gray-600 text-sm">Data Anda dilindungi dengan enkripsi SSL 256-bit dan sistem keamanan berlapis.</p>
            </div>

            <!-- Kontak -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-envelope text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Ada Pertanyaan?</h3>
                </div>
                <p class="text-gray-600 text-sm mb-4">Hubungi kami jika ada pertanyaan seputar kebijakan privasi.</p>
                <a href="{{ route('pelanggan.kontak') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline">
                    <i class="fas fa-arrow-right mr-2"></i>Hubungi Kami
                </a>
            </div>

            <!-- Update Terakhir -->
            <div class="bg-gray-50 rounded-xl p-6">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-clock mr-2"></i>
                    Terakhir diperbarui: {{ $kebijakanPrivasi->updated_at->format('d F Y') }}
                </p>
            </div>
        </div>
    </div>
@endsection
