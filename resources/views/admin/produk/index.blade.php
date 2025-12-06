@extends('layout.admin.app')

@section('title', 'Manajemen Produk - Admin')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-10 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Manajemen Produk</h1>
                <p class="text-blue-100">Kelola katalog produk bearing</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-box text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Produk</p>
                    <p class="text-2xl font-bold text-gray-900">1,248</p>
                    <p class="text-xs text-gray-500 mt-1">Semua kategori</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-boxes text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Stok Menipis</p>
                    <p class="text-2xl font-bold text-gray-900">24</p>
                    <p class="text-xs text-red-600 mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>Perlu restock</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Stok Habis</p>
                    <p class="text-2xl font-bold text-gray-900">8</p>
                    <p class="text-xs text-yellow-600 mt-1"><i class="fas fa-ban mr-1"></i>Tidak tersedia</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-times-circle text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Produk Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">1,216</p>
                    <p class="text-xs text-green-600 mt-1"><i class="fas fa-check mr-1"></i>Tersedia</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-4">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-2">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 flex-1 w-full lg:w-auto">
                <div class="md:col-span-2">
                    <div class="relative">

                        <input type="text" id="searchInput" placeholder="Cari nama produk, SKU, merek..."
                            class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>

                    </div>
                </div>

                <div>
                    <select id="categoryFilter" onchange="filterProducts()"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Kategori</option>
                        <option value="ball">Ball Bearing</option>
                        <option value="roller">Roller Bearing</option>
                        <option value="deep">Deep Groove</option>
                        <option value="angular">Angular Contact</option>
                    </select>
                </div>

                <div>
                    <select id="stockFilter" onchange="filterProducts()"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Stok</option>
                        <option value="available">Tersedia</option>
                        <option value="low">Stok Menipis</option>
                        <option value="out">Stok Habis</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-2 w-full lg:w-auto">
                <button onclick="exportData()"
                    class="flex-1 lg:flex-none px-4 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-all">
                    <i class="fas fa-file-excel mr-2"></i>Export
                </button>

                <!-- Reset Button -->
                <button onclick="resetFilter()"
                    class="flex-1 lg:flex-none px-4 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition-all">
                    <i class="fas fa-undo mr-2"></i>Reset
                </button>

                <a href="#"
                    class="flex-1 lg:flex-none px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all text-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                </a>
            </div>
        </div>
    </div>

    <!-- Tabel Produk -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left">
                            <input type="checkbox" onchange="selectAll(this)"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Produk
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Harga
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Stok
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="productTableBody" class="divide-y divide-gray-200">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">Menampilkan <span class="font-medium">1-10</span> dari <span
                        class="font-medium">1,248</span> produk</p>
                <div class="flex space-x-2">
                    <button
                        class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button
                        class="px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all">1</button>
                    <button
                        class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">2</button>
                    <button
                        class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">3</button>
                    <button
                        class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data dummy produk
        let products = [
            {
                id: 1,
                sku: 'SKF-6204',
                name: 'SKF 6204 Deep Groove Ball Bearing',
                category: 'deep',
                categoryName: 'Deep Groove',
                brand: 'SKF',
                price: 350000,
                stock: 150,
                minStock: 20,
                image: 'https://via.placeholder.com/80?text=SKF',
                status: 'active',
                createdAt: '2024-01-15'
            },
            {
                id: 2,
                sku: 'NSK-6205',
                name: 'NSK 6205 Ball Bearing',
                category: 'ball',
                categoryName: 'Ball Bearing',
                brand: 'NSK',
                price: 450000,
                stock: 12,
                minStock: 20,
                image: 'https://via.placeholder.com/80?text=NSK',
                status: 'active',
                createdAt: '2024-01-14'
            },
            {
                id: 3,
                sku: 'NTN-6206',
                name: 'NTN Cylindrical Roller Bearing',
                category: 'roller',
                categoryName: 'Roller Bearing',
                brand: 'NTN',
                price: 1250000,
                stock: 85,
                minStock: 15,
                image: 'https://via.placeholder.com/80?text=NTN',
                status: 'active',
                createdAt: '2024-01-13'
            },
            {
                id: 4,
                sku: 'FAG-7208',
                name: 'FAG Angular Contact Ball Bearing',
                category: 'angular',
                categoryName: 'Angular Contact',
                brand: 'FAG',
                price: 850000,
                stock: 0,
                minStock: 10,
                image: 'https://via.placeholder.com/80?text=FAG',
                status: 'inactive',
                createdAt: '2024-01-12'
            },
            {
                id: 5,
                sku: 'TMK-6207',
                name: 'Timken Tapered Roller Bearing',
                category: 'roller',
                categoryName: 'Roller Bearing',
                brand: 'Timken',
                price: 1500000,
                stock: 45,
                minStock: 10,
                image: 'https://via.placeholder.com/80?text=TMK',
                status: 'active',
                createdAt: '2024-01-11'
            },
            {
                id: 6,
                sku: 'SKF-6208',
                name: 'SKF 6208 Ball Bearing',
                category: 'ball',
                categoryName: 'Ball Bearing',
                brand: 'SKF',
                price: 650000,
                stock: 8,
                minStock: 15,
                image: 'https://via.placeholder.com/80?text=SKF',
                status: 'active',
                createdAt: '2024-01-10'
            },
            {
                id: 7,
                sku: 'NSK-7209',
                name: 'NSK Deep Groove Ball Bearing',
                category: 'deep',
                categoryName: 'Deep Groove',
                brand: 'NSK',
                price: 750000,
                stock: 120,
                minStock: 20,
                image: 'https://via.placeholder.com/80?text=NSK',
                status: 'active',
                createdAt: '2024-01-09'
            },
            {
                id: 8,
                sku: 'FAG-6210',
                name: 'FAG Cylindrical Roller Bearing',
                category: 'roller',
                categoryName: 'Roller Bearing',
                brand: 'FAG',
                price: 1800000,
                stock: 32,
                minStock: 10,
                image: 'https://via.placeholder.com/80?text=FAG',
                status: 'active',
                createdAt: '2024-01-08'
            },
            {
                id: 9,
                sku: 'NTN-7210',
                name: 'NTN Angular Contact Bearing',
                category: 'angular',
                categoryName: 'Angular Contact',
                brand: 'NTN',
                price: 950000,
                stock: 0,
                minStock: 15,
                image: 'https://via.placeholder.com/80?text=NTN',
                status: 'inactive',
                createdAt: '2024-01-07'
            },
            {
                id: 10,
                sku: 'TMK-6211',
                name: 'Timken Ball Bearing Premium',
                category: 'ball',
                categoryName: 'Ball Bearing',
                brand: 'Timken',
                price: 2100000,
                stock: 65,
                minStock: 10,
                image: 'https://via.placeholder.com/80?text=TMK',
                status: 'active',
                createdAt: '2024-01-06'
            }
        ];

        let filteredProducts = [...products];

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        // Dapatkan status stok
        function getStockStatus(product) {
            if (product.stock === 0) {
                return { label: 'Habis', class: 'bg-red-100 text-red-800', icon: 'fa-times-circle' };
            } else if (product.stock <= product.minStock) {
                return { label: 'Menipis', class: 'bg-yellow-100 text-yellow-800', icon: 'fa-exclamation-triangle' };
            } else {
                return { label: 'Tersedia', class: 'bg-green-100 text-green-800', icon: 'fa-check-circle' };
            }
        }

        // Dapatkan status produk
        function getProductStatus(status) {
            if (status === 'active') {
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-circle mr-1 text-xs"></i>Aktif</span>';
            } else {
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"><i class="fas fa-circle mr-1 text-xs"></i>Nonaktif</span>';
            }
        }

        // Render tabel
        function renderTable() {
            const tbody = document.getElementById('productTableBody');

            if (filteredProducts.length === 0) {
                tbody.innerHTML = `
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        <i class="fas fa-box-open text-4xl mb-3 text-gray-300"></i>
                                        <p>Tidak ada produk ditemukan</p>
                                    </td>
                                </tr>
                            `;
                return;
            }

            tbody.innerHTML = filteredProducts.map(product => {
                const stockStatus = getStockStatus(product);
                return `
                                <tr class="hover:bg-gray-50 transition-all">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img src="${product.image}" alt="${product.name}" 
                                                class="w-16 h-16 object-cover rounded-lg mr-4">
                                            <div>
                                                <div class="font-semibold text-gray-900">${product.name}</div>
                                                <div class="text-sm text-gray-500">SKU: ${product.sku}</div>
                                                <div class="text-xs text-blue-600 mt-1">${product.brand}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            ${product.categoryName}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">${formatCurrency(product.price)}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">${product.stock}</div>
                                        <span class="inline-flex items-center mt-1 text-xs ${stockStatus.class} px-2 py-0.5 rounded-full">
                                            <i class="fas ${stockStatus.icon} mr-1"></i>${stockStatus.label}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        ${getProductStatus(product.status)}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button onclick="viewProduct(${product.id})" 
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" 
                                                title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="editProduct(${product.id})" 
                                                class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-all" 
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="deleteProduct(${product.id})" 
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" 
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            `;
            }).join('');
        }

        // Select semua checkbox
        function selectAll(checkbox) {
            const checkboxes = document.querySelectorAll('#productTableBody input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
        }

        // Filter produk
        function filterProducts() {
            const categoryFilter = document.getElementById('categoryFilter').value;
            const stockFilter = document.getElementById('stockFilter').value;
            const searchInput = document.getElementById('searchInput').value.toLowerCase();

            filteredProducts = products.filter(product => {
                const matchCategory = !categoryFilter || product.category === categoryFilter;

                let matchStock = true;
                if (stockFilter === 'available') {
                    matchStock = product.stock > product.minStock;
                } else if (stockFilter === 'low') {
                    matchStock = product.stock > 0 && product.stock <= product.minStock;
                } else if (stockFilter === 'out') {
                    matchStock = product.stock === 0;
                }

                const matchSearch = !searchInput ||
                    product.name.toLowerCase().includes(searchInput) ||
                    product.sku.toLowerCase().includes(searchInput) ||
                    product.brand.toLowerCase().includes(searchInput);

                return matchCategory && matchStock && matchSearch;
            });

            renderTable();
        }

        // Event pencarian
        document.getElementById('searchInput').addEventListener('input', filterProducts);

        // Lihat produk
        function viewProduct(productId) {
            alert('Lihat detail produk ID: ' + productId + '\n\nFitur dalam pengembangan');
            // window.location.href = '/admin/produk/detail/' + productId;
        }

        // Edit produk
        function editProduct(productId) {
            alert('Edit produk ID: ' + productId + '\n\nFitur dalam pengembangan');
            // window.location.href = '/admin/produk/edit/' + productId;
        }

        // Hapus produk
        function deleteProduct(productId) {
            const product = products.find(p => p.id === productId);
            if (confirm('Hapus produk "' + product.name + '"?\n\nData tidak dapat dikembalikan.')) {
                alert('Produk berhasil dihapus\n\nFitur dalam pengembangan');
            }
        }

        // Export data
        function exportData() {
            alert('Export data produk ke Excel\n\nFitur dalam pengembangan');
        }
        // Reset filter
        function resetFilter() {
            document.getElementById('categoryFilter').value = '';
            document.getElementById('stockFilter').value = '';
            document.getElementById('searchInput').value = '';
            filteredProducts = [...products];
            renderTable();
        }

        // Inisialisasi
        renderTable();
        resetFilter();
    </script>
@endsection