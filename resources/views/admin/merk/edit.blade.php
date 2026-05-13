@extends('layout.admin.app')

@section('title', 'Edit Merk')

@section('content')
<!-- Header -->
<div class="bg-linear-to-r from-primary-700 to-primary-900 rounded-2xl shadow-xl p-8 mb-8">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.merk.index') }}" class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <h1 class="text-3xl font-bold text-white mb-2">Edit Merk</h1>
            <p class="text-primary-100">Edit merk: {{ $merk->nama }}</p>
        </div>
        <div class="hidden md:block">
            <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-edit text-primary-900 text-4xl"></i>
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

<div class="grid lg:grid-cols-3 gap-6">
    <!-- Info Merk -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="text-center mb-6">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-primary-100 flex items-center justify-center">
                    <i class="fas fa-tag text-primary-700 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">{{ $merk->nama }}</h3>
                <p class="text-sm text-gray-500">ID: #{{ $merk->id }}</p>

                @if ($merk->is_premium)
                    <span class="inline-block mt-2 px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">
                        <i class="fas fa-crown mr-1"></i>Premium
                    </span>
                @endif
            </div>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Jumlah Produk:</span>
                    <span class="font-medium">{{ $merk->produks()->count() }} produk</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Dibuat:</span>
                    <span class="font-medium">{{ $merk->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Diupdate:</span>
                    <span class="font-medium">{{ $merk->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Edit -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('admin.merk.update', $merk->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Nama Merk -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Merk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama', $merk->nama) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                            placeholder="Contoh: SKF, NSK, FAG">
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Nama merk maksimal 255 karakter</p>
                    </div>

                    <!-- Kualitas Premium -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kualitas Premium
                        </label>
                        <select name="is_premium"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('is_premium') border-red-500 @enderror">
                            <option value="0" {{ old('is_premium', $merk->is_premium) == 0 ? 'selected' : '' }}>Standar</option>
                            <option value="1" {{ old('is_premium', $merk->is_premium) == 1 ? 'selected' : '' }}>Premium</option>
                        </select>
                        @error('is_premium')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.merk.index') }}"
                        class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-all">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
