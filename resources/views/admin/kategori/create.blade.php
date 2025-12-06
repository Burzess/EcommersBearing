@extends('layout.admin.app')

@section('title', 'Tambah Kategori')

@section('content')
    <!-- Header -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Tambah Kategori Baru</h1>
                <p class="text-blue-100">Isi form di bawah untuk menambah kategori produk</p>
            </div>
            <div class="md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-plus-circle text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Utama -->
        <div class="lg:col-span-2">
            <form id="kategoriForm" class="space-y-6">
                <!-- Informasi Dasar -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        Informasi Dasar
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Kategori <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="namaKategori" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Contoh: Ball Bearing">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Slug URL <span class="text-gray-400 text-xs">(otomatis dibuat)</span>
                            </label>
                            <input type="text" id="slugKategori" readonly
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600"
                                placeholder="ball-bearing">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi <span class="text-red-500">*</span>
                            </label>
                            <textarea id="deskripsiKategori" rows="4" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Jelaskan tentang kategori ini..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Gambar Kategori -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-image text-blue-600 mr-2"></i>
                        Gambar Kategori
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Gambar <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="imageUpload"
                                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300">
                                    <div id="imagePreviewContainer" class="hidden">
                                        <img id="imagePreview" src="" alt="Preview" class="max-h-40 rounded-lg">
                                    </div>
                                    <div id="imagePlaceholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-3"></i>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG (Maks. 2MB, Rekomendasi:
                                            400x400px)</p>
                                    </div>
                                    <input id="imageUpload" type="file" class="hidden" accept="image/*" required>
                                </label>
                            </div>
                        </div>

                        <div class="bg-yellow-50 rounded-lg p-4">
                            <div class="flex">
                                <i class="fas fa-lightbulb text-yellow-600 mr-2 mt-1"></i>
                                <div class="text-sm text-gray-700">
                                    <p class="font-semibold mb-1">Tips Upload Gambar:</p>
                                    <ul class="list-disc list-inside space-y-1 text-xs">
                                        <li>Gunakan gambar dengan ukuran minimal 400x400px</li>
                                        <li>Format PNG dengan background transparan lebih baik</li>
                                        <li>Pastikan gambar terlihat jelas dan tidak blur</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Meta Data -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-cog text-blue-600 mr-2"></i>
                        Pengaturan
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Urutan Tampilan
                            </label>
                            <input type="number" id="urutanKategori" value="0" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Semakin kecil angka, semakin atas posisinya</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Publikasi
                            </label>
                            <select id="statusKategori"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="aktif">Aktif</option>
                                <option value="tidak-aktif">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="tampilkanDiHome" class="rounded text-blue-600">
                            <label for="tampilkanDiHome" class="ml-2 text-sm text-gray-700">
                                Tampilkan di halaman utama
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="kategoriUnggulan" class="rounded text-blue-600">
                            <label for="kategoriUnggulan" class="ml-2 text-sm text-gray-700">
                                Tandai sebagai kategori unggulan
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Kategori
                    </button>
                    <button type="button" onclick="saveDraft()"
                        class="flex-1 bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-file mr-2"></i>
                        Simpan sebagai Draft
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar Tips -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                    Tips Pengelolaan
                </h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span>Gunakan nama kategori yang jelas dan mudah dipahami</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span>Pilih ikon yang merepresentasikan jenis bearing</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span>Deskripsi singkat membantu pelanggan memahami produk</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span>Atur urutan untuk menampilkan kategori populer di atas</span>
                    </li>
                </ul>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-xs text-gray-600">
                        <i class="fas fa-info-circle text-blue-600 mr-1"></i>
                        Kategori yang ditambahkan akan langsung tersedia untuk pengelolaan produk
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle upload gambar dan preview
        document.getElementById('imageUpload').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi ukuran file (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    this.value = '';
                    return;
                }

                // Validasi tipe file
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar!');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').classList.remove('hidden');
                    document.getElementById('imagePlaceholder').classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Generate slug otomatis dari nama
        document.getElementById('namaKategori').addEventListener('input', function (e) {
            const slug = e.target.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slugKategori').value = slug;
        });

        // Submit form
        document.getElementById('kategoriForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const imageFile = document.getElementById('imageUpload').files[0];
            if (!imageFile) {
                alert('Silakan upload gambar untuk kategori');
                return;
            }

            const data = {
                nama: document.getElementById('namaKategori').value,
                slug: document.getElementById('slugKategori').value,
                deskripsi: document.getElementById('deskripsiKategori').value,
                image: imageFile.name,
                urutan: document.getElementById('urutanKategori').value,
                status: document.getElementById('statusKategori').value,
                tampilkanDiHome: document.getElementById('tampilkanDiHome').checked,
                kategoriUnggulan: document.getElementById('kategoriUnggulan').checked
            };

            console.log('Data kategori:', data);
            alert('Kategori berhasil ditambahkan!');
            window.location.href = '/admin/kategori';
        });

        // Simpan sebagai draft
        function saveDraft() {
            alert('Kategori disimpan sebagai draft');
        }
    </script>
@endsection