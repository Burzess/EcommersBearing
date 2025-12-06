@extends('layout.pelanggan.app')

@section('title', 'Detail Pesanan - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex mb-6 items-center text-white hover:text-white transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Detail Pesanan</h1>
                <p class="text-blue-100" id="orderNumber">No. Pesanan: ORD-2024-001</p>
            </div>
            <div class="md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-receipt text-blue-800 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Detail Pesanan -->
        <div class="lg:col-span-2">
            <!-- Status Pesanan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Status Pesanan</h2>
                <div id="orderStatus" class="mb-6">
                    <!-- Status akan dimuat oleh JavaScript -->
                </div>

                <!-- Timeline Status -->
                <div id="orderTimeline" class="relative pl-8">
                    <!-- Timeline akan dimuat oleh JavaScript -->
                </div>
            </div>

            <!-- Produk yang Dipesan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-box mr-2 text-blue-600"></i>Produk yang Dipesan
                </h2>
                <div id="orderItems" class="space-y-4">
                    <!-- Items akan dimuat oleh JavaScript -->
                </div>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-truck mr-2 text-blue-600"></i>Informasi Pengiriman
                </h2>
                <div id="shippingInfo">
                    <!-- Shipping info akan dimuat oleh JavaScript -->
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-credit-card mr-2 text-blue-600"></i>Informasi Pembayaran
                </h2>
                <div id="paymentInfo">
                    <!-- Payment info akan dimuat oleh JavaScript -->
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Ringkasan & Aksi -->
        <div class="lg:col-span-1">
            <div class="sticky top-2 space-y-6">
                <!-- Ringkasan Pembayaran -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h2>
                    <div class="space-y-3 mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal Produk</span>
                            <span id="summarySubtotal" class="font-medium">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span id="summaryShipping" class="font-medium">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Layanan</span>
                            <span id="summaryService" class="font-medium">Rp 0</span>
                        </div>
                        <div id="summaryDiscountRow" class="flex justify-between text-green-600">
                            <span>Diskon</span>
                            <span id="summaryDiscount" class="font-medium">-Rp 0</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                        <span id="summaryTotal" class="text-2xl font-bold text-blue-600">Rp 0</span>
                    </div>
                    <p class="text-xs text-gray-500 text-center">Termasuk PPN jika berlaku</p>
                </div>

                <!-- Tombol Aksi -->
                <div id="actionButtons" class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Aksi</h2>
                    <div class="space-y-3">
                        <!-- Buttons akan dimuat oleh JavaScript berdasarkan status -->
                    </div>
                </div>

                <!-- Bantuan -->
                <div class="bg-blue-50 rounded-xl shadow-md p-6">
                    <h3 class="font-bold text-gray-900 mb-3">
                        <i class="fas fa-question-circle mr-2 text-blue-600"></i>Butuh Bantuan?
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Tim customer service kami siap membantu Anda</p>
                    <button onclick="contactSupport()"
                        class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                        <i class="fas fa-headset mr-2"></i>Hubungi CS
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data Dummy Pesanan
        const orderData = {
            id: 'ORD-2024-001',
            date: '2024-12-05 14:30:00',
            status: 'shipped',
            items: [
                {
                    name: 'SKF 6205-2RS Deep Groove Ball Bearing',
                    brand: 'SKF',
                    image: 'https://picsum.photos/100/100?random=201',
                    quantity: 2,
                    price: 125000,
                    sku: 'SKF-6205-2RS'
                },
                {
                    name: 'NSK 6206-ZZ Deep Groove Ball Bearing',
                    brand: 'NSK',
                    image: 'https://picsum.photos/100/100?random=202',
                    quantity: 1,
                    price: 145000,
                    sku: 'NSK-6206-ZZ'
                }
            ],
            subtotal: 395000,
            shipping: 15000,
            serviceFee: 1000,
            discount: 0,
            total: 411000,
            shipping_info: {
                recipient: 'John Doe',
                phone: '0812-3456-7890',
                address: 'Jl. Sudirman No. 123, RT 05/RW 03, Kelurahan Senayan, Kecamatan Kebayoran Baru, Jakarta Selatan, DKI Jakarta 12190',
                courier: 'JNE Reguler (2-3 hari)',
                trackingNumber: 'JNE1234567890',
                estimatedArrival: '2024-12-08'
            },
            payment_info: {
                method: 'Transfer Bank',
                bankName: 'Bank BCA',
                accountNumber: '1234567890',
                accountName: 'Bearing Shop',
                amount: 411000,
                status: 'Sudah Dibayar',
                paidAt: '2024-12-05 15:00:00',
                proofUrl: 'https://example.com/proof.jpg'
            },
            timeline: [
                { date: '2024-12-05 14:30:00', title: 'Pesanan Dibuat', description: 'Pesanan berhasil dibuat', icon: 'shopping-cart', completed: true },
                { date: '2024-12-05 15:00:00', title: 'Pembayaran Dikonfirmasi', description: 'Pembayaran telah diverifikasi', icon: 'check-circle', completed: true },
                { date: '2024-12-06 09:00:00', title: 'Pesanan Diproses', description: 'Pesanan sedang dikemas', icon: 'box', completed: true },
                { date: '2024-12-06 16:00:00', title: 'Pesanan Dikirim', description: 'Paket telah diserahkan ke kurir', icon: 'truck', completed: true, current: true },
                { date: null, title: 'Pesanan Diterima', description: 'Menunggu konfirmasi penerimaan', icon: 'home', completed: false }
            ]
        };

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Format tanggal
        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            const options = { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
            return date.toLocaleDateString('id-ID', options);
        }

        // Badge Status
        function getStatusBadge(status) {
            const badges = {
                pending: { class: 'bg-yellow-100 text-yellow-700', icon: 'clock', text: 'Menunggu Pembayaran' },
                processed: { class: 'bg-blue-100 text-blue-700', icon: 'box', text: 'Diproses' },
                shipped: { class: 'bg-blue-200 text-blue-700', icon: 'truck', text: 'Dikirim' },
                completed: { class: 'bg-green-100 text-green-700', icon: 'check-circle', text: 'Selesai' },
                cancelled: { class: 'bg-red-100 text-red-700', icon: 'times-circle', text: 'Dibatalkan' }
            };
            const badge = badges[status];
            return `<div class="${badge.class} px-4 py-3 rounded-lg flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-${badge.icon} text-2xl mr-3"></i>
                                    <span class="font-bold text-lg">${badge.text}</span>
                                </div>
                            </div>`;
        }

        // Render Status Pesanan
        function renderOrderStatus() {
            document.getElementById('orderStatus').innerHTML = getStatusBadge(orderData.status);
        }

        // Render Timeline
        function renderTimeline() {
            const container = document.getElementById('orderTimeline');
            container.innerHTML = orderData.timeline.map((item, index) => `
                        <div class="relative pb-8 ${index === orderData.timeline.length - 1 ? 'pb-0' : ''}">
                            ${index !== orderData.timeline.length - 1 ? `
                                <span class="absolute top-8 left-[-20px] -ml-px h-full w-0.5 ${item.completed ? 'bg-blue-600' : 'bg-gray-300'}"></span>
                            ` : ''}
                            <div class="relative flex items-start group">
                                <span class="h-10 w-10 rounded-full flex items-center justify-center absolute -left-10 ${item.completed ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-400'
                } ${item.current ? 'ring-4 ring-blue-200' : ''}">
                                    <i class="fas fa-${item.icon}"></i>
                                </span>
                                <div class="min-w-0 flex-1">
                                    <div>
                                        <p class="font-bold text-gray-900 ${item.current ? 'text-blue-600' : ''}">${item.title}</p>
                                        <p class="text-sm text-gray-600 mt-1">${item.description}</p>
                                        ${item.date ? `<p class="text-xs text-gray-500 mt-1">${formatDate(item.date)}</p>` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');
        }

        // Render Item Pesanan
        function renderOrderItems() {
            const container = document.getElementById('orderItems');
            container.innerHTML = orderData.items.map(item => `
                        <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                            <div class="w-24 h-24 bg-white rounded-lg overflow-hidden shrink-0 shadow-sm">
                                <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-500 mb-1">${item.brand}</p>
                                <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">${item.name}</h4>
                                <p class="text-xs text-gray-500 mb-2">SKU: ${item.sku}</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600">${item.quantity} × ${formatCurrency(item.price)}</p>
                                    <p class="font-bold text-blue-600 text-lg">${formatCurrency(item.quantity * item.price)}</p>
                                </div>
                            </div>
                        </div>
                    `).join('');
        }

        // Render Info Pengiriman
        function renderShippingInfo() {
            const container = document.getElementById('shippingInfo');
            const info = orderData.shipping_info;

            container.innerHTML = `
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="font-semibold text-gray-900 mb-3">Penerima</h3>
                                <div class="space-y-2 text-sm">
                                    <div class="flex">
                                        <span class="text-gray-600 w-24">Nama</span>
                                        <span class="text-gray-900 font-medium">: ${info.recipient}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-gray-600 w-24">Telepon</span>
                                        <span class="text-gray-900 font-medium">: ${info.phone}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-gray-600 w-24">Alamat</span>
                                        <span class="text-gray-900 font-medium flex-1">: ${info.address}</span>
                                    </div>
                                </div>
                            </div>

                            ${orderData.status !== 'pending' ? `
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h3 class="font-semibold text-gray-900 mb-3">Kurir & Pengiriman</h3>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex">
                                            <span class="text-gray-600 w-32">Kurir</span>
                                            <span class="text-gray-900 font-medium">: ${info.courier}</span>
                                        </div>
                                        ${info.trackingNumber ? `
                                            <div class="flex">
                                                <span class="text-gray-600 w-32">No. Resi</span>
                                                <span class="text-gray-900 font-medium">: ${info.trackingNumber}</span>
                                            </div>
                                        ` : ''}
                                        <div class="flex">
                                            <span class="text-gray-600 w-32">Estimasi Tiba</span>
                                            <span class="text-gray-900 font-medium">: ${formatDate(info.estimatedArrival)}</span>
                                        </div>
                                    </div>
                                    ${orderData.status === 'shipped' || orderData.status === 'completed' ? `
                                        <button onclick="trackOrder()" class="w-full mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                                            <i class="fas fa-map-marker-alt mr-2"></i>Lacak Paket
                                        </button>
                                    ` : ''}
                                </div>
                            ` : ''}
                        </div>
                    `;
        }

        // Render Info Pembayaran
        function renderPaymentInfo() {
            const container = document.getElementById('paymentInfo');
            const info = orderData.payment_info;

            container.innerHTML = `
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="font-semibold text-gray-900 mb-3">Metode Pembayaran</h3>
                                <div class="space-y-2 text-sm">
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">Metode</span>
                                        <span class="text-gray-900 font-medium">: ${info.method}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">Bank</span>
                                        <span class="text-gray-900 font-medium">: ${info.bankName}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">No. Rekening</span>
                                        <span class="text-gray-900 font-medium">: ${info.accountNumber}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">Atas Nama</span>
                                        <span class="text-gray-900 font-medium">: ${info.accountName}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-semibold text-gray-900">Status Pembayaran</h3>
                                    <span class="px-3 py-1 bg-green-600 text-white rounded-full text-sm font-semibold">
                                        <i class="fas fa-check-circle mr-1"></i>${info.status}
                                    </span>
                                </div>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Jumlah Dibayar</span>
                                        <span class="text-gray-900 font-bold">${formatCurrency(info.amount)}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Dibayar Pada</span>
                                        <span class="text-gray-900 font-medium">${formatDate(info.paidAt)}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
        }

        // Render Ringkasan
        function renderSummary() {
            document.getElementById('summarySubtotal').textContent = formatCurrency(orderData.subtotal);
            document.getElementById('summaryShipping').textContent = orderData.shipping > 0 ? formatCurrency(orderData.shipping) : 'GRATIS';
            document.getElementById('summaryService').textContent = formatCurrency(orderData.serviceFee);

            if (orderData.discount > 0) {
                document.getElementById('summaryDiscountRow').classList.remove('hidden');
                document.getElementById('summaryDiscount').textContent = '-' + formatCurrency(orderData.discount);
            }

            document.getElementById('summaryTotal').textContent = formatCurrency(orderData.total);
        }

        // Render Tombol Aksi
        function renderActionButtons() {
            const container = document.getElementById('actionButtons');
            let buttonsHTML = '<div class="space-y-3">';

            switch (orderData.status) {
                case 'pending':
                    buttonsHTML += `
                                <button onclick="payNow()" class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                                    <i class="fas fa-credit-card mr-2"></i>Bayar Sekarang
                                </button>
                                <button onclick="cancelOrder()" class="w-full px-4 py-2.5 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all">
                                    <i class="fas fa-times mr-2"></i>Batalkan Pesanan
                                </button>
                            `;
                    break;
                case 'shipped':
                    buttonsHTML += `
                                <button onclick="confirmReceived()" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-all">
                                    <i class="fas fa-check mr-2"></i>Pesanan Diterima
                                </button>
                                <button onclick="trackOrder()" class="w-full px-4 py-2.5 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-all">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Lacak Paket
                                </button>
                            `;
                    break;
                case 'completed':
                    buttonsHTML += `
                                <button onclick="reviewOrder()" class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                                    <i class="fas fa-star mr-2"></i>Beri Ulasan
                                </button>
                                <button onclick="buyAgain()" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-all">
                                    <i class="fas fa-redo mr-2"></i>Beli Lagi
                                </button>
                            `;
                    break;
            }

            buttonsHTML += `
                        <button onclick="printInvoice()" class="w-full px-4 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                            <i class="fas fa-print mr-2"></i>Cetak Invoice
                        </button>
                    </div>`;

            container.innerHTML = '<h2 class="text-xl font-bold text-gray-900 mb-4">Aksi</h2>' + buttonsHTML;
        }

        // Fungsi Aksi
        function payNow() {
            alert('Lanjut ke halaman pembayaran\n\nFitur dalam pengembangan');
        }

        function cancelOrder() {
            if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
                alert('Pesanan berhasil dibatalkan\n\nFitur dalam pengembangan');
            }
        }

        function confirmReceived() {
            if (confirm('Konfirmasi bahwa pesanan telah diterima dengan baik?')) {
                alert('Pesanan dikonfirmasi diterima\n\nFitur dalam pengembangan');
            }
        }

        function trackOrder() {
            alert(`Melacak paket dengan nomor resi: ${orderData.shipping_info.trackingNumber}\n\nFitur dalam pengembangan`);
        }

        function reviewOrder() {
            alert('Buka halaman ulasan produk\n\nFitur dalam pengembangan');
        }

        function buyAgain() {
            if (confirm('Tambahkan produk dari pesanan ini ke keranjang?')) {
                alert('Produk berhasil ditambahkan ke keranjang\n\nFitur dalam pengembangan');
            }
        }

        function printInvoice() {
            alert('Cetak atau unduh invoice\n\nFitur dalam pengembangan');
        }

        function contactSupport() {
            alert('Hubungi customer service\n\nWhatsApp: 0812-3456-7890\nEmail: support@bearingshop.com\n\nFitur dalam pengembangan');
        }

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('orderNumber').textContent = 'No. Pesanan: ' + orderData.id;
            renderOrderStatus();
            renderTimeline();
            renderOrderItems();
            renderShippingInfo();
            renderPaymentInfo();
            renderSummary();
            renderActionButtons();
        });
    </script>
@endsection