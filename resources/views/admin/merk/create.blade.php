@extends('layout.admin.app')

@section('title', 'Tambah Merk')

@section('content')
    <!-- Header -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Tambah Merk Baru</h1>
                <p class="text-blue-100">Isi form di bawah untuk menambah merk produk bearing</p>
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
                            <input type="text" id="namaMerk" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Contoh: SKF, NSK, NTN">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Slug URL <span class="text-gray-400 text-xs">(otomatis dibuat)</span>
                            </label>
                            <input type="text" id="slugMerk" readonly
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600"
                                placeholder="skf">
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
                                <option value="swedia">Swedia</option>
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
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Jelaskan tentang merk ini, kelebihan, dan spesialisasinya..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Website (Opsional)
                            </label>
                            <input type="url" id="websiteMerk"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="https://www.contoh.com">
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
                            <input type="number" id="tahunBerdiri" min="1800" max="2024"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Contoh: 1907">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Publikasi
                            </label>
                            <select id="statusMerk"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="aktif">Aktif</option>
                                <option value="tidak-aktif">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="merkPremium" class="rounded text-blue-600">
                            <label for="merkPremium" class="ml-2 text-sm text-gray-700">
                                <i class="fas fa-crown text-yellow-500 mr-1"></i>
                                Tandai sebagai merk premium
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="merkUnggulan" class="rounded text-blue-600">
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
                        Simpan Merk
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
                        <span>Gunakan nama resmi merk untuk kredibilitas</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span>Upload logo dengan kualitas tinggi dan transparan</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span>Deskripsi yang baik membantu pelanggan memahami kualitas</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span>Merk premium akan ditampilkan lebih menonjol</span>
                    </li>
                </ul>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-xs text-gray-600">
                        <i class="fas fa-info-circle text-blue-600 mr-1"></i>
                        Merk yang ditambahkan akan langsung tersedia untuk pengelolaan produk
                    </p>
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
                logo: document.getElementById('logoUpload').files[0]?.name
            };

            console.log('Data merk:', data);
            alert('Merk berhasil ditambahkan!');
            window.location.href = '/admin/merk';
        });

        // Simpan sebagai draft
        function saveDraft() {
            alert('Merk disimpan sebagai draft');
        }
    </script>
@endsection