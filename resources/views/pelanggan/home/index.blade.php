@extends('layout.pelanggan.app')

@section('title', 'Home - Bearing Shop')

@section('content')
   
    <div class="relative rounded-2xl shadow-xl mb-8 bg-linear-to-r from-blue-600 via-blue-700 to-blue-900">

        <!-- Pembungkus khusus SVG agar overflow-nya tidak mengganggu dropdown -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <svg class="w-full h-full opacity-[0.18]" xmlns="http://www.w3.org/2000/svg">
                <path d="M-50 100 C 200 0, 600 220, 1100 60" stroke="white" stroke-width="2.5" fill="none"
                    stroke-linecap="round" />
                <path d="M-50 340 C 200 240, 600 380, 1100 300" stroke="white" stroke-width="3" fill="none"
                    stroke-linecap="round" />
                <path d="M-50 420 C 250 310, 650 450, 1100 360" stroke="white" stroke-width="2.5" fill="none"
                    stroke-linecap="round" />
                <path d="M-50 500 C 240 390, 640 520, 1100 440" stroke="white" stroke-width="3" fill="none"
                    stroke-linecap="round" />
            </svg>
        </div>

        <div class="px-8 py-12 lg:px-12 lg:py-16 relative z-0">
            <div class="grid lg:grid-cols-2 gap-8 items-center">

                <div class="text-white">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                        Bearing Berkualitas <br>untuk Industri Anda
                    </h1>
                    <p class="text-blue-100 text-lg mb-6">
                        Temukan berbagai jenis bearing dari brand ternama dengan harga kompetitif.
                        Pengiriman cepat ke seluruh Indonesia.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="#" onclick="alert('Fitur katalog produk dalam pengembangan'); return false;"
                            class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-shopping-bag mr-2"></i>Belanja Sekarang
                        </a>

                        <a href="#categories"
                            class="bg-blue-500 bg-opacity-30 backdrop-blur-sm text-white px-8 py-3 rounded-lg font-semibold hover:bg-opacity-40 transition-all border-2 border-white border-opacity-30">
                            <i class="fas fa-th-large mr-2"></i>Lihat Kategori
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="absolute inset-0 bg-white opacity-10 rounded-full blur-3xl"></div>
                        <img src="{{ asset('assets/semua bearing.jpg') }}" alt="Bearing Products"
                            class="relative rounded-2xl shadow-xl">
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Bagian Fitur -->
    <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
            <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-shipping-fast text-blue-600 text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Pengiriman Cepat</h3>
            <p class="text-gray-600 text-sm">Gratis ongkir untuk pembelian di atas 1 juta</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
            <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Produk Original</h3>
            <p class="text-gray-600 text-sm">100% bearing original bergaransi resmi</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
            <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-headset text-orange-600 text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Support 24/7</h3>
            <p class="text-gray-600 text-sm">Tim support siap membantu kapan saja</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
            <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-tag text-purple-600 text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Harga Terbaik</h3>
            <p class="text-gray-600 text-sm">Dapatkan penawaran harga terbaik</p>
        </div>
    </div>

    <!-- Bagian Kategori -->
    <div id="categories" class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Kategori Bearing</h2>
                <p class="text-gray-600">Pilih kategori sesuai kebutuhan Anda</p>
            </div>
        </div>
        <div class="grid md:grid-cols-3 lg:grid-cols-6 gap-4" id="categoriesGrid">
            <!-- Kategori akan dimuat di sini oleh JavaScript -->
        </div>
    </div>

    <!-- Bagian Produk Terpopuler -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Produk Terpopuler</h2>
                <p class="text-gray-600">Produk bearing yang paling banyak diminati</p>
            </div>
            <a href="#" onclick="alert('Fitur katalog produk dalam pengembangan'); return false;"
                class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" id="popularProducts">
            <!-- Produk terpopuler akan dimuat di sini oleh JavaScript -->
        </div>
    </div>

    <!-- Bagian Produk Terbaru -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Produk Terbaru</h2>
                <p class="text-gray-600">Produk bearing terbaru di katalog kami</p>
            </div>
            <a href="#" onclick="alert('Fitur katalog produk dalam pengembangan'); return false;"
                class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" id="newProducts">
            <!-- Produk terbaru akan dimuat di sini oleh JavaScript -->
        </div>
    </div>

    <script>
        // Data Dummy Kategori
        const categories = [{
            id: 1,
            name: 'Ball Bearing',
            image: 'assets/ball_bearing.jpeg',
            color: 'blue',
            count: 245
        },
        {
            id: 2,
            name: 'Roller Bearing',
            image: 'assets/roller_bearing.jpeg',
            color: 'indigo',
            count: 189
        },
        {
            id: 3,
            name: 'Thrust Bearing',
            image: 'assets/thrust_bearing.jpg',
            color: 'purple',
            count: 156
        },
        {
            id: 4,
            name: 'Needle Bearing',
            image: 'assets/needle_bearing.jpeg',
            color: 'pink',
            count: 98
        },
        {
            id: 5,
            name: 'Angular Contact',
            image: 'assets/angular_contact_bearing.jpeg',
            color: 'red',
            count: 134
        },
        {
            id: 6,
            name: 'Spherical',
            image: 'assets/spherical_bearing.jpeg',
            color: 'orange',
            count: 112
        }
        ];

        // Data Dummy Produk Terpopuler
        const popularProducts = [{
            id: 1,
            name: 'SKF 6205-2RS Deep Groove Ball Bearing',
            brand: 'SKF',
            price: 125000,
            originalPrice: 150000,
            rating: 4.8,
            reviews: 124,
            sold: 1250,
            image: 'https://picsum.photos/300/300?random=101',
            badge: 'Terlaris'
        },
        {
            id: 2,
            name: 'NSK 6206 ZZ Ball Bearing',
            brand: 'NSK',
            price: 98000,
            originalPrice: 120000,
            rating: 4.7,
            reviews: 98,
            sold: 980,
            image: 'https://picsum.photos/300/300?random=102',
            badge: 'Diskon'
        },
        {
            id: 3,
            name: 'NTN 6207 LLU Deep Groove Ball Bearing',
            brand: 'NTN',
            price: 115000,
            originalPrice: null,
            rating: 4.9,
            reviews: 156,
            sold: 1100,
            image: 'https://picsum.photos/300/300?random=103',
            badge: 'Best Seller'
        },
        {
            id: 4,
            name: 'FAG 6208-2RSR Ball Bearing',
            brand: 'FAG',
            price: 145000,
            originalPrice: 175000,
            rating: 4.6,
            reviews: 87,
            sold: 765,
            image: 'https://picsum.photos/300/300?random=104',
            badge: 'Diskon'
        }
        ];

        // Data Dummy Produk Terbaru
        const newProducts = [{
            id: 5,
            name: 'TIMKEN 30205 Tapered Roller Bearing',
            brand: 'TIMKEN',
            price: 185000,
            originalPrice: null,
            rating: 4.5,
            reviews: 45,
            sold: 234,
            image: 'https://picsum.photos/300/300?random=105',
            badge: 'Baru'
        },
        {
            id: 6,
            name: 'KOYO 6209 ZZ Ball Bearing',
            brand: 'KOYO',
            price: 92000,
            originalPrice: 110000,
            rating: 4.4,
            reviews: 67,
            sold: 456,
            image: 'https://picsum.photos/300/300?random=106',
            badge: 'Baru'
        },
        {
            id: 7,
            name: 'SKF 51100 Thrust Ball Bearing',
            brand: 'SKF',
            price: 165000,
            originalPrice: null,
            rating: 4.7,
            reviews: 89,
            sold: 345,
            image: 'https://picsum.photos/300/300?random=107',
            badge: 'Baru'
        },
        {
            id: 8,
            name: 'NSK HR30208J Tapered Roller Bearing',
            brand: 'NSK',
            price: 195000,
            originalPrice: 220000,
            rating: 4.8,
            reviews: 102,
            sold: 567,
            image: 'https://picsum.photos/300/300?random=108',
            badge: 'Baru'
        }
        ];

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Render Kategori
        function renderCategories() {
            const grid = document.getElementById('categoriesGrid');

            grid.innerHTML = categories.map(cat => `
                                                <a href="#" onclick="alert('Kategori ' + '${cat.name}' + ' dalam pengembangan'); return false;" 
                                                   class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden cursor-pointer">
                                                    <div class="relative overflow-hidden h-32">
                                                        <img src="${cat.image}" alt="${cat.name}" 
                                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                    </div>
                                                    <div class="p-4 text-center">
                                                        <h3 class="font-semibold text-gray-900 mb-1">${cat.name}</h3>
                                                        <p class="text-sm text-gray-500">${cat.count} produk</p>
                                                    </div>
                                                </a>
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

            return `
                                                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all overflow-hidden group">
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
                                                        <div class="text-xs text-gray-500 mb-1 font-medium">${product.brand}</div>
                                                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 h-12">${product.name}</h3>
                                                        <div class="flex items-center mb-3">
                                                            <div class="flex items-center text-yellow-400 mr-2">
                                                                <i class="fas fa-star text-sm"></i>
                                                                <span class="text-sm font-semibold text-gray-700 ml-1">${product.rating}</span>
                                                            </div>
                                                            <span class="text-xs text-gray-500">
                                                                (${product.reviews} ulasan) • ${product.sold} terjual
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

        // Render Produk
        function renderProducts() {
            document.getElementById('popularProducts').innerHTML = popularProducts.map(renderProductCard).join('');
            document.getElementById('newProducts').innerHTML = newProducts.map(renderProductCard).join('');
        }

        // Fungsi Tambah ke Keranjang
        function addToCart(productId) {
            alert('Produk ID ' + productId + ' ditambahkan ke keranjang!');

        }

        // Fungsi Lihat Detail Produk
        function viewProductDetail(productId) {
            alert('Detail produk ID ' + productId + ' dalam pengembangan');

        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            renderCategories();
            renderProducts();
        });
    </script>
@endsection