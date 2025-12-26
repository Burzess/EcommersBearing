@extends('layout.admin.app')

@section('title', 'Edit Metode Pembayaran')

@section('content')
    <!-- Header -->
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.metode-pembayaran.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Metode Pembayaran</h1>
            <p class="text-gray-600 mt-1">Perbarui informasi metode pembayaran</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <form action="{{ route('admin.metode-pembayaran.update', $metodePembayaran->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Metode <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama', $metodePembayaran->nama) }}" required
                        placeholder="Contoh: Transfer Bank BCA"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('nama') border-red-500 @enderror">
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tipe -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Pembayaran <span class="text-red-500">*</span>
                    </label>
                    <select name="tipe" id="tipe" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('tipe') border-red-500 @enderror">
                        <option value="">Pilih Tipe</option>
                        <option value="transfer" {{ old('tipe', $metodePembayaran->tipe) == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="cod" {{ old('tipe', $metodePembayaran->tipe) == 'cod' ? 'selected' : '' }}>COD (Bayar di Tempat)</option>
                        <option value="ewallet" {{ old('tipe', $metodePembayaran->tipe) == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                    @error('tipe')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bank Fields (shown only for transfer type) -->
                <div id="bank-fields" class="md:col-span-2 grid md:grid-cols-3 gap-6 {{ old('tipe', $metodePembayaran->tipe) == 'transfer' ? '' : 'hidden' }}">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Bank <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="bank_nama" value="{{ old('bank_nama', $metodePembayaran->bank_nama) }}"
                            placeholder="Contoh: BCA, BNI, Mandiri"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('bank_nama') border-red-500 @enderror">
                        @error('bank_nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Rekening <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="bank_rekening" value="{{ old('bank_rekening', $metodePembayaran->bank_rekening) }}"
                            placeholder="Contoh: 1234567890"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('bank_rekening') border-red-500 @enderror">
                        @error('bank_rekening')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Atas Nama <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="bank_atas_nama" value="{{ old('bank_atas_nama', $metodePembayaran->bank_atas_nama) }}"
                            placeholder="Contoh: PT Bearing Shop Indonesia"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('bank_atas_nama') border-red-500 @enderror">
                        @error('bank_atas_nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Urutan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $metodePembayaran->urutan ?? 0) }}" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                    <p class="text-gray-500 text-xs mt-1">Semakin kecil angka, semakin atas posisinya</p>
                </div>

                <!-- Logo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo (Opsional)</label>
                    @if ($metodePembayaran->logo)
                        <div class="mb-3 flex items-center space-x-3">
                            <img src="{{ asset('storage/' . $metodePembayaran->logo) }}" alt="{{ $metodePembayaran->nama }}" 
                                class="w-16 h-16 object-cover rounded">
                            <div class="text-sm">
                                <p class="text-gray-600">Logo saat ini</p>
                                <button type="button" onclick="document.getElementById('remove-logo').value = '1'; this.closest('.flex').classList.add('hidden');"
                                    class="text-red-600 hover:text-red-700 text-xs mt-1">Hapus Logo</button>
                                <input type="hidden" name="remove_logo" id="remove-logo" value="0">
                            </div>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/jpeg,image/png,image/jpg,image/svg+xml"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('logo') border-red-500 @enderror">
                    <p class="text-gray-500 text-xs mt-1">Format: jpeg, png, jpg, svg. Maksimal 1MB</p>
                    @error('logo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instruksi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instruksi Pembayaran</label>
                    <textarea name="instruksi" rows="4"
                        placeholder="Tuliskan instruksi pembayaran untuk pelanggan..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('instruksi') border-red-500 @enderror">{{ old('instruksi', $metodePembayaran->instruksi) }}</textarea>
                    @error('instruksi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                    <input type="text" name="deskripsi" value="{{ old('deskripsi', $metodePembayaran->deskripsi ?? '') }}"
                        placeholder="Contoh: Pembayaran transfer via Bank BCA"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('deskripsi') border-red-500 @enderror">
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="md:col-span-2">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $metodePembayaran->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 text-primary-600 rounded focus:ring-primary-500">
                        <span class="ml-2 text-gray-700">Aktifkan metode pembayaran ini</span>
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 mt-6 pt-6 border-t">
                <a href="{{ route('admin.metode-pembayaran.index') }}"
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition-all">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-all">
                    <i class="fas fa-save mr-2"></i>Perbarui
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('tipe').addEventListener('change', function() {
            const bankFields = document.getElementById('bank-fields');
            if (this.value === 'transfer') {
                bankFields.classList.remove('hidden');
            } else {
                bankFields.classList.add('hidden');
            }
        });
    </script>
@endsection
