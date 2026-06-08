@extends('layout.admin.app')

@section('title', 'Tambah Kategori')

@section('content')
<!-- Header -->
<div class="bg-linear-to-r from-primary-700 to-primary-900 rounded-2xl shadow-xl p-8 mb-8">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <h1 class="text-3xl font-bold text-white mb-2">Tambah Kategori</h1>
            <p class="text-primary-100">Buat kategori produk baru</p>
        </div>
        <div class="hidden md:block">
            <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-plus text-primary-900 text-4xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Alert Messages -->
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
        <div class="flex items-center mb-2">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <strong>Terjadi kesalahan:</strong>
        </div>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form -->
<div class="bg-white rounded-xl shadow-md p-6">
    <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Nama Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama" value="{{ old('nama') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                    placeholder="Contoh: Ball Bearing">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Nama kategori maksimal 255 karakter</p>
            </div>

            <!-- Urutan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Urutan
                </label>
                <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('urutan') border-red-500 @enderror"
                    placeholder="0">
                @error('urutan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Semakin kecil angka, semakin di atas urutannya</p>
            </div>
        </div>

        <div class="mt-6">
            <!-- Icon / Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar Kategori
                </label>
                <input type="file" name="icon" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('icon') border-red-500 @enderror">
                @error('icon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Format yang didukung: JPG, PNG, GIF, SVG, WEBP. Maksimal 2MB.</p>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.kategori.index') }}"
                class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-all">
                <i class="fas fa-save mr-2"></i>Simpan Kategori
            </button>
        </div>
    </form>
</div>
@endsection
