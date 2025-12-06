@extends('layout.pelanggan.app')

@section('title', 'Detail Produk - Bearing Shop')

@section('content')
    <div class="mb-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
            <a href="#" onclick="alert('Kembali ke home'); return false;" class="hover:text-blue-600"><i
                    class="fas fa-home"></i></a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="#" onclick="alert('Kembali ke katalog'); return false;" class="hover:text-blue-600">Produk</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 font-medium" id="breadcrumbName">Loading...</span>
        </nav>

        <!-- Detail Produk -->
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            <!-- Gambar Produk -->
            <div>
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-4">
                    <div class="aspect-square bg-gray-100 flex items-center justify-center" id="mainImageContainer">
                        <img src="" alt="Product" id="mainImage" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-3" id="thumbnailsContainer">
                    <!-- Thumbnail akan dimuat di sini -->
                </div>
            </div>

            <!-- Info Produk -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="mb-6" id="productHeader">
                    <!-- Header produk akan dimuat di sini -->
                </div>

                <div class="mb-6" id="productRating">
                    <!-- Rating akan dimuat di sini -->
                </div>

                <div class="mb-6">
                    <div class="border-t border-b border-gray-200 py-4" id="productPrice">
                        <!-- Harga akan dimuat di sini -->
                    </div>
                </div>

                <div class="mb-6" id="productStock">
                    <!-- Stok akan dimuat di sini -->
                </div>

                <!-- Pemilih Jumlah -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Jumlah</label>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button onclick="decreaseQty()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-l-lg">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="quantity" value="1" min="1" max="99"
                                class="w-16 text-center border-x border-gray-300 py-2 focus:outline-none">
                            <button onclick="increaseQty()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-r-lg">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <span class="text-sm text-gray-600" id="maxStock"></span>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <button onclick="addToCart()"
                        class="bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                    </button>
                    <button onclick="buyNow()"
                        class="bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-bolt mr-2"></i>Beli Sekarang
                    </button>
                </div>

                <!-- Aksi Tambahan -->
                <div class="flex items-center justify-center space-x-6 pt-6 border-t border-gray-200">
                    <button onclick="toggleWishlist()"
                        class="flex items-center text-gray-600 hover:text-red-500 transition-all">
                        <i class="far fa-heart text-xl mr-2"></i>
                        <span class="text-sm">Wishlist</span>
                    </button>
                    <button onclick="shareProduct()"
                        class="flex items-center text-gray-600 hover:text-blue-500 transition-all">
                        <i class="fas fa-share-alt text-xl mr-2"></i>
                        <span class="text-sm">Bagikan</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tab Produk -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-8" id="tabs">
                    <button onclick="showTab('description')"
                        class="tab-button py-4 border-b-2 font-medium text-sm transition-all border-blue-600 text-blue-600"
                        data-tab="description">
                        Deskripsi Produk
                    </button>
                    <button onclick="showTab('specifications')"
                        class="tab-button py-4 border-b-2 font-medium text-sm transition-all border-transparent text-gray-500 hover:text-gray-700"
                        data-tab="specifications">
                        Spesifikasi
                    </button>
                    <button onclick="showTab('reviews')"
                        class="tab-button py-4 border-b-2 font-medium text-sm transition-all border-transparent text-gray-500 hover:text-gray-700"
                        data-tab="reviews">
                        <span>Ulasan</span>
                        <span class="ml-1 bg-gray-200 text-gray-700 px-2 py-0.5 rounded-full text-xs"
                            id="reviewCount">0</span>
                    </button>
                </nav>
            </div>

            <!-- Isi Tab -->
            <div class="p-8">
                <!-- Tab Deskripsi -->
                <div id="description-content" class="tab-content">
                    <div id="productDescription">
                        <!-- Deskripsi akan dimuat di sini -->
                    </div>
                </div>

                <!-- Tab Spesifikasi -->
                <div id="specifications-content" class="tab-content hidden">
                    <div class="grid md:grid-cols-2 gap-6" id="productSpecifications">
                        <!-- Spesifikasi akan dimuat di sini -->
                    </div>
                </div>

                <!-- Tab Ulasan -->
                <div id="reviews-content" class="tab-content hidden">
                    <div class="mb-6" id="reviewsSummary">
                        <!-- Ringkasan ulasan akan dimuat di sini -->
                    </div>
                    <div class="space-y-6" id="reviewsList">
                        <!-- Ulasan akan dimuat di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data Dummy Produk
        const products = {
            1: {
                id: 1,
                name: 'SKF 6205-2RS Deep Groove Ball Bearing',
                brand: 'SKF',
                category: 'Ball Bearing',
                price: 125000,
                originalPrice: 150000,
                rating: 4.8,
                reviews: 124,
                sold: 1250,
                stock: 50,
                sku: 'SKF-6205-2RS',
                weight: 128,
                badge: 'Terlaris',
                images: [
                    'https://picsum.photos/600/600?random=301',
                    'https://picsum.photos/600/600?random=302',
                    'https://picsum.photos/600/600?random=303',
                    'https://picsum.photos/600/600?random=304'
                ],
                description: `
                                        <p class="mb-4">SKF 6205-2RS adalah deep groove ball bearing berkualitas tinggi dengan desain sealed (rubber seal) 
                                        di kedua sisi untuk perlindungan maksimal terhadap kontaminan dan kebocoran pelumas.</p>

                                        <h3 class="font-bold text-lg mb-2">Keunggulan Produk:</h3>
                                        <ul class="list-disc list-inside mb-4 space-y-1">
                                            <li>Material baja berkualitas tinggi dengan perlakuan panas khusus</li>
                                            <li>Rubber seal di kedua sisi untuk perlindungan optimal</li>
                                            <li>Tingkat presisi tinggi untuk performa maksimal</li>
                                            <li>Kapasitas beban radial dan aksial yang baik</li>
                                            <li>Umur pakai lebih panjang dengan maintenance minimal</li>
                                            <li>Cocok untuk berbagai aplikasi industri</li>
                                        </ul>

                                        <h3 class="font-bold text-lg mb-2">Aplikasi:</h3>
                                        <p>Cocok untuk motor listrik, pompa, gearbox, mesin industri, conveyor, dan berbagai aplikasi mekanik lainnya.</p>
                                    `,
                specifications: {
                    'Tipe': 'Deep Groove Ball Bearing',
                    'Designasi': '6205-2RS',
                    'Inner Diameter (d)': '25 mm',
                    'Outer Diameter (D)': '52 mm',
                    'Width (B)': '15 mm',
                    'Dynamic Load Rating (C)': '14.0 kN',
                    'Static Load Rating (C0)': '7.8 kN',
                    'Limiting Speed (Grease)': '13000 rpm',
                    'Limiting Speed (Oil)': '17000 rpm',
                    'Seal Type': 'Rubber Seal (2RS)',
                    'Berat': '128 gram',
                    'Material': 'Chrome Steel'
                },
                relatedProducts: [2, 3, 6, 7]
            },
            2: {
                id: 2,
                name: 'NSK 6206 ZZ Ball Bearing',
                brand: 'NSK',
                category: 'Ball Bearing',
                price: 98000,
                originalPrice: 120000,
                rating: 4.7,
                reviews: 98,
                sold: 980,
                stock: 35,
                sku: 'NSK-6206-ZZ',
                weight: 195,
                badge: 'Diskon',
                images: [
                    'https://picsum.photos/600/600?random=305',
                    'https://picsum.photos/600/600?random=306',
                    'https://picsum.photos/600/600?random=307',
                    'https://picsum.photos/600/600?random=308'
                ],
                description: `
                                        <p class="mb-4">NSK 6206 ZZ adalah ball bearing dengan metal shield di kedua sisi, 
                                        memberikan perlindungan yang baik dengan kecepatan operasi yang lebih tinggi.</p>

                                        <h3 class="font-bold text-lg mb-2">Keunggulan Produk:</h3>
                                        <ul class="list-disc list-inside mb-4 space-y-1">
                                            <li>Metal shield untuk perlindungan dari debu dan kontaminan</li>
                                            <li>Kecepatan operasi lebih tinggi dibanding rubber seal</li>
                                            <li>Presisi tingkat tinggi untuk aplikasi presisi</li>
                                            <li>Low friction untuk efisiensi energi</li>
                                            <li>Umur pakai panjang dengan perawatan berkala</li>
                                        </ul>

                                        <h3 class="font-bold text-lg mb-2">Aplikasi:</h3>
                                        <p>Ideal untuk motor, pompa, fan, mesin tekstil, dan aplikasi yang membutuhkan kecepatan tinggi.</p>
                                    `,
                specifications: {
                    'Tipe': 'Deep Groove Ball Bearing',
                    'Designasi': '6206 ZZ',
                    'Inner Diameter (d)': '30 mm',
                    'Outer Diameter (D)': '62 mm',
                    'Width (B)': '16 mm',
                    'Dynamic Load Rating (C)': '19.5 kN',
                    'Static Load Rating (C0)': '11.2 kN',
                    'Limiting Speed (Grease)': '11000 rpm',
                    'Limiting Speed (Oil)': '15000 rpm',
                    'Seal Type': 'Metal Shield (ZZ)',
                    'Berat': '195 gram',
                    'Material': 'Bearing Steel'
                },
                relatedProducts: [1, 3, 4, 6]
            }
        };

        // Data Dummy Ulasan
        const reviews = [{
            id: 1,
            user: 'Budi Santoso',
            rating: 5,
            date: '2024-11-15',
            comment: 'Bearing sangat berkualitas, packing rapi dan pengiriman cepat. Sangat puas!',
            helpful: 24
        },
        {
            id: 2,
            user: 'Ahmad Wijaya',
            rating: 5,
            date: '2024-11-10',
            comment: 'Produk original, harga terjangkau. Sudah dipasang di mesin dan berjalan lancar.',
            helpful: 18
        },
        {
            id: 3,
            user: 'Siti Rahayu',
            rating: 4,
            date: '2024-11-05',
            comment: 'Barang sesuai deskripsi, cuma pengiriman agak lama. Overall recommended!',
            helpful: 12
        },
        {
            id: 4,
            user: 'Rudi Hermawan',
            rating: 5,
            date: '2024-10-28',
            comment: 'Kualitas top! Harga sangat kompetitif. Pasti beli lagi untuk stok.',
            helpful: 15
        }
        ];

        let currentProduct = null;
        let currentQty = 1;

        // Dapatkan ID produk dari URL
        function getProductId() {
            const urlParts = window.location.pathname.split('/');
            return parseInt(urlParts[urlParts.length - 1]) || 1;
        }

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Format tanggal
        function formatDate(dateString) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }

        // Muat detail produk
        function loadProduct() {
            const productId = getProductId();
            currentProduct = products[productId] || products[1];

            // Breadcrumb
            document.getElementById('breadcrumbName').textContent = currentProduct.name;

            // Gambar Utama
            document.getElementById('mainImage').src = currentProduct.images[0];

            // Thumbnail
            const thumbnailsContainer = document.getElementById('thumbnailsContainer');
            thumbnailsContainer.innerHTML = currentProduct.images.map((img, index) => `
                                    <div class="aspect-square rounded-lg overflow-hidden border-2 ${index === 0 ? 'border-blue-600' : 'border-gray-200'} cursor-pointer hover:border-blue-400 transition-all"
                                         onclick="changeImage('${img}', this)">
                                        <img src="${img}" alt="Thumbnail ${index + 1}" class="w-full h-full object-cover">
                                    </div>
                                `).join('');

            // Header Produk
            const badge = currentProduct.badge ? `
                                    <span class="bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        ${currentProduct.badge}
                                    </span>
                                ` : '';

            document.getElementById('productHeader').innerHTML = `
                                    ${badge}
                                    <h1 class="text-3xl font-bold text-gray-900 mt-2 mb-3">${currentProduct.name}</h1>
                                    <div class="flex items-center space-x-4 text-sm">
                                        <span class="text-gray-600">Brand: <span class="font-semibold text-gray-900">${currentProduct.brand}</span></span>
                                        <span class="text-gray-300">|</span>
                                        <span class="text-gray-600">SKU: <span class="font-mono">${currentProduct.sku}</span></span>
                                        <span class="text-gray-300">|</span>
                                        <span class="text-gray-600">${currentProduct.sold} Terjual</span>
                                    </div>
                                `;

            // Rating
            const stars = Array(5).fill(0).map((_, i) => {
                const fullStar = i < Math.floor(currentProduct.rating);
                const halfStar = i === Math.floor(currentProduct.rating) && currentProduct.rating % 1 >= 0.5;
                return fullStar ? '<i class="fas fa-star text-yellow-400"></i>' :
                    halfStar ? '<i class="fas fa-star-half-alt text-yellow-400"></i>' :
                        '<i class="far fa-star text-yellow-400"></i>';
            }).join('');

            document.getElementById('productRating').innerHTML = `
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="flex">${stars}</div>
                                            <span class="text-xl font-bold text-gray-900">${currentProduct.rating}</span>
                                        </div>
                                        <span class="text-gray-300">|</span>
                                        <button onclick="showTab('reviews')" class="text-blue-600 hover:underline">
                                            ${currentProduct.reviews} Ulasan
                                        </button>
                                    </div>
                                `;

            // Harga
            const discount = currentProduct.originalPrice ? Math.round(((currentProduct.originalPrice - currentProduct
                .price) / currentProduct.originalPrice) * 100) : 0;

            document.getElementById('productPrice').innerHTML = `
                                    <div class="flex items-center justify-between">
                                        <div>
                                            ${currentProduct.originalPrice ? `
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <span class="text-lg text-gray-400 line-through">${formatCurrency(currentProduct.originalPrice)}</span>
                                                    <span class="bg-red-100 text-red-600 text-sm font-bold px-2 py-0.5 rounded">-${discount}%</span>
                                                </div>
                                            ` : ''}
                                            <div class="text-3xl font-bold text-blue-600">${formatCurrency(currentProduct.price)}</div>
                                        </div>
                                    </div>
                                `;

            // Stok
            const stockColor = currentProduct.stock > 20 ? 'text-green-600' : currentProduct.stock > 0 ?
                'text-orange-600' : 'text-red-600';
            const stockText = currentProduct.stock > 0 ? `Stok: ${currentProduct.stock}` : 'Stok Habis';

            document.getElementById('productStock').innerHTML = `
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-box ${stockColor}"></i>
                                        <span class="font-semibold ${stockColor}">${stockText}</span>
                                    </div>
                                `;

            document.getElementById('maxStock').textContent = `Maksimal ${currentProduct.stock} pcs`;
            document.getElementById('quantity').max = currentProduct.stock;

            // Deskripsi
            document.getElementById('productDescription').innerHTML = currentProduct.description;

            // Spesifikasi
            document.getElementById('productSpecifications').innerHTML = Object.entries(currentProduct.specifications)
                .map(([key, value]) => `
                                    <div class="flex justify-between py-3 border-b border-gray-200">
                                        <span class="font-medium text-gray-700">${key}</span>
                                        <span class="text-gray-900">${value}</span>
                                    </div>
                                `).join('');

            // Reviews
            loadReviews();

        }

        // Muat Ulasan
        function loadReviews() {
            document.getElementById('reviewCount').textContent = reviews.length;

            // Ringkasan Ulasan
            const avgRating = currentProduct.rating;
            const ratingDistribution = {
                5: 78,
                4: 15,
                3: 5,
                2: 1,
                1: 1
            };

            document.getElementById('reviewsSummary').innerHTML = `
                                    <div class="grid md:grid-cols-2 gap-8 p-6 bg-gray-50 rounded-xl">
                                        <div class="text-center">
                                            <div class="text-5xl font-bold text-gray-900 mb-2">${avgRating}</div>
                                            <div class="flex justify-center mb-2">
                                                ${Array(5).fill(0).map((_, i) => i < Math.round(avgRating) ? '<i class="fas fa-star text-yellow-400"></i>' : '<i class="far fa-star text-yellow-400"></i>').join('')}
                                            </div>
                                            <p class="text-gray-600">${currentProduct.reviews} ulasan</p>
                                        </div>
                                        <div class="space-y-2">
                                            ${Object.entries(ratingDistribution).reverse().map(([star, percent]) => `
                                                <div class="flex items-center space-x-3">
                                                    <span class="text-sm text-gray-600 w-12">${star} <i class="fas fa-star text-xs text-yellow-400"></i></span>
                                                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: ${percent}%"></div>
                                                    </div>
                                                    <span class="text-sm text-gray-600 w-12 text-right">${percent}%</span>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                `;

            // Daftar Ulasan
            document.getElementById('reviewsList').innerHTML = reviews.map(review => `
                                    <div class="border-b border-gray-200 pb-6">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <span class="font-semibold text-blue-600">${review.user.charAt(0)}</span>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">${review.user}</div>
                                                    <div class="text-sm text-gray-500">${formatDate(review.date)}</div>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                ${Array(5).fill(0).map((_, i) => i < review.rating ? '<i class="fas fa-star text-yellow-400 text-sm"></i>' : '<i class="far fa-star text-gray-300 text-sm"></i>').join('')}
                                            </div>
                                        </div>
                                        <p class="text-gray-700 mb-3">${review.comment}</p>
                                        <button class="text-sm text-gray-500 hover:text-blue-600">
                                            <i class="far fa-thumbs-up mr-1"></i>Membantu (${review.helpful})
                                        </button>
                                    </div>
                                `).join('');
        }

        // Ubah Gambar
        function changeImage(src, element) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('#thumbnailsContainer > div').forEach(el => {
                el.classList.remove('border-blue-600');
                el.classList.add('border-gray-200');
            });
            element.classList.remove('border-gray-200');
            element.classList.add('border-blue-600');
        }

        // Fungsi Tab
        function showTab(tabName) {
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('border-blue-600', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            document.querySelector(`[data-tab="${tabName}"]`).classList.remove('border-transparent', 'text-gray-500');
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('border-blue-600', 'text-blue-600');
            document.getElementById(`${tabName}-content`).classList.remove('hidden');
        }

        // Fungsi Jumlah
        function increaseQty() {
            const qty = document.getElementById('quantity');
            const max = parseInt(qty.max);
            const value = parseInt(qty.value);

            if (value < max) {
                qty.value = value + 1;
            }
        }

        function decreaseQty() {
            const qty = document.getElementById('quantity');
            const min = parseInt(qty.min);
            const value = parseInt(qty.value);

            if (value > min) {
                qty.value = value - 1;
            }
        }


        // Fungsi Aksi
        function addToCart() {
            const qty = parseInt(document.getElementById('quantity').value);
            alert(`${qty} x "${currentProduct.name}" ditambahkan ke keranjang!`);
            // TODO: Implementasikan fungsi keranjang sebenarnya
        }

        function buyNow() {
            const qty = parseInt(document.getElementById('quantity').value);
            alert(`Membeli ${qty} x "${currentProduct.name}" sekarang!`);
            // TODO: Implementasikan fungsi checkout
        }

        function toggleWishlist() {
            alert('Ditambahkan ke wishlist!');
            // TODO: Implementasikan fungsi wishlist
        }

        function shareProduct() {
            if (navigator.share) {
                navigator.share({
                    title: currentProduct.name,
                    text: `Lihat produk ${currentProduct.name} di Bearing Shop`,
                    url: window.location.href
                });
            } else {
                alert('Link produk: ' + window.location.href);
            }
        }

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function () {
            loadProduct();
        });
    </script>
@endsection