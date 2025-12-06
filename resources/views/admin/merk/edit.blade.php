@extends('layout.admin.app')

@section('title', 'Edit Merk')

@section('content')
    <!-- Header -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Edit Merk</h1>
                <p class="text-blue-100">Perbarui informasi merk produk bearing</p>
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
            <form id="merkForm" class="space-y-6">
                <!-- Informasi Dasar -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        Informasi Dasar
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Merk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="namaMerk" value="SKF" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Slug URL <span class="text-gray-400 text-xs">(otomatis dibuat)</span>
                            </label>
                            <input type="text" id="slugMerk" value="skf" readonly
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Negara Asal <span class="text-red-500">*</span>
                            </label>
                            <select id="negaraAsal" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Pilih Negara</option>
                                <option value="jepang">Jepang</option>
                                <option value="jerman">Jerman</option>
                                <option value="usa">USA</option>
                                <option value="swedia" selected>Swedia</option>
                                <option value="china">China</option>
                                <option value="prancis">Prancis</option>
                                <option value="italia">Italia</option>
                                <option value="inggris">Inggris</option>
                                <option value="korea-selatan">Korea Selatan</option>
                                <option value="indonesia">Indonesia</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi <span class="text-red-500">*</span>
                            </label>
                            <textarea id="deskripsiMerk" rows="4" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">Produsen bearing terkemuka dunia sejak 1907 dengan standar kualitas internasional. Spesialis dalam ball bearing, roller bearing, dan solusi bearing presisi untuk berbagai industri.</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Website (Opsional)
                            </label>
                            <input type="url" id="websiteMerk" value="https://www.skf.com"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-cog text-blue-600 mr-2"></i>
                        Informasi Tambahan
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun Berdiri
                            </label>
                            <input type="number" id="tahunBerdiri" value="1907" min="1800" max="2024"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Publikasi
                            </label>
                            <select id="statusMerk"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="aktif" selected>Aktif</option>
                                <option value="tidak-aktif">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="merkPremium" checked class="rounded text-blue-600">
                            <label for="merkPremium" class="ml-2 text-sm text-gray-700">
                                <i class="fas fa-crown text-yellow-500 mr-1"></i>
                                Tandai sebagai merk premium
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="merkUnggulan" checked class="rounded text-blue-600">
                            <label for="merkUnggulan" class="ml-2 text-sm text-gray-700">
                                Tampilkan di halaman utama
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-save mr-2"></i>
                        Update Merk
                    </button>
                    <button type="button" onclick="deleteMerk()"
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
                <!-- Statistik Merk -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-blue-600 mr-2"></i>
                        Statistik Merk
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
                            <span class="font-bold text-blue-600">2,847</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">Pendapatan</span>
                            <span class="font-bold text-purple-600">Rp 285.6M</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">Rating Rata-rata</span>
                            <span class="font-bold text-yellow-600">4.8 <i class="fas fa-star text-xs"></i></span>
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
                            <span class="text-gray-800">10 Sep 2024</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Terakhir diubah:</span>
                            <span class="text-gray-800">3 Des 2024</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Diubah oleh:</span>
                            <span class="text-gray-800">Admin</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID Merk:</span>
                            <span class="text-gray-800">#MRK-001</span>
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
                            <span>Pastikan informasi merk selalu akurat dan terkini</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Logo berkualitas meningkatkan kepercayaan pelanggan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Perbarui deskripsi untuk menonjolkan keunggulan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate slug otomatis dari nama
        document.getElementById('namaMerk').addEventListener('input', function (e) {
            const slug = e.target.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slugMerk').value = slug;
        });

        // Handle logo upload dan preview
        document.getElementById('logoUpload').addEventListener('change', function (e) {
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
                    document.getElementById('logoPreview').src = e.target.result;
                    document.getElementById('logoPreviewContainer').classList.remove('hidden');
                    document.getElementById('logoPlaceholder').classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Hapus logo saat ini
        function removeCurrentLogo() {
            if (confirm('Apakah Anda yakin ingin menghapus logo ini?')) {
                document.getElementById('currentLogo').src = 'https://via.placeholder.com/120x120/CCCCCC/FFFFFF?text=No+Logo';
                alert('Logo dihapus! Jangan lupa upload logo baru.');
            }
        }

        // Submit form
        document.getElementById('merkForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Ambil kategori produk yang dipilih
            const selectedCategories = Array.from(document.querySelectorAll('input[type="checkbox"][value]'))
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            const data = {
                nama: document.getElementById('namaMerk').value,
                slug: document.getElementById('slugMerk').value,
                negara: document.getElementById('negaraAsal').value,
                deskripsi: document.getElementById('deskripsiMerk').value,
                website: document.getElementById('websiteMerk').value,
                tahunBerdiri: document.getElementById('tahunBerdiri').value,
                kategoriProduk: selectedCategories,
                status: document.getElementById('statusMerk').value,
                isPremium: document.getElementById('merkPremium').checked,
                isUnggulan: document.getElementById('merkUnggulan').checked,
                newLogo: document.getElementById('logoUpload').files[0]?.name
            };

            console.log('Update merk:', data);
            alert('Merk berhasil diperbarui!');
            window.location.href = '/admin/merk';
        });

        // Hapus merk
        function deleteMerk() {
            if (confirm('Apakah Anda yakin ingin menghapus merk ini?\n\nPeringatan: Semua produk dengan merk ini akan dihapus atau dipindahkan ke "Uncategorized Brand"')) {
                alert('Merk berhasil dihapus!');
                window.location.href = '/admin/merk';
            }
        }
    </script>
@endsection