@extends('layout.admin.app')

@section('title', 'Edit Kebijakan Privasi')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('admin.kebijakan-privasi.index') }}" class="text-gray-600 hover:text-primary-600 mb-2 inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Kebijakan Privasi</h1>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.kebijakan-privasi.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-md p-6">
            <!-- Status -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $kebijakanPrivasi->is_active ?? true) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                    <span class="ml-3 text-gray-700 font-medium">Aktif</span>
                </label>
            </div>

            <!-- Judul -->
            <div class="mb-6">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $kebijakanPrivasi->judul ?? '') }}" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('judul') border-red-500 @enderror">
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Berlaku -->
            <div class="mb-6">
                <label for="tanggal_berlaku" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berlaku</label>
                <input type="date" name="tanggal_berlaku" id="tanggal_berlaku" 
                    value="{{ old('tanggal_berlaku', isset($kebijakanPrivasi->tanggal_berlaku) ? $kebijakanPrivasi->tanggal_berlaku->format('Y-m-d') : '') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>

            <!-- Daftar Kebijakan -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <label class="block text-sm font-medium text-gray-700">Daftar Kebijakan <span class="text-red-500">*</span></label>
                    <button type="button" onclick="addItem()" class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700">
                        <i class="fas fa-plus mr-1"></i>Tambah Item
                    </button>
                </div>
                
                <div id="items-container" class="space-y-4">
                    @php
                        $items = old('items', []);
                        if (empty($items) && isset($kebijakanPrivasi->konten)) {
                            // Try to parse existing content
                            $existingItems = json_decode($kebijakanPrivasi->konten, true);
                            if (!is_array($existingItems)) {
                                // If it's not JSON (old format), convert to single item
                                $existingItems = [['judul' => 'Kebijakan', 'isi' => $kebijakanPrivasi->konten]];
                            }
                            $items = $existingItems;
                        }
                        if (empty($items)) {
                            $items = [['judul' => '', 'isi' => '']];
                        }
                    @endphp
                    
                    @foreach ($items as $index => $item)
                        <div class="item-row bg-gray-50 border border-gray-200 rounded-lg p-4" data-index="{{ $index }}">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-semibold text-gray-700">
                                    <i class="fas fa-grip-vertical text-gray-400 mr-2"></i>
                                    Kebijakan #<span class="item-number">{{ $index + 1 }}</span>
                                </span>
                                <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700 text-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="grid md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Judul Kebijakan</label>
                                    <input type="text" name="items[{{ $index }}][judul]" value="{{ $item['judul'] ?? '' }}" required
                                        placeholder="Contoh: Pendahuluan"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Isi Kebijakan</label>
                                    <textarea name="items[{{ $index }}][isi]" rows="3" required
                                        placeholder="Tuliskan isi kebijakan..."
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ $item['isi'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @error('items')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.kebijakan-privasi.index') }}"
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

    <script>
        let itemIndex = {{ count($items) }};
        
        function addItem() {
            const container = document.getElementById('items-container');
            const html = `
                <div class="item-row bg-gray-50 border border-gray-200 rounded-lg p-4" data-index="${itemIndex}">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-semibold text-gray-700">
                            <i class="fas fa-grip-vertical text-gray-400 mr-2"></i>
                            Kebijakan #<span class="item-number">${itemIndex + 1}</span>
                        </span>
                        <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700 text-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Judul Kebijakan</label>
                            <input type="text" name="items[${itemIndex}][judul]" required
                                placeholder="Contoh: Pendahuluan"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Isi Kebijakan</label>
                            <textarea name="items[${itemIndex}][isi]" rows="3" required
                                placeholder="Tuliskan isi kebijakan..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"></textarea>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            itemIndex++;
            updateItemNumbers();
        }
        
        function removeItem(button) {
            const rows = document.querySelectorAll('.item-row');
            if (rows.length <= 1) {
                alert('Minimal harus ada 1 item kebijakan');
                return;
            }
            button.closest('.item-row').remove();
            updateItemNumbers();
        }
        
        function updateItemNumbers() {
            const rows = document.querySelectorAll('.item-row');
            rows.forEach((row, index) => {
                row.querySelector('.item-number').textContent = index + 1;
            });
        }
    </script>
@endsection
