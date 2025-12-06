@extends('layout.admin.app')

@section('title', 'Edit Produk - Admin')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex items-center text-blue-100 hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Edit Produk</h1>
                <p class="text-blue-100">Ubah informasi produk bearing</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-edit text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <form onsubmit="updateProduct(event)" class="space-y-6">
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
                            <input type="text" id="productName" value="SKF 6204 Deep Groove Ball Bearing" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">SKU <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="productSku" required value="SKF-6204"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Merek <span
                                        class="text-red-500">*</span></label>
                                <select id="productBrand" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="SKF" selected>SKF</option>
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
                                <option value="ball">Ball Bearing</option>
                                <option value="roller">Roller Bearing</option>
                                <option value="deep" selected>Deep Groove Ball Bearing</option>
                                <option value="angular">Angular Contact Ball Bearing</option>
                                <option value="thrust">Thrust Ball Bearing</option>
                                <option value="cylindrical">Cylindrical Roller Bearing</option>
                                <option value="tapered">Tapered Roller Bearing</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Produk</label>
                            <textarea id="productDescription" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">SKF 6204 adalah deep groove ball bearing berkualitas tinggi dengan presisi tinggi, cocok untuk berbagai aplikasi industri. Material chrome steel dengan seal type ZZ memberikan perlindungan optimal.</textarea>
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
                                <input type="number" id="productPrice" required value="350000" min="0"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Diskon</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-500">Rp</span>
                                <input type="number" id="productDiscount" value="320000" min="0"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stok Tersedia <span
                                    class="text-red-500">*</span></label>
                            <input type="number" id="productStock" required value="150" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stok Minimum <span
                                    class="text-red-500">*</span></label>
                            <input type="number" id="productMinStock" required value="20" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Berat (gram) <span
                                    class="text-red-500">*</span></label>
                            <input type="number" id="productWeight" required value="250" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unit <span
                                    class="text-red-500">*</span></label>
                            <select id="productUnit" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="pcs" selected>Pieces (pcs)</option>
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
                            <input type="text" id="productInnerDia" value="20"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Outer Diameter (mm)</label>
                            <input type="text" id="productOuterDia" value="47"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Width (mm)</label>
                            <input type="text" id="productWidth" value="14"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Material</label>
                            <input type="text" id="productMaterial" value="Chrome Steel"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Seal Type</label>
                            <input type="text" id="productSealType" value="ZZ"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cage Type</label>
                            <input type="text" id="productCageType" value="Steel"
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
                        <!-- Existing Images -->
                        <div id="existingImages" class="grid grid-cols-4 gap-4 mb-4">
                            <div class="relative group">
                                <img src="/assets/roller_bearing.jpeg"
                                    class="w-full h-24 object-cover rounded-lg border-4 border-blue-600">
                                <span class="absolute top-1 left-1 bg-blue-600 text-white text-xs px-2 py-0.5">Utama</span>
                                <button type="button" onclick="removeExistingImage(this)"
                                    class="absolute top-1 right-1 w-6 h-6 bg-red-600 text-white rounded-full opacity-0 group-hover:opacity-100 transition-all">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                            <div class="relative group">
                                <img src="/assets/spherical_bearing.jpeg"
                                    class="w-full h-24 object-cover rounded-lg border-4 border-blue-500">
                                <button type="button" onclick="removeExistingImage(this)"
                                    class="absolute top-1 right-1 w-6 h-6 bg-red-600 text-white rounded-full opacity-0 group-hover:opacity-100 transition-all">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 transition-all cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 font-medium mb-1">Tambah gambar baru</p>
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
                                <option value="active" selected>Aktif</option>
                                <option value="inactive">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="text-sm space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Dibuat:</span>
                                <span class="font-medium">15 Jan 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Terakhir diubah:</span>
                                <span class="font-medium">18 Jan 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Total terjual:</span>
                                <span class="font-medium">342 unit</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                        <button type="button" onclick="deleteProduct()"
                            class="w-full px-4 py-2.5 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all">
                            <i class="fas fa-trash mr-2"></i>Hapus Produk
                        </button>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Statistik Produk</h3>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Views</span>
                            <span class="font-bold text-blue-600">1,234</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Likes</span>
                            <span class="font-bold text-pink-600">89</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Dalam Keranjang</span>
                            <span class="font-bold text-green-600">12</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Rating</span>
                            <span class="font-bold text-yellow-600">4.8 <i class="fas fa-star text-xs"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Update produk
        function updateProduct(e) {
            e.preventDefault();

            if (confirm('Simpan perubahan produk?')) {
                alert('Produk berhasil diperbarui!\n\nFitur dalam pengembangan');

            }
        }

        // Hapus produk
        function deleteProduct() {
            if (confirm('Hapus produk ini?\n\nData tidak dapat dikembalikan dan akan mempengaruhi riwayat pesanan.')) {
                alert('Produk berhasil dihapus\n\nFitur dalam pengembangan');

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

        // Hapus gambar baru
        function removeImage(button) {
            button.parentElement.remove();
        }

        // Hapus gambar yang ada
        function removeExistingImage(button) {
            if (confirm('Hapus gambar ini?')) {
                button.parentElement.remove();
            }
        }
    </script>
@endsection