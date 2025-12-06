@extends('layout.admin.app')

@section('title', 'Detail Produk - Admin')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex items-center text-blue-100 hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Detail Produk</h1>
                <p class="text-blue-100">Informasi lengkap produk bearing</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-box-open text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Konten Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Gambar & Info Dasar -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Gallery -->
                    <div>
                        <div class="mb-4">
                            <img id="mainImage" src="/assets/ball_bearing.jpeg" alt="Product"
                                class="w-full h-80 object-cover rounded-lg">
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            <img src="/assets/ball_bearing.jpeg" onclick="changeMainImage(this.src)"
                                class="w-full h-20 object-cover rounded-lg cursor-pointer border-2 border-blue-600 hover:opacity-75 transition-all">
                            <img src="/assets/roller_bearing.jpeg" onclick="changeMainImage(this.src)"
                                class="w-full h-20 object-cover rounded-lg cursor-pointer border-2 border-gray-200 hover:border-blue-600 transition-all">
                            <img src="/assets/profil.jpg" onclick="changeMainImage(this.src)"
                                class="w-full h-20 object-cover rounded-lg cursor-pointer border-2 border-gray-200 hover:border-blue-600 transition-all">
                            <img src="/assets/needle_bearing.jpeg" onclick="changeMainImage(this.src)"
                                class="w-full h-20 object-cover rounded-lg cursor-pointer border-2 border-gray-200 hover:border-blue-600 transition-all">
                        </div>
                    </div>

                    <!-- Info Dasar -->
                    <div>
                        <div class="mb-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mb-2">
                                <i class="fas fa-circle mr-1 text-xs"></i>Aktif
                            </span>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-2 ml-2">
                                <i class="fas fa-star mr-1"></i>Unggulan
                            </span>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-2">SKF 6204 Deep Groove Ball Bearing</h2>
                        <p class="text-gray-600 mb-4">SKU: SKF-6204</p>

                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-3xl font-bold text-blue-600">Rp 350.000</span>
                            <span class="text-lg text-gray-500 line-through">Rp 380.000</span>
                            <span class="px-2 py-1 bg-red-100 text-red-600 text-xs font-bold rounded">-8%</span>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-box w-6 text-gray-400"></i>
                                <span class="text-sm text-gray-600">Merek: <span
                                        class="font-semibold text-gray-900">SKF</span></span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-tag w-6 text-gray-400"></i>
                                <span class="text-sm text-gray-600">Kategori: <span class="font-semibold text-gray-900">Deep
                                        Groove Ball Bearing</span></span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-warehouse w-6 text-gray-400"></i>
                                <span class="text-sm text-gray-600">Stok: <span class="font-semibold text-green-600">150
                                        unit tersedia</span></span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-weight w-6 text-gray-400"></i>
                                <span class="text-sm text-gray-600">Berat: <span class="font-semibold text-gray-900">250
                                        gram</span></span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star w-6 text-yellow-400"></i>
                                <span class="text-sm text-gray-600">Rating: <span
                                        class="font-semibold text-gray-900">4.8</span> <span class="text-gray-400">(124
                                        ulasan)</span></span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <a href="#"
                                class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all text-center">
                                <i class="fas fa-edit mr-2"></i>Edit Produk
                            </a>
                            <button onclick="shareProduct()"
                                class="px-4 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-align-left mr-2 text-blue-600"></i>Deskripsi Produk
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    SKF 6204 adalah deep groove ball bearing berkualitas tinggi dengan presisi tinggi yang dirancang untuk
                    berbagai aplikasi industri.
                    Bearing ini menggunakan material chrome steel premium yang memberikan ketahanan luar biasa terhadap
                    beban dan keausan.
                    Dilengkapi dengan seal type ZZ yang memberikan perlindungan optimal terhadap kontaminasi debu dan
                    kotoran,
                    menjadikannya pilihan ideal untuk lingkungan kerja yang menantang. Cage type steel memberikan stabilitas
                    dan keandalan jangka panjang.
                </p>
            </div>

            <!-- Spesifikasi Teknis -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-cog mr-2 text-blue-600"></i>Spesifikasi Teknis
                </h3>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-500">Inner Diameter</span>
                        <p class="font-semibold text-gray-900">20 mm</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-500">Outer Diameter</span>
                        <p class="font-semibold text-gray-900">47 mm</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-500">Width</span>
                        <p class="font-semibold text-gray-900">14 mm</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-500">Material</span>
                        <p class="font-semibold text-gray-900">Chrome Steel</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-500">Seal Type</span>
                        <p class="font-semibold text-gray-900">ZZ (Metal Shield)</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-500">Cage Type</span>
                        <p class="font-semibold text-gray-900">Steel</p>
                    </div>
                </div>
            </div>

            <!-- Riwayat Penjualan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-chart-line mr-2 text-blue-600"></i>Riwayat Penjualan
                </h3>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Pesanan #ORD-2024-045</p>
                            <p class="text-sm text-gray-500">John Doe • 18 Jan 2024</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">5 unit</p>
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Selesai
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Pesanan #ORD-2024-038</p>
                            <p class="text-sm text-gray-500">Jane Smith • 15 Jan 2024</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">3 unit</p>
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-truck mr-1"></i>Dikirim
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Pesanan #ORD-2024-029</p>
                            <p class="text-sm text-gray-500">Robert Johnson • 12 Jan 2024</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">10 unit</p>
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Selesai
                            </span>
                        </div>
                    </div>
                </div>

                <button onclick="viewAllOrders()"
                    class="w-full mt-4 px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                    Lihat Semua Pesanan
                </button>
            </div>

            <!-- Reviews -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-star mr-2 text-blue-600"></i>Ulasan Pelanggan
                </h3>

                <div class="space-y-4">
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-semibold text-gray-900">John Doe</p>
                                <p class="text-sm text-gray-500">18 Jan 2024</p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            </div>
                        </div>
                        <p class="text-gray-600">Produk sangat berkualitas, sesuai dengan deskripsi. Pengiriman cepat dan
                            packing aman.</p>
                    </div>

                    <div class="p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-semibold text-gray-900">Jane Smith</p>
                                <p class="text-sm text-gray-500">15 Jan 2024</p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="far fa-star text-gray-300 text-sm"></i>
                            </div>
                        </div>
                        <p class="text-gray-600">Bearing original SKF. Harga kompetitif. Recommended!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow-md p-6 top-6">
                <h3 class="font-bold text-gray-900 mb-4">Statistik Produk</h3>

                <div class="space-y-4">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-blue-600">Total Terjual</span>
                            <i class="fas fa-shopping-cart text-blue-600"></i>
                        </div>
                        <p class="text-2xl font-bold text-blue-600">342 unit</p>
                    </div>

                    <div class="p-4 bg-green-50 rounded-lg">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-green-600">Revenue</span>
                            <i class="fas fa-dollar-sign text-green-600"></i>
                        </div>
                        <p class="text-2xl font-bold text-green-600">Rp 119,7 Jt</p>
                        <p class="text-xs text-green-500 mt-1">Total pendapatan</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 bg-gray-50 rounded-lg text-center">
                            <i class="fas fa-eye text-gray-400 mb-2"></i>
                            <p class="text-lg font-bold text-gray-900">1,234</p>
                            <p class="text-xs text-gray-500">Views</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg text-center">
                            <i class="fas fa-heart text-gray-400 mb-2"></i>
                            <p class="text-lg font-bold text-gray-900">89</p>
                            <p class="text-xs text-gray-500">Likes</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg text-center">
                            <i class="fas fa-shopping-basket text-gray-400 mb-2"></i>
                            <p class="text-lg font-bold text-gray-900">12</p>
                            <p class="text-xs text-gray-500">Keranjang</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg text-center">
                            <i class="fas fa-star text-gray-400 mb-2"></i>
                            <p class="text-lg font-bold text-gray-900">4.8</p>
                            <p class="text-xs text-gray-500">Rating</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="font-bold text-gray-900 mb-4">Informasi Tambahan</h3>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Dibuat:</span>
                        <span class="font-medium">15 Jan 2024</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Terakhir diubah:</span>
                        <span class="font-medium">18 Jan 2024</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Diubah oleh:</span>
                        <span class="font-medium">Admin 1</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">ID Produk:</span>
                        <span class="font-medium">#PRD-001</span>
                    </div>
                </div>
            </div>

            <!-- Stock Alert -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="font-bold text-gray-900 mb-4">Alert Stok</h3>

                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Stok Saat Ini</span>
                            <span class="font-semibold text-gray-900">150 / 200</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>

                    <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-0.5 mr-2"></i>
                            <div>
                                <p class="text-sm font-medium text-green-900">Stok Aman</p>
                                <p class="text-xs text-green-700 mt-1">Stok masih di atas batas minimum (20 unit)</p>
                            </div>
                        </div>
                    </div>

                    <button onclick="addStock()"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                        <i class="fas fa-plus mr-2"></i>Tambah Stok
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ubah gambar utama
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src.replace('100', '400');

            // Update border aktif
            document.querySelectorAll('.grid img').forEach(img => {
                img.classList.remove('border-blue-600');
                img.classList.add('border-gray-200');
            });
            event.target.classList.remove('border-gray-200');
            event.target.classList.add('border-blue-600');
        }

        // Share produk
        function shareProduct() {
            alert('Share produk ke media sosial\n\nFitur dalam pengembangan');
        }

        // Lihat semua pesanan
        function viewAllOrders() {
            alert('Lihat semua pesanan produk ini\n\nFitur dalam pengembangan');
        }

        // Tambah stok
        function addStock() {
            const amount = prompt('Tambah stok (unit):');
            if (amount && !isNaN(amount)) {
                alert(`Menambah ${amount} unit stok\n\nFitur dalam pengembangan`);
            }
        }

        // Duplikat produk
        function duplicateProduct() {
            if (confirm('Duplikat produk ini?')) {
                alert('Produk berhasil diduplikat\n\nFitur dalam pengembangan');
            }
        }

        // Cetak label
        function printLabel() {
            alert('Cetak label produk\n\nFitur dalam pengembangan');
        }

        // Export data
        function exportData() {
            alert('Export data produk\n\nFitur dalam pengembangan');
        }

        // Arsipkan produk
        function archiveProduct() {
            if (confirm('Arsipkan produk ini?\n\nProduk tidak akan muncul di katalog.')) {
                alert('Produk berhasil diarsipkan\n\nFitur dalam pengembangan');
            }
        }
    </script>
@endsection