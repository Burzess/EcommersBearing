@extends('layout.pelanggan.app')

@section('title', 'Katalog Produk - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl p-8 mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Katalog Produk Bearing</h1>
        <p class="text-blue-100">Temukan bearing berkualitas tinggi dari berbagai brand ternama</p>
    </div>

    <div class="grid lg:grid-cols-4 gap-6">
        <!-- Sidebar Filter -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-filter mr-2 text-blue-600"></i>Filter Produk
                </h3>

                <!-- Pencarian -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari nama produk..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>

                <!-- Filter Kategori -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Kategori</label>
                    <div class="space-y-2" id="categoryFilter">
                        <!-- Kategori akan dimuat di sini -->
                    </div>
                </div>

                <!-- Filter Brand -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Brand</label>
                    <div class="space-y-2" id="brandFilter">
                        <!-- Brand akan dimuat di sini -->
                    </div>
                </div>

                <!-- Rentang Harga -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Rentang Harga</label>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="price" value="all" checked
                                class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Semua Harga</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="price" value="0-100000"
                                class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Di bawah Rp 100.000</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="price" value="100000-200000"
                                class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Rp 100.000 - Rp 200.000</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="price" value="200000-500000"
                                class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Rp 200.000 - Rp 500.000</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="price" value="500000-999999999"
                                class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Di atas Rp 500.000</span>
                        </label>
                    </div>
                </div>

                <!-- Filter Rating -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Rating</label>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" value="5" class="rating-filter w-4 h-4 text-blue-600 rounded">
                            <span class="ml-2 text-sm text-gray-700 flex items-center">
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <span class="ml-1">5</span>
                            </span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" value="4" class="rating-filter w-4 h-4 text-blue-600 rounded">
                            <span class="ml-2 text-sm text-gray-700 flex items-center">
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <span class="ml-1">4 ke atas</span>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Tombol Reset Filter -->
                <button onclick="resetFilters()"
                    class="w-full bg-gray-100 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-200 transition-all">
                    <i class="fas fa-redo mr-2"></i>Reset Filter
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            <!-- Toolbar -->
            <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-sm">Menampilkan</span>
                    <span class="font-semibold text-blue-600" id="productCount">0</span>
                    <span class="text-gray-600 text-sm">produk</span>
                </div>
                <div class="flex items-center gap-3">
                    <label class="text-sm text-gray-600">Urutkan:</label>
                    <select id="sortSelect"
                        class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="popular">Terpopuler</option>
                        <option value="newest">Terbaru</option>
                        <option value="price-low">Harga Terendah</option>
                        <option value="price-high">Harga Tertinggi</option>
                        <option value="name">Nama A-Z</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6" id="productsGrid">
                <!-- Produk akan dimuat di sini oleh JavaScript -->
            </div>

            <!-- Status Kosong -->
            <div id="emptyState" class="hidden bg-white rounded-xl shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-gray-400 text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Produk Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-4">Coba ubah filter pencarian Anda</p>
                <button onclick="resetFilters()"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all">
                    Reset Filter
                </button>
            </div>

            <!-- Pagination -->
            <div id="pagination" class="flex justify-center items-center gap-2">
                <!-- Pagination akan dimuat di sini -->
            </div>
        </div>
    </div>

    <script>
        // Data Dummy
        const allProducts = [{
            id: 1,
            name: 'SKF 6205-2RS Deep Groove Ball Bearing',
            brand: 'SKF',
            category: 'Ball Bearing',
            categoryId: 1,
            price: 125000,
            originalPrice: 150000,
            rating: 4.8,
            reviews: 124,
            sold: 1250,
            image: 'https://picsum.photos/300/300?random=201',
            badge: 'Terlaris',
            stock: 50
        },
        {
            id: 2,
            name: 'NSK 6206 ZZ Ball Bearing',
            brand: 'NSK',
            category: 'Ball Bearing',
            categoryId: 1,
            price: 98000,
            originalPrice: 120000,
            rating: 4.7,
            reviews: 98,
            sold: 980,
            image: 'https://picsum.photos/300/300?random=202',
            badge: 'Diskon',
            stock: 35
        },
        {
            id: 3,
            name: 'NTN 6207 LLU Deep Groove Ball Bearing',
            brand: 'NTN',
            category: 'Ball Bearing',
            categoryId: 1,
            price: 115000,
            originalPrice: null,
            rating: 4.9,
            reviews: 156,
            sold: 1100,
            image: 'https://picsum.photos/300/300?random=203',
            badge: 'Best Seller',
            stock: 45
        },
        {
            id: 4,
            name: 'FAG 6208-2RSR Ball Bearing',
            brand: 'FAG',
            category: 'Ball Bearing',
            categoryId: 1,
            price: 145000,
            originalPrice: 175000,
            rating: 4.6,
            reviews: 87,
            sold: 765,
            image: 'https://picsum.photos/300/300?random=204',
            badge: 'Diskon',
            stock: 28
        },
        {
            id: 5,
            name: 'TIMKEN 30205 Tapered Roller Bearing',
            brand: 'TIMKEN',
            category: 'Roller Bearing',
            categoryId: 2,
            price: 185000,
            originalPrice: null,
            rating: 4.5,
            reviews: 45,
            sold: 234,
            image: 'https://picsum.photos/300/300?random=205',
            badge: 'Baru',
            stock: 20
        },
        {
            id: 6,
            name: 'KOYO 6209 ZZ Ball Bearing',
            brand: 'KOYO',
            category: 'Ball Bearing',
            categoryId: 1,
            price: 92000,
            originalPrice: 110000,
            rating: 4.4,
            reviews: 67,
            sold: 456,
            image: 'https://picsum.photos/300/300?random=206',
            badge: 'Baru',
            stock: 30
        },
        {
            id: 7,
            name: 'SKF 51100 Thrust Ball Bearing',
            brand: 'SKF',
            category: 'Thrust Bearing',
            categoryId: 3,
            price: 165000,
            originalPrice: null,
            rating: 4.7,
            reviews: 89,
            sold: 345,
            image: 'https://picsum.photos/300/300?random=207',
            badge: null,
            stock: 15
        },
        {
            id: 8,
            name: 'NSK HR30208J Tapered Roller Bearing',
            brand: 'NSK',
            category: 'Roller Bearing',
            categoryId: 2,
            price: 195000,
            originalPrice: 220000,
            rating: 4.8,
            reviews: 102,
            sold: 567,
            image: 'https://picsum.photos/300/300?random=208',
            badge: 'Baru',
            stock: 25
        },
        {
            id: 9,
            name: 'NTN NA4904 Needle Roller Bearing',
            brand: 'NTN',
            category: 'Needle Bearing',
            categoryId: 4,
            price: 135000,
            originalPrice: null,
            rating: 4.6,
            reviews: 76,
            sold: 290,
            image: 'https://picsum.photos/300/300?random=209',
            badge: null,
            stock: 40
        },
        {
            id: 10,
            name: 'FAG 7208-B-XL-JP Angular Contact Ball Bearing',
            brand: 'FAG',
            category: 'Angular Contact',
            categoryId: 5,
            price: 220000,
            originalPrice: 250000,
            rating: 4.9,
            reviews: 134,
            sold: 678,
            image: 'https://picsum.photos/300/300?random=210',
            badge: 'Terlaris',
            stock: 18
        },
        {
            id: 11,
            name: 'SKF 22205 E Spherical Roller Bearing',
            brand: 'SKF',
            category: 'Spherical',
            categoryId: 6,
            price: 275000,
            originalPrice: null,
            rating: 4.8,
            reviews: 95,
            sold: 445,
            image: 'https://picsum.photos/300/300?random=211',
            badge: null,
            stock: 12
        },
        {
            id: 12,
            name: 'TIMKEN SET1 Tapered Roller Bearing',
            brand: 'TIMKEN',
            category: 'Roller Bearing',
            categoryId: 2,
            price: 310000,
            originalPrice: 350000,
            rating: 4.7,
            reviews: 112,
            sold: 523,
            image: 'https://picsum.photos/300/300?random=212',
            badge: 'Diskon',
            stock: 22
        }
        ];

        const categories = [{
            id: 1,
            name: 'Ball Bearing'
        },
        {
            id: 2,
            name: 'Roller Bearing'
        },
        {
            id: 3,
            name: 'Thrust Bearing'
        },
        {
            id: 4,
            name: 'Needle Bearing'
        },
        {
            id: 5,
            name: 'Angular Contact'
        },
        {
            id: 6,
            name: 'Spherical'
        }
        ];

        const brands = ['SKF', 'NSK', 'NTN', 'FAG', 'TIMKEN', 'KOYO'];

        let filteredProducts = [...allProducts];
        let currentPage = 1;
        const productsPerPage = 9;

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Render Filter
        function renderFilters() {
            // Filter Kategori
            const categoryFilter = document.getElementById('categoryFilter');
            const categoryCounts = {};
            allProducts.forEach(p => {
                categoryCounts[p.categoryId] = (categoryCounts[p.categoryId] || 0) + 1;
            });

            categoryFilter.innerHTML = categories.map(cat => `
                                    <label class="flex items-center justify-between cursor-pointer hover:bg-gray-50 p-2 rounded">
                                        <div class="flex items-center">
                                            <input type="checkbox" value="${cat.id}" class="category-filter w-4 h-4 text-blue-600 rounded">
                                            <span class="ml-2 text-sm text-gray-700">${cat.name}</span>
                                        </div>
                                        <span class="text-xs text-gray-500">(${categoryCounts[cat.id] || 0})</span>
                                    </label>
                                `).join('');

            // Filter Brand
            const brandFilter = document.getElementById('brandFilter');
            const brandCounts = {};
            allProducts.forEach(p => {
                brandCounts[p.brand] = (brandCounts[p.brand] || 0) + 1;
            });

            brandFilter.innerHTML = brands.map(brand => `
                                    <label class="flex items-center justify-between cursor-pointer hover:bg-gray-50 p-2 rounded">
                                        <div class="flex items-center">
                                            <input type="checkbox" value="${brand}" class="brand-filter w-4 h-4 text-blue-600 rounded">
                                            <span class="ml-2 text-sm text-gray-700">${brand}</span>
                                        </div>
                                        <span class="text-xs text-gray-500">(${brandCounts[brand] || 0})</span>
                                    </label>
                                `).join('');
        }

        // Render Kartu Produk
        function renderProductCard(product) {
            const badgeColors = {
                'Terlaris': 'bg-red-500',
                'Diskon': 'bg-green-500',
                'Best Seller': 'bg-blue-600',
                'Baru': 'bg-orange-500'
            };

            const discount = product.originalPrice ? Math.round(((product.originalPrice - product.price) / product
                .originalPrice) * 100) : 0;
            return ` <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all overflow-hidden group">
                                        <div class="relative overflow-hidden bg-gray-100">
                                            <img src="${product.image}" alt="${product.name}" 
                                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                                            ${product.badge ? `
                                                <div class="absolute top-3 left-3">
                                                    <span class="${badgeColors[product.badge]} text-white text-xs font-semibold px-3 py-1 rounded-full">
                                                        ${product.badge}
                                                    </span>
                                                </div>
                                            ` : ''}
                                            ${discount > 0 ? `
                                                <div class="absolute top-3 right-3">
                                                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                                        -${discount}%
                                                    </span>
                                                </div>
                                            ` : ''}
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                                                <a href="#" onclick="viewProductDetail(${product.id}); return false;" 
                                                   class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all">
                                                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                        <div class="p-5">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-xs text-gray-500 font-medium">${product.brand}</span>
                                                <span class="text-xs ${product.stock > 20 ? 'text-green-600' : 'text-orange-600'} font-medium">
                                                    <i class="fas fa-box mr-1"></i>Stok: ${product.stock}
                                                </span>
                                            </div>
                                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 h-12">${product.name}</h3>
                                            <div class="flex items-center mb-3">
                                                <div class="flex items-center text-yellow-400 mr-2">
                                                    <i class="fas fa-star text-sm"></i>
                                                    <span class="text-sm font-semibold text-gray-700 ml-1">${product.rating}</span>
                                                </div>
                                                <span class="text-xs text-gray-500">
                                                    (${product.reviews}) • ${product.sold} terjual
                                                </span>
                                            </div>
                                            <div class="mb-4">
                                                ${product.originalPrice ? `
                                                    <div class="text-sm text-gray-400 line-through">${formatCurrency(product.originalPrice)}</div>
                                                ` : ''}
                                                <div class="text-xl font-bold text-blue-600">${formatCurrency(product.price)}</div>
                                            </div>
                                            <button onclick="addToCart(${product.id})" 
                                                    class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-all flex items-center justify-center">
                                                <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                                            </button>
                                        </div>
                                    </div>
                                `;
        }

        // Terapkan Filter
        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked')).map(cb => parseInt(
                cb.value));
            const selectedBrands = Array.from(document.querySelectorAll('.brand-filter:checked')).map(cb => cb.value);
            const selectedPrice = document.querySelector('input[name="price"]:checked').value;
            const selectedRatings = Array.from(document.querySelectorAll('.rating-filter:checked')).map(cb => parseFloat(cb
                .value));

            filteredProducts = allProducts.filter(product => {
                // Filter pencarian
                if (searchTerm && !product.name.toLowerCase().includes(searchTerm)) return false;

                // Filter kategori
                if (selectedCategories.length > 0 && !selectedCategories.includes(product.categoryId)) return false;

                // Filter brand
                if (selectedBrands.length > 0 && !selectedBrands.includes(product.brand)) return false;

                // Filter harga
                if (selectedPrice !== 'all') {
                    const [min, max] = selectedPrice.split('-').map(Number);
                    if (product.price < min || product.price > max) return false;
                }

                // Filter rating
                if (selectedRatings.length > 0) {
                    const meetsRating = selectedRatings.some(rating => {
                        if (rating === 5) return product.rating === 5;
                        return product.rating >= rating;
                    });
                    if (!meetsRating) return false;
                }

                return true;
            });

            sortProducts();
            currentPage = 1;
            renderProducts();
        }

        // Urutkan Produk
        function sortProducts() {
            const sortValue = document.getElementById('sortSelect').value;

            switch (sortValue) {
                case 'popular':
                    filteredProducts.sort((a, b) => b.sold - a.sold);
                    break;
                case 'newest':
                    filteredProducts.sort((a, b) => b.id - a.id);
                    break;
                case 'price-low':
                    filteredProducts.sort((a, b) => a.price - b.price);
                    break;
                case 'price-high':
                    filteredProducts.sort((a, b) => b.price - a.price);
                    break;
                case 'name':
                    filteredProducts.sort((a, b) => a.name.localeCompare(b.name));
                    break;
            }
        }

        // Render Produk
        function renderProducts() {
            const grid = document.getElementById('productsGrid');
            const emptyState = document.getElementById('emptyState');
            const productCount = document.getElementById('productCount');
            // Perbarui jumlah produk
            productCount.textContent = filteredProducts.length;

            // Jika tidak ada produk yang ditemukan
            if (filteredProducts.length === 0) {
                grid.classList.add('hidden');
                emptyState.classList.remove('hidden');
                return;
            }

            // jika ada produk, tampilkan grid
            grid.classList.remove('hidden');
            emptyState.classList.add('hidden');
            // diambil sesuai halaman
            const start = (currentPage - 1) * productsPerPage;
            const end = start + productsPerPage;
            // potong array produk sesuai halaman
            const pageProducts = filteredProducts.slice(start, end);
            // render produk pada halaman saat ini
            grid.innerHTML = pageProducts.map(renderProductCard).join('');

            renderPagination();
        }

        // Render Halaman
        function renderPagination() {
            const pagination = document.getElementById('pagination');
            const totalPages = Math.ceil(filteredProducts.length / productsPerPage);

            if (totalPages <= 1) {
                pagination.innerHTML = '';
                return;
            }

            let html = '';

            // Tombol sebelumnya
            html += ` <button onclick="changePage(${currentPage - 1})" 
                                            ${currentPage === 1 ? 'disabled' : ''}
                                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                `;

            // Nomor halaman
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    html += `
                                            <button onclick="changePage(${i})" 
                                                    class="px-4 py-2 border rounded-lg ${i === currentPage ? 'bg-blue-600 text-white border-blue-600' : 'border-gray-300 hover:bg-gray-50'}">
                                                ${i}
                                            </button>
                                        `;
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    html += '<span class="px-2">...</span>';
                }
            }

            // Tombol selanjutnya
            html += ` <button onclick="changePage(${currentPage + 1})" 
                                            ${currentPage === totalPages ? 'disabled' : ''}
                                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                `;

            pagination.innerHTML = html;
        }

        // Ubah Halaman
        function changePage(page) {
            const totalPages = Math.ceil(filteredProducts.length / productsPerPage);
            if (page < 1 || page > totalPages) return;

            currentPage = page;
            renderProducts();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Reset Filter
        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.querySelectorAll('.category-filter, .brand-filter, .rating-filter').forEach(cb => cb.checked = false);
            document.querySelector('input[name="price"][value="all"]').checked = true;
            document.getElementById('sortSelect').value = 'popular';
            applyFilters();
        }

        // Tambah ke Keranjang
        function addToCart(productId) {
            const product = allProducts.find(p => p.id === productId);
            alert(`"${product.name}" ditambahkan ke keranjang!`);
            // TODO: Implementasikan fungsi keranjang sebenarnya
        }

        // Lihat Detail Produk
        function viewProductDetail(productId) {
            const product = allProducts.find(p => p.id === productId);
            alert(`Detail produk "${product.name}" dalam pengembangan`);
            // TODO: Navigasi ke halaman detail saat backend siap
        }

        // Event Listener
        document.addEventListener('DOMContentLoaded', function () {
            renderFilters();
            applyFilters();

            // Input pencarian
            document.getElementById('searchInput').addEventListener('input', applyFilters);

            // Checkbox filter
            document.addEventListener('change', function (e) {
                if (e.target.classList.contains('category-filter') ||
                    e.target.classList.contains('brand-filter') ||
                    e.target.classList.contains('rating-filter') ||
                    e.target.name === 'price') {
                    applyFilters();
                }
            });

            // Pilihan urutan
            document.getElementById('sortSelect').addEventListener('change', function () {
                sortProducts();
                renderProducts();
            });
        });
    </script>
@endsection