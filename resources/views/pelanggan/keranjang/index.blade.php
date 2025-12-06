@extends('layout.pelanggan.app')

@section('title', 'Keranjang Belanja - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Keranjang Belanja</h1>
                <p class="text-blue-100">Kelola produk yang ingin Anda beli</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-white text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Daftar Produk Keranjang -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Header Keranjang -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" id="selectAll" onchange="selectAllItems()"
                            class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                        <label for="selectAll" class="font-semibold text-gray-900">Pilih Semua (<span
                                id="totalItems">0</span> Produk)</label>
                    </div>
                    <button onclick="deleteSelected()"
                        class="text-red-600 hover:text-red-700 font-medium text-sm flex items-center">
                        <i class="fas fa-trash mr-2"></i>Hapus Pilihan
                    </button>
                </div>
            </div>

            <!-- Item Keranjang -->
            <div id="cartItems">
                <!-- Item akan dimuat oleh JavaScript -->
            </div>

            <!-- Status Kosong -->
            <div id="emptyCart" class="hidden bg-white rounded-xl shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shopping-cart text-gray-400 text-5xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Keranjang Belanja Kosong</h3>
                <p class="text-gray-600 mb-6">Belum ada produk di keranjang Anda. Yuk, mulai belanja sekarang!</p>
                <a href="#" onclick="alert('Navigasi ke katalog produk'); return false;"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                    <i class="fas fa-shopping-bag mr-2"></i>Belanja Sekarang
                </a>
            </div>
        </div>

        <!-- Ringkasan Belanja -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Belanja</h3>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-gray-700">
                        <span>Total Harga (<span id="selectedCount">0</span> barang)</span>
                        <span id="subtotal" class="font-semibold">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Biaya Pengiriman</span>
                        <span id="shipping" class="font-semibold">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Biaya Layanan</span>
                        <span class="font-semibold">Rp 1.000</span>
                    </div>

                    <!-- Voucher -->
                    <div class="pt-3 border-t border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-700">Kode Voucher</span>
                            <button onclick="toggleVoucher()" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                <i class="fas fa-tag mr-1"></i>Pilih Voucher
                            </button>
                        </div>
                        <div id="voucherSection" class="hidden space-y-2">
                            <input type="text" id="voucherCode" placeholder="Masukkan kode voucher"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                            <button onclick="applyVoucher()"
                                class="w-full px-4 py-2 bg-blue-50 text-blue-600 rounded-lg font-medium hover:bg-blue-100 transition-all text-sm">
                                Terapkan
                            </button>
                        </div>
                        <div id="appliedVoucher" class="flex items-center justify-between bg-green-50 px-3 py-2 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-check-circle text-green-600"></i>
                                <span class="text-sm font-medium text-green-700" id="voucherName"></span>
                            </div>
                            <button onclick="removeVoucher()" class="text-red-600 hover:text-red-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Diskon Voucher -->
                    <div id="discountRow" class="flex justify-between text-green-600">
                        <span>Diskon Voucher</span>
                        <span id="discount" class="font-semibold">- Rp 0</span>
                    </div>
                </div>

                <!-- Total Pembayaran -->
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                        <div class="text-right">
                            <div id="total" class="text-2xl font-bold text-blue-600">Rp 0</div>
                            <div class="text-xs text-gray-500 mt-1">Termasuk PPN</div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Checkout -->
                <button onclick="checkout()" id="checkoutBtn" disabled
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                    <i class="fas fa-lock mr-2"></i>Lanjut ke Pembayaran
                </button>

                <div class="mt-4 text-center">
                    <a href="#" onclick="alert('Navigasi ke katalog produk'); return false;"
                        class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                        <i class="fas fa-arrow-left mr-2"></i>Lanjut Belanja
                    </a>
                </div>

                <!-- Info Keamanan -->
                <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-shield-alt text-green-600 mt-1"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Transaksi Aman</p>
                            <p class="text-xs text-gray-600">Data Anda dilindungi dengan enkripsi SSL</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-undo text-blue-600 mt-1"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Garansi Uang Kembali</p>
                            <p class="text-xs text-gray-600">Jika produk tidak sesuai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data Dummy Keranjang
        const cartData = [
            {
                id: 1,
                name: 'SKF 6205-2RS Deep Groove Ball Bearing',
                brand: 'SKF',
                image: 'https://picsum.photos/100/100?random=1',
                price: 125000,
                stock: 50,
                quantity: 2,
                selected: false
            },
            {
                id: 2,
                name: 'NSK 6206-ZZ Deep Groove Ball Bearing',
                brand: 'NSK',
                image: 'https://picsum.photos/100/100?random=2',
                price: 145000,
                stock: 30,
                quantity: 1,
                selected: false
            },
            {
                id: 3,
                name: 'NTN 6207-LLU Deep Groove Ball Bearing',
                brand: 'NTN',
                image: 'https://picsum.photos/100/100?random=3',
                price: 165000,
                stock: 25,
                quantity: 3,
                selected: false
            },
            {
                id: 4,
                name: 'FAG 6208-2RSR Deep Groove Ball Bearing',
                brand: 'FAG',
                image: 'https://picsum.photos/100/100?random=4',
                price: 185000,
                stock: 15,
                quantity: 1,
                selected: false
            }
        ];

        let voucher = null;

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Render Item Keranjang
        function renderCartItems() {
            const container = document.getElementById('cartItems');
            const emptyCart = document.getElementById('emptyCart');

            if (cartData.length === 0) {
                container.classList.add('hidden');
                emptyCart.classList.remove('hidden');
                return;
            }

            container.classList.remove('hidden');
            emptyCart.classList.add('hidden');

            container.innerHTML = cartData.map(item => `
                        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
                            <div class="flex items-start space-x-4">
                                <!-- Checkbox -->
                                <input type="checkbox" ${item.selected ? 'checked' : ''} 
                                       onchange="toggleItem(${item.id})"
                                       class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500 mt-2">

                                <!-- Gambar Produk -->
                                <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                                    <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover">
                                </div>

                                <!-- Info Produk -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between mb-2">
                                        <div class="flex-1 pr-4">
                                            <p class="text-xs text-gray-500 mb-1">${item.brand}</p>
                                            <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">${item.name}</h4>
                                            <div class="flex items-center space-x-2 mb-3">
                                                <span class="text-lg font-bold text-blue-600">${formatCurrency(item.price)}</span>
                                                ${item.stock < 10 ? `
                                                    <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded">Stok tinggal ${item.stock}</span>
                                                ` : ''}
                                            </div>
                                        </div>
                                        <button onclick="removeItem(${item.id})" 
                                                class="text-gray-400 hover:text-red-600 transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Kontrol Jumlah -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <button onclick="decreaseQuantity(${item.id})" 
                                                    class="w-8 h-8 rounded-lg border border-gray-300 hover:bg-gray-100 flex items-center justify-center">
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                            <input type="number" value="${item.quantity}" min="1" max="${item.stock}"
                                                   onchange="updateQuantity(${item.id}, this.value)"
                                                   class="w-16 text-center border border-gray-300 rounded-lg py-1 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <button onclick="increaseQuantity(${item.id})" 
                                                    class="w-8 h-8 rounded-lg border border-gray-300 hover:bg-gray-100 flex items-center justify-center">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                            <span class="text-sm text-gray-500">Maks. ${item.stock}</span>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500 mb-1">Subtotal</p>
                                            <p class="text-lg font-bold text-gray-900">${formatCurrency(item.price * item.quantity)}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');

            updateTotalItems();
            updateSummary();
        }

        // Pilih/Lepas Pilihan Item
        function toggleItem(id) {
            const item = cartData.find(i => i.id === id);
            if (item) {
                item.selected = !item.selected;
                updateSummary();
                updateSelectAll();
            }
        }

        // Pilih Semua Item
        function selectAllItems() {
            const selectAll = document.getElementById('selectAll').checked;
            cartData.forEach(item => item.selected = selectAll);
            renderCartItems();
        }

        // Perbarui Checkbox Pilih Semua
        function updateSelectAll() {
            const allSelected = cartData.length > 0 && cartData.every(item => item.selected);
            document.getElementById('selectAll').checked = allSelected;
        }

        // Perbarui Total Item
        function updateTotalItems() {
            document.getElementById('totalItems').textContent = cartData.length;
        }

        // Tambah Jumlah
        function increaseQuantity(id) {
            const item = cartData.find(i => i.id === id);
            if (item && item.quantity < item.stock) {
                item.quantity++;
                renderCartItems();
            }
        }

        // Kurangi Jumlah
        function decreaseQuantity(id) {
            const item = cartData.find(i => i.id === id);
            if (item && item.quantity > 1) {
                item.quantity--;
                renderCartItems();
            }
        }

        // Perbarui Jumlah
        function updateQuantity(id, value) {
            const item = cartData.find(i => i.id === id);
            const qty = parseInt(value);
            if (item && qty >= 1 && qty <= item.stock) {
                item.quantity = qty;
                renderCartItems();
            } else {
                renderCartItems();
            }
        }

        // Hapus Item
        function removeItem(id) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
                const index = cartData.findIndex(i => i.id === id);
                if (index > -1) {
                    cartData.splice(index, 1);
                    renderCartItems();
                }
            }
        }

        // Hapus Item Terpilih
        function deleteSelected() {
            const selectedItems = cartData.filter(item => item.selected);
            if (selectedItems.length === 0) {
                alert('Pilih produk yang ingin dihapus terlebih dahulu');
                return;
            }

            if (confirm(`Hapus ${selectedItems.length} produk dari keranjang?`)) {
                cartData.forEach((item, index) => {
                    if (item.selected) {
                        cartData.splice(index, 1);
                    }
                });
                // Hapus item yang dipilih
                for (let i = cartData.length - 1; i >= 0; i--) {
                    if (cartData[i].selected) {
                        cartData.splice(i, 1);
                    }
                }
                renderCartItems();
            }
        }

        // Perbarui Ringkasan
        function updateSummary() {
            const selectedItems = cartData.filter(item => item.selected);
            const selectedCount = selectedItems.reduce((sum, item) => sum + item.quantity, 0);
            const subtotal = selectedItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const shipping = selectedCount > 0 ? (subtotal >= 1000000 ? 0 : 15000) : 0;
            const service = selectedCount > 0 ? 1000 : 0;
            const discountAmount = voucher ? voucher.discount : 0;
            const total = subtotal + shipping + service - discountAmount;

            document.getElementById('selectedCount').textContent = selectedCount;
            document.getElementById('subtotal').textContent = formatCurrency(subtotal);
            document.getElementById('shipping').textContent = shipping === 0 ? 'Gratis' : formatCurrency(shipping);
            document.getElementById('total').textContent = formatCurrency(total);

            if (discountAmount > 0) {
                document.getElementById('discountRow').classList.remove('hidden');
                document.getElementById('discount').textContent = formatCurrency(discountAmount);
            } else {
                document.getElementById('discountRow').classList.add('hidden');
            }

            // Aktifkan/Nonaktifkan Tombol Checkout
            const checkoutBtn = document.getElementById('checkoutBtn');
            checkoutBtn.disabled = selectedCount === 0;
        }

        // Tampilkan/Sembunyikan Voucher
        function toggleVoucher() {
            const voucherSection = document.getElementById('voucherSection');
            voucherSection.classList.toggle('hidden');
        }

        // Terapkan Voucher
        function applyVoucher() {
            const code = document.getElementById('voucherCode').value.trim().toUpperCase();

            // Data dummy voucher
            const vouchers = {
                'DISKON10': { name: 'DISKON10', discount: 10000, type: 'fixed' },
                'GRATIS15': { name: 'GRATIS15', discount: 15000, type: 'fixed' },
                'HEMAT20': { name: 'HEMAT20', discount: 20, type: 'percent' }
            };

            if (vouchers[code]) {
                const selectedItems = cartData.filter(item => item.selected);
                const subtotal = selectedItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

                voucher = {
                    ...vouchers[code],
                    discount: vouchers[code].type === 'percent'
                        ? Math.floor(subtotal * vouchers[code].discount / 100)
                        : vouchers[code].discount
                };

                document.getElementById('voucherSection').classList.add('hidden');
                document.getElementById('appliedVoucher').classList.remove('hidden');
                document.getElementById('voucherName').textContent = code;
                document.getElementById('voucherCode').value = '';

                updateSummary();
                alert(`Voucher ${code} berhasil diterapkan!`);
            } else {
                alert('Kode voucher tidak valid');
            }
        }

        // Hapus Voucher
        function removeVoucher() {
            voucher = null;
            document.getElementById('appliedVoucher').classList.add('hidden');
            updateSummary();
        }

        // Proses Checkout
        function checkout() {
            const selectedItems = cartData.filter(item => item.selected);
            if (selectedItems.length === 0) {
                alert('Pilih produk yang ingin dibeli terlebih dahulu');
                return;
            }

            const total = document.getElementById('total').textContent;
            alert(`Proses checkout ${selectedItems.length} produk dengan total pembayaran ${total}\n\nFitur checkout dalam pengembangan`);
        }

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function () {
            renderCartItems();
        });
    </script>
@endsection