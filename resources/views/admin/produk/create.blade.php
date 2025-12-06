@extends('layout.admin.app')

@section('title', 'Tambah Produk - Admin')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex items-center text-blue-100 hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Tambah Produk Baru</h1>
                <p class="text-blue-100">Tambahkan produk bearing ke katalog</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-plus-circle text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <form onsubmit="saveProduct(event)" class="space-y-6">
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Form Input -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Informasi Dasar -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informasi Dasar
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="productName" required
                                placeholder="Contoh: SKF 6204 Deep Groove Ball Bearing"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">SKU <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="productSku" required placeholder="SKF-6204"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Merek <span
                                        class="text-red-500">*</span></label>
                                <select id="productBrand" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">-- Pilih Merek --</option>
                                    <option value="SKF">SKF</option>
                                    <option value="NSK">NSK</option>
                                    <option value="NTN">NTN</option>
                                    <option value="FAG">FAG</option>
                                    <option value="Timken">Timken</option>
                                    <option value="INA">INA</option>
                                    <option value="KOYO">KOYO</option>
                                    <option value="Other">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span
                                    class="text-red-500">*</span></label>
                            <select id="productCategory" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="ball">Ball Bearing</option>
                                <option value="roller">Roller Bearing</option>
                                <option value="deep">Deep Groove Ball Bearing</option>
                                <option value="angular">Angular Contact Ball Bearing</option>
                                <option value="thrust">Thrust Ball Bearing</option>
                                <option value="cylindrical">Cylindrical Roller Bearing</option>
                                <option value="tapered">Tapered Roller Bearing</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Produk</label>
                            <textarea id="productDescription" rows="4"
                                placeholder="Deskripsikan spesifikasi dan keunggulan produk..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            <p class="text-xs text-gray-500 mt-1">Opsional, minimal 50 karakter</p>
                        </div>
                    </div>
                </div>

                <!-- Harga & Stok -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-dollar-sign mr-2 text-blue-600"></i>Harga & Stok
                    </h2>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Satuan <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-500">Rp</span>
                                <input type="number" id="productPrice" required placeholder="350000" min="0"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Diskon</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-500">Rp</span>
                                <input type="number" id="productDiscount" placeholder="300000" min="0"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Opsional</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stok Tersedia <span
                                    class="text-red-500">*</span></label>
                            <input type="number" id="productStock" required placeholder="100" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stok Minimum <span
                                    class="text-red-500">*</span></label>
                            <input type="number" id="productMinStock" required placeholder="20" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Alert jika stok di bawah nilai ini</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Berat (gram) <span
                                    class="text-red-500">*</span></label>
                            <input type="number" id="productWeight" required placeholder="250" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unit <span
                                    class="text-red-500">*</span></label>
                            <select id="productUnit" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="pcs">Pieces (pcs)</option>
                                <option value="box">Box</option>
                                <option value="set">Set</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Spesifikasi Teknis -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-cog mr-2 text-blue-600"></i>Spesifikasi Teknis
                    </h2>

                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inner Diameter (mm)</label>
                            <input type="text" id="productInnerDia" placeholder="20"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Outer Diameter (mm)</label>
                            <input type="text" id="productOuterDia" placeholder="47"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Width (mm)</label>
                            <input type="text" id="productWidth" placeholder="14"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Material</label>
                            <input type="text" id="productMaterial" placeholder="Chrome Steel"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Seal Type</label>
                            <input type="text" id="productSealType" placeholder="Open/ZZ/RS"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cage Type</label>
                            <input type="text" id="productCageType" placeholder="Steel/Brass"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Gambar Produk -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-image mr-2 text-blue-600"></i>Gambar Produk
                    </h2>

                    <div class="space-y-4">
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 transition-all cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 font-medium mb-1">Klik atau drag file ke sini</p>
                            <p class="text-sm text-gray-500">PNG, JPG hingga 5MB</p>
                            <input type="file" id="productImages" multiple accept="image/*" class="hidden">
                        </div>

                        <div id="imagePreview" class="grid grid-cols-4 gap-4">
                            <!-- Preview gambar akan muncul di sini -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Status Publikasi -->
                <div class="bg-white rounded-xl shadow-md p-6 top-6">
                    <h3 class="font-bold text-gray-900 mb-4">Status Publikasi</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Produk</label>
                            <select id="productStatus"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="active">Aktif</option>
                                <option value="inactive">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200 space-y-2">
                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                            <i class="fas fa-save mr-2"></i>Simpan Produk
                        </button>
                        <button type="button" onclick="saveDraft()"
                            class="w-full px-4 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                            <i class="fas fa-file mr-2"></i>Simpan Draft
                        </button>
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-blue-50 rounded-xl p-6">
                    <h3 class="font-bold text-blue-900 mb-3">
                        <i class="fas fa-lightbulb mr-2"></i>Tips
                    </h3>
                    <ul class="space-y-2 text-sm text-blue-800">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1"></i>
                            <span>Gunakan nama produk yang jelas dan deskriptif</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1"></i>
                            <span>Upload minimal 3 foto berkualitas tinggi</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1"></i>
                            <span>Isi spesifikasi teknis selengkap mungkin</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1"></i>
                            <span>Set stok minimum untuk notifikasi restock</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Simpan produk
        function saveProduct(e) {
            e.preventDefault();

            // Validasi form
            const productName = document.getElementById('productName').value;
            const productSku = document.getElementById('productSku').value;
            const productBrand = document.getElementById('productBrand').value;
            const productCategory = document.getElementById('productCategory').value;
            const productPrice = document.getElementById('productPrice').value;
            const productStock = document.getElementById('productStock').value;

            if (!productName || !productSku || !productBrand || !productCategory || !productPrice || !productStock) {
                alert('Lengkapi semua field yang wajib diisi (*)');
                return;
            }

            if (confirm('Simpan produk baru ke katalog?')) {
                alert('Produk berhasil ditambahkan!\n\nFitur dalam pengembangan');
                // window.location.href = '/admin/produk';
            }
        }

        // Simpan draft
        function saveDraft() {
            if (confirm('Simpan sebagai draft?')) {
                alert('Draft berhasil disimpan\n\nFitur dalam pengembangan');
            }
        }

        // Handle upload gambar
        document.querySelector('.border-dashed').addEventListener('click', function () {
            document.getElementById('productImages').click();
        });

        document.getElementById('productImages').addEventListener('change', function (e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            Array.from(e.target.files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                                    <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg">
                                    <button type="button" onclick="removeImage(this)" 
                                        class="absolute top-1 right-1 w-6 h-6 bg-red-600 text-white rounded-full opacity-0 group-hover:opacity-100 transition-all">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Hapus gambar
        function removeImage(button) {
            button.parentElement.remove();
        }

        // Auto-generate SKU berdasarkan brand dan nama
        document.getElementById('productBrand').addEventListener('change', generateSku);
        document.getElementById('productName').addEventListener('input', generateSku);

        function generateSku() {
            const brand = document.getElementById('productBrand').value;
            const name = document.getElementById('productName').value;

            if (brand && name) {
                // Ekstrak nomor dari nama jika ada
                const numbers = name.match(/\d+/);
                if (numbers) {
                    const sku = `${brand}-${numbers[0]}`;
                    document.getElementById('productSku').value = sku;
                }
            }
        }
    </script>
@endsection