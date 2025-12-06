@extends('layout.admin.app')

@section('title', 'Edit Kategori')

@section('content')
    <!-- Header -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Edit Kategori</h1>
                <p class="text-blue-100">Perbarui informasi kategori produk</p>
            </div>
            <div class="md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-edit text-blue-900 text-4xl"></i>
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
                            <input type="text" id="namaKategori" value="Ball Bearing" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Slug URL <span class="text-gray-400 text-xs">(otomatis dibuat)</span>
                            </label>
                            <input type="text" id="slugKategori" value="ball-bearing" readonly
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi <span class="text-red-500">*</span>
                            </label>
                            <textarea id="deskripsiKategori" rows="4" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">Bantalan bola untuk beban radial dan aksial ringan dengan efisiensi tinggi</textarea>
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
                        <!-- Gambar Saat Ini -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gambar Saat Ini
                            </label>

                            <div id="imageBox" class="relative w-24 h-24 cursor-pointer">
                                <img id="currentImage" src="/assets/ball_bearing.jpeg" alt="Current Image"
                                    class="w-24 h-24 rounded-lg border-2 border-gray-200 hover:border-blue-700 object-cover">

                                <!-- Tombol X, disembunyikan dulu -->
                                <button id="deleteBtn" type="button" onclick="removeCurrentImage()" class="hidden absolute -top-2 -right-2 w-7 h-7 items-center justify-center
                                   bg-red-600 text-white rounded-full shadow-md hover:bg-red-700
                                   transition duration-200">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                        </div>



                        <!-- Upload Gambar Baru -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Gambar Baru (Opsional)
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="imageUpload"
                                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-blue-100 hover:border-blue-700 transition duration-300">
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
                                    <input id="imageUpload" type="file" class="hidden" accept="image/*">
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
                            <input type="number" id="urutanKategori" value="1" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Semakin kecil angka, semakin atas posisinya</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Publikasi
                            </label>
                            <select id="statusKategori"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="aktif" selected>Aktif</option>
                                <option value="tidak-aktif">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="tampilkanDiHome" checked class="rounded text-blue-600">
                            <label for="tampilkanDiHome" class="ml-2 text-sm text-gray-700">
                                Tampilkan di halaman utama
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="kategoriUnggulan" checked class="rounded text-blue-600">
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
                        Update Kategori
                    </button>
                    <button type="button" onclick="deleteKategori()"
                        class="px-6 py-3 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition duration-300">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar Info -->
        <div class="lg:col-span-1">
            <div class="space-y-6">
                <!-- Statistik Kategori -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-blue-600 mr-2"></i>
                        Statistik Kategori
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">Total Produk</span>
                            <span class="font-bold text-gray-800">342</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">Produk Aktif</span>
                            <span class="font-bold text-green-600">318</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">Total Penjualan</span>
                            <span class="font-bold text-blue-600">1,248</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">Pendapatan</span>
                            <span class="font-bold text-purple-600">Rp 125.4M</span>
                        </div>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        Informasi Tambahan
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dibuat pada:</span>
                            <span class="text-gray-800">15 Okt 2024</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Terakhir diubah:</span>
                            <span class="text-gray-800">4 Des 2024</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Diubah oleh:</span>
                            <span class="text-gray-800">Admin</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID Kategori:</span>
                            <span class="text-gray-800">#KAT-001</span>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                        Tips Pengelolaan
                    </h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Pastikan nama kategori tetap konsisten dengan produk</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Nonaktifkan kategori jika tidak ada produk</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Perbarui deskripsi untuk SEO yang lebih baik</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <script>
        // Tombol hapus gambar
        const imageBox = document.getElementById("imageBox");
        const deleteBtn = document.getElementById("deleteBtn");

        // tampilkan tombol X ketika gambar diklik
        imageBox.addEventListener("click", function () {
            deleteBtn.classList.remove("hidden");
            deleteBtn.classList.add("flex");
        });
        imageBox.addEventListener("mouseenter", () => {
            deleteBtn.classList.remove("hidden");
            deleteBtn.classList.add("flex");
        });

        imageBox.addEventListener("mouseleave", () => {
            deleteBtn.classList.add("hidden");
            deleteBtn.classList.remove("flex");
        });


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

        // Hapus gambar saat ini
        function removeCurrentImage() {
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                document.getElementById('currentImage').src = 'https://via.placeholder.com/120x120/CCCCCC/FFFFFF?text=No+Image';
                alert('Gambar dihapus! Jangan lupa upload gambar baru.');
            }
        }

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

            const newImage = document.getElementById('imageUpload').files[0];

            const data = {
                nama: document.getElementById('namaKategori').value,
                slug: document.getElementById('slugKategori').value,
                deskripsi: document.getElementById('deskripsiKategori').value,
                newImage: newImage ? newImage.name : null,
                urutan: document.getElementById('urutanKategori').value,
                status: document.getElementById('statusKategori').value,
                tampilkanDiHome: document.getElementById('tampilkanDiHome').checked,
                kategoriUnggulan: document.getElementById('kategoriUnggulan').checked
            };

            console.log('Update kategori:', data);
            alert('Kategori berhasil diperbarui!');
            window.location.href = '/admin/kategori';
        });

        // Hapus kategori
        function deleteKategori() {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?\n\nPeringatan: Semua produk dalam kategori ini akan dipindahkan ke kategori "Uncategorized"')) {
                alert('Kategori berhasil dihapus!');
                window.location.href = '/admin/kategori';
            }
        }
    </script>
@endsection