@extends('layout.admin.app')

@section('title', 'Edit Kontak')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('admin.kontak.index') }}" class="text-gray-600 hover:text-blue-600 mb-2 inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Informasi Kontak</h1>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.kontak.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-md p-6">
            <!-- Status -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $kontak->is_active ?? true) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-3 text-gray-700 font-medium">Aktif</span>
                </label>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Nama Perusahaan -->
                <div>
                    <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan', $kontak->nama_perusahaan ?? '') }}" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_perusahaan') border-red-500 @enderror">
                    @error('nama_perusahaan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $kontak->email ?? '') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Telepon -->
                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                    <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $kontak->telepon ?? '') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- WhatsApp -->
                <div>
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $kontak->whatsapp ?? '') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <!-- Alamat -->
            <div class="mt-6">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
                <textarea name="alamat" id="alamat" rows="3" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alamat') border-red-500 @enderror">{{ old('alamat', $kontak->alamat ?? '') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jam Operasional -->
            <div class="mt-6">
                <label for="jam_operasional" class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
                <input type="text" name="jam_operasional" id="jam_operasional" value="{{ old('jam_operasional', $kontak->jam_operasional ?? '') }}"
                    placeholder="Contoh: Senin - Jumat: 08:00 - 17:00"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Google Maps -->
            <div class="mt-6">
                <label for="google_maps_embed" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>Link Google Maps
                </label>
                <input type="url" name="google_maps_embed" id="google_maps_embed" value="{{ old('google_maps_embed', $kontak->google_maps_embed ?? '') }}"
                    placeholder="https://maps.google.com/..."
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-gray-500 text-sm mt-1">Salin link Google Maps dari browser atau aplikasi Google Maps</p>
            </div>

            <!-- Social Media -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Media Sosial</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label for="facebook" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-facebook text-blue-600 mr-1"></i>Facebook
                        </label>
                        <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $kontak->facebook ?? '') }}"
                            placeholder="https://facebook.com/..."
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="instagram" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-instagram text-pink-600 mr-1"></i>Instagram
                        </label>
                        <input type="url" name="instagram" id="instagram" value="{{ old('instagram', $kontak->instagram ?? '') }}"
                            placeholder="https://instagram.com/..."
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-twitter text-blue-400 mr-1"></i>Twitter
                        </label>
                        <input type="url" name="twitter" id="twitter" value="{{ old('twitter', $kontak->twitter ?? '') }}"
                            placeholder="https://twitter.com/..."
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('admin.kontak.index') }}"
                    class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </div>
    </form>
@endsection
