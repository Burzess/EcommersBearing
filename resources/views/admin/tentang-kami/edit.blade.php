@extends('layout.admin.app')

@section('title', 'Edit Tentang Kami')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('admin.tentang-kami.index') }}" class="text-gray-600 hover:text-primary-600 mb-2 inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Tentang Kami</h1>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.tentang-kami.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-md p-6">
            <!-- Status -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $tentangKami->is_active ?? true) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                    <span class="ml-3 text-gray-700 font-medium">Aktif</span>
                </label>
            </div>

            <!-- Judul -->
            <div class="mb-6">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $tentangKami->judul ?? '') }}" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('judul') border-red-500 @enderror">
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konten -->
            <div class="mb-6">
                <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">Konten <span class="text-red-500">*</span></label>
                <textarea name="konten" id="konten" rows="10" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('konten') border-red-500 @enderror">{{ old('konten', $tentangKami->konten ?? '') }}</textarea>
                <p class="text-gray-500 text-sm mt-1">Mendukung format HTML</p>
                @error('konten')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Visi -->
            <div class="mb-6">
                <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
                <textarea name="visi" id="visi" rows="3"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('visi', $tentangKami->visi ?? '') }}</textarea>
            </div>

            <!-- Misi -->
            <div class="mb-6">
                <label for="misi" class="block text-sm font-medium text-gray-700 mb-2">Misi</label>
                <textarea name="misi" id="misi" rows="5"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('misi', $tentangKami->misi ?? '') }}</textarea>
                <p class="text-gray-500 text-sm mt-1">Pisahkan setiap poin dengan baris baru</p>
            </div>

            <!-- Gambar -->
            <div class="mb-6">
                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                @if (isset($tentangKami->gambar) && $tentangKami->gambar)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $tentangKami->gambar) }}" alt="Gambar saat ini" class="max-w-xs rounded-lg shadow">
                    </div>
                @endif
                <input type="file" name="gambar" id="gambar" accept="image/*"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG, GIF. Max: 2MB</p>
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.tentang-kami.index') }}"
                    class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </div>
    </form>
@endsection
