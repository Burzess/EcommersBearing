@extends('layout.admin.app')

@section('title', 'Detail Pesanan - Admin')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex items-center text-blue-100 hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Detail Pesanan #ORD-2024-001</h1>
                <p class="text-blue-100">Informasi lengkap pesanan pelanggan</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-file-invoice text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Konten Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Timeline -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-history mr-2 text-blue-600"></i>Status Pesanan
                </h2>

                <div id="timelineContainer" class="space-y-6">
                    <!-- Timeline akan diisi oleh JavaScript -->
                </div>
            </div>

            <!-- Update Status -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-edit mr-2 text-blue-600"></i>Update Status Pesanan
                </h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                        <select id="newStatus"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Pilih Status --</option>
                            <option value="paid">Pembayaran Dikonfirmasi</option>
                            <option value="processing">Sedang Diproses</option>
                            <option value="shipped">Sudah Dikirim</option>
                            <option value="delivered">Pesanan Selesai</option>
                            <option value="cancelled">Batalkan Pesanan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea id="statusNote" rows="3" placeholder="Tambahkan catatan untuk perubahan status..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <div id="trackingNumberDiv" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Resi</label>
                        <input type="text" id="trackingNumber" placeholder="Masukkan nomor resi pengiriman"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <button onclick="updateOrderStatus()"
                        class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                        <i class="fas fa-check mr-2"></i>Update Status
                    </button>
                </div>
            </div>

            <!-- Daftar Produk -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-shopping-bag mr-2 text-blue-600"></i>Daftar Produk
                </h2>

                <div id="productList" class="space-y-4">
                    <!-- Produk akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Ringkasan Pesanan -->
            <div class="bg-white rounded-xl shadow-md p-6 top-6">
                <h3 class="font-bold text-gray-900 mb-4">Ringkasan Pesanan</h3>

                <div class="space-y-3 text-sm mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="font-medium" id="subtotal">Rp 800.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Ongkir:</span>
                        <span class="font-medium" id="shipping">Rp 50.000</span>
                    </div>
                    <div class="flex justify-between text-green-600">
                        <span>Diskon:</span>
                        <span class="font-medium" id="discount">- Rp 0</span>
                    </div>
                    <div class="pt-3 border-t border-gray-200">
                        <div class="flex justify-between">
                            <span class="font-bold text-gray-900">Total:</span>
                            <span class="font-bold text-blue-600 text-lg" id="total">Rp 850.000</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200 space-y-2">
                    <button onclick="printInvoice()"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-900 transition-all">
                        <i class="fas fa-print mr-2"></i>Cetak Invoice
                    </button>
                    <button onclick="sendInvoiceEmail()"
                        class="w-full px-4 py-2 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-all">
                        <i class="fas fa-envelope mr-2"></i>Kirim ke Email
                    </button>
                </div>
            </div>

            <!-- Informasi Pelanggan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="font-bold text-gray-900 mb-4">Informasi Pelanggan</h3>

                <div class="flex items-center mb-4">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&size=64&background=3b82f6&color=fff" alt="Avatar"
                        class="w-12 h-12 rounded-full mr-3">
                    <div>
                        <div class="font-semibold text-gray-900">John Doe</div>
                        <div class="text-xs text-gray-500">#CUST-2024-001</div>
                    </div>
                </div>

                <div class="space-y-3 text-sm">
                    <div>
                        <div class="text-gray-500 mb-1">Email:</div>
                        <div class="font-medium text-gray-900">john.doe@example.com</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Telepon:</div>
                        <div class="font-medium text-gray-900">0812-3456-7890</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Total Pesanan:</div>
                        <div class="font-medium text-gray-900">24 pesanan</div>
                    </div>
                </div>

                <button onclick="viewCustomer()"
                    class="w-full mt-4 px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                    <i class="fas fa-user mr-2"></i>Lihat Profil
                </button>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="font-bold text-gray-900 mb-4">Informasi Pengiriman</h3>

                <div class="space-y-3 text-sm">
                    <div>
                        <div class="text-gray-500 mb-1">Alamat:</div>
                        <div class="font-medium text-gray-900">
                            Jl. Sudirman No. 123, RT 05/RW 03<br>
                            Senayan, Jakarta Selatan<br>
                            DKI Jakarta, 12190
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Kurir:</div>
                        <div class="font-medium text-gray-900">JNE Regular</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Estimasi:</div>
                        <div class="font-medium text-gray-900">2-3 hari kerja</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">No. Resi:</div>
                        <div class="font-medium text-blue-600">JNE1234567890</div>
                    </div>
                </div>

                <button onclick="trackShipment()"
                    class="w-full mt-4 px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-all">
                    <i class="fas fa-map-marker-alt mr-2"></i>Lacak Pengiriman
                </button>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="font-bold text-gray-900 mb-4">Informasi Pembayaran</h3>

                <div class="space-y-3 text-sm">
                    <div>
                        <div class="text-gray-500 mb-1">Metode:</div>
                        <div class="font-medium text-gray-900">Transfer Bank</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Bank:</div>
                        <div class="font-medium text-gray-900">BCA - 1234567890</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Atas Nama:</div>
                        <div class="font-medium text-gray-900">Toko Bearing Jakarta</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Status:</div>
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i>Menunggu Pembayaran
                        </span>
                    </div>
                </div>

                <button onclick="confirmPayment()"
                    class="w-full mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                    <i class="fas fa-check mr-2"></i>Konfirmasi Pembayaran
                </button>
            </div>
        </div>
    </div>

    <script>
        // Data dummy pesanan
        const orderData = {
            id: 'ORD-2024-001',
            date: '2024-01-20 10:30',
            status: 'pending',
            customer: {
                name: 'John Doe',
                email: 'john.doe@example.com',
                phone: '0812-3456-7890',
                id: 'CUST-2024-001'
            },
            products: [
                {
                    name: 'SKF 6204 Bearing',
                    sku: 'SKF-6204',
                    quantity: 2,
                    price: 350000,
                    image: 'https://via.placeholder.com/80'
                },
                {
                    name: 'NSK Ball Bearing 6205',
                    sku: 'NSK-6205',
                    quantity: 1,
                    price: 450000,
                    image: 'https://via.placeholder.com/80'
                }
            ],
            shipping: {
                address: 'Jl. Sudirman No. 123, RT 05/RW 03\nSenayan, Jakarta Selatan\nDKI Jakarta, 12190',
                courier: 'JNE Regular',
                cost: 50000,
                estimation: '2-3 hari kerja',
                trackingNumber: 'JNE1234567890'
            },
            payment: {
                method: 'Transfer Bank',
                bank: 'BCA',
                accountNumber: '1234567890',
                accountName: 'Toko Bearing Jakarta',
                status: 'pending'
            },
            timeline: [
                { status: 'pending', label: 'Menunggu Pembayaran', time: '20 Jan 2024, 10:30', completed: true },
                { status: 'paid', label: 'Pembayaran Dikonfirmasi', time: '', completed: false },
                { status: 'processing', label: 'Pesanan Diproses', time: '', completed: false },
                { status: 'shipped', label: 'Pesanan Dikirim', time: '', completed: false },
                { status: 'delivered', label: 'Pesanan Selesai', time: '', completed: false }
            ]
        };

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        // Render timeline
        function renderTimeline() {
            const container = document.getElementById('timelineContainer');

            container.innerHTML = orderData.timeline.map((item, index) => `
                            <div class="flex">
                                <div class="flex flex-col items-center mr-4">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center ${item.completed
                    ? 'bg-green-100 text-green-600'
                    : 'bg-gray-100 text-gray-400'
                }">
                                        <i class="fas ${item.completed ? 'fa-check' : 'fa-circle'} text-sm"></i>
                                    </div>
                                    ${index < orderData.timeline.length - 1 ? `
                                        <div class="w-0.5 h-16 ${item.completed ? 'bg-green-200' : 'bg-gray-200'}"></div>
                                    ` : ''}
                                </div>
                                <div class="pb-8">
                                    <div class="font-semibold text-gray-900">${item.label}</div>
                                    ${item.time ? `<div class="text-sm text-gray-500 mt-1">${item.time}</div>` : ''}
                                </div>
                            </div>
                        `).join('');
        }

        // Render produk
        function renderProducts() {
            const container = document.getElementById('productList');

            container.innerHTML = orderData.products.map(product => `
                            <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                <img src="${product.image}" alt="${product.name}" class="w-20 h-20 object-cover rounded-lg mr-4">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">${product.name}</h4>
                                    <p class="text-sm text-gray-500">SKU: ${product.sku}</p>
                                    <p class="text-sm text-gray-600 mt-1">Jumlah: ${product.quantity}x</p>
                                </div>
                                <div class="text-right">
                                    <div class="font-semibold text-gray-900">${formatCurrency(product.price)}</div>
                                    <div class="text-sm text-gray-500">per item</div>
                                    <div class="font-bold text-blue-600 mt-1">${formatCurrency(product.price * product.quantity)}</div>
                                </div>
                            </div>
                        `).join('');
        }

        // Tampilkan/Sembunyikan field nomor resi
        document.getElementById('newStatus').addEventListener('change', function () {
            const trackingDiv = document.getElementById('trackingNumberDiv');
            if (this.value === 'shipped') {
                trackingDiv.classList.remove('hidden');
            } else {
                trackingDiv.classList.add('hidden');
            }
        });

        // Update status pesanan
        function updateOrderStatus() {
            const newStatus = document.getElementById('newStatus').value;
            const note = document.getElementById('statusNote').value;
            const tracking = document.getElementById('trackingNumber').value;

            if (!newStatus) {
                alert('Pilih status baru terlebih dahulu');
                return;
            }

            if (newStatus === 'shipped' && !tracking) {
                alert('Masukkan nomor resi pengiriman');
                return;
            }

            if (confirm('Update status pesanan?')) {
                alert(`Status berhasil diupdate!\n\nStatus: ${newStatus}\nCatatan: ${note || '-'}\n\nFitur dalam pengembangan`);
            }
        }

        // Cetak invoice
        function printInvoice() {
            alert('Cetak invoice\n\nFitur dalam pengembangan');
        }

        // Kirim invoice via email
        function sendInvoiceEmail() {
            alert('Kirim invoice ke email pelanggan\n\nFitur dalam pengembangan');
        }

        // Lihat pelanggan
        function viewCustomer() {
            alert('Lihat profil pelanggan\n\nFitur dalam pengembangan');
        }

        // Lacak pengiriman
        function trackShipment() {
            alert('Lacak pengiriman: ' + orderData.shipping.trackingNumber + '\n\nFitur dalam pengembangan');
        }

        // Konfirmasi pembayaran
        function confirmPayment() {
            if (confirm('Konfirmasi pembayaran untuk pesanan ini?')) {
                alert('Pembayaran berhasil dikonfirmasi\n\nFitur dalam pengembangan');
            }
        }

        // Simpan catatan admin
        function saveAdminNote() {
            alert('Catatan berhasil disimpan\n\nFitur dalam pengembangan');
        }

        // Inisialisasi
        renderTimeline();
        renderProducts();
    </script>
@endsection