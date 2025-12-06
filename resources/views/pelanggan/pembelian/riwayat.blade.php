@extends('layout.pelanggan.app')

@section('title', 'Riwayat Pembelian - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Riwayat Pembelian</h1>
                <p class="text-blue-100">Lihat dan kelola pesanan Anda</p>
            </div>
            <div class="hidden md:block">
                <div class="w-18 h-18 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-history text-blue-800 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-xl shadow-md mb-6">
        <div class="flex overflow-x-auto">
            <button onclick="filterOrders('all')" data-status="all"
                class="status-tab flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 border-blue-600 text-blue-600 hover:bg-blue-50 transition-all">
                Semua
                <span class="ml-2 bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs" id="count-all">0</span>
            </button>
            <button onclick="filterOrders('pending')" data-status="pending"
                class="status-tab flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 border-transparent text-gray-600 hover:bg-gray-50 transition-all">
                Menunggu
                <span class="ml-2 bg-gray-200 text-gray-600 px-2 py-1 rounded-full text-xs" id="count-pending">0</span>
            </button>
            <button onclick="filterOrders('processed')" data-status="processed"
                class="status-tab flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 border-transparent text-gray-600 hover:bg-gray-50 transition-all">
                Diproses
                <span class="ml-2 bg-gray-200 text-gray-600 px-2 py-1 rounded-full text-xs" id="count-processed">0</span>
            </button>
            <button onclick="filterOrders('shipped')" data-status="shipped"
                class="status-tab flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 border-transparent text-gray-600 hover:bg-gray-50 transition-all">
                Dikirim
                <span class="ml-2 bg-gray-200 text-gray-600 px-2 py-1 rounded-full text-xs" id="count-shipped">0</span>
            </button>
            <button onclick="filterOrders('completed')" data-status="completed"
                class="status-tab flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 border-transparent text-gray-600 hover:bg-gray-50 transition-all">
                Selesai
                <span class="ml-2 bg-gray-200 text-gray-600 px-2 py-1 rounded-full text-xs" id="count-completed">0</span>
            </button>
            <button onclick="filterOrders('cancelled')" data-status="cancelled"
                class="status-tab flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 border-transparent text-gray-600 hover:bg-gray-50 transition-all">
                Dibatalkan
                <span class="ml-2 bg-gray-200 text-gray-600 px-2 py-1 rounded-full text-xs" id="count-cancelled">0</span>
            </button>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="grid md:grid-cols-3 gap-4">
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Cari nomor pesanan atau produk..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
            </div>
            <select id="sortSelect" onchange="sortOrders()"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="newest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="highest">Total Tertinggi</option>
                <option value="lowest">Total Terendah</option>
            </select>
            <select id="dateFilter" onchange="filterByDate()"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="all">Semua Waktu</option>
                <option value="today">Hari Ini</option>
                <option value="week">Minggu Ini</option>
                <option value="month">Bulan Ini</option>
                <option value="year">Tahun Ini</option>
            </select>
        </div>
    </div>

    <!-- Daftar Pesanan -->
    <div id="ordersList" class="space-y-4">
        <!-- Pesanan akan dimuat oleh JavaScript -->
    </div>

    <!-- Status Kosong -->
    <div id="emptyOrders" class="hidden bg-white rounded-xl shadow-md p-12 text-center">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-shopping-bag text-gray-400 text-5xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
        <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pembelian</p>
        <a href="#" onclick="alert('Navigasi ke katalog produk'); return false;"
            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
            <i class="fas fa-shopping-bag mr-2"></i>Mulai Belanja
        </a>
    </div>

    <!-- Pagination -->
    <div id="pagination" class="flex justify-center items-center space-x-2 mt-8">
        <!-- Pagination akan dimuat oleh JavaScript -->
    </div>

    <script>
        // Data Dummy Pesanan
        const ordersData = [
            {
                id: 'ORD-2024-001',
                date: '2024-12-05 14:30:00',
                status: 'completed',
                items: [
                    {
                        name: 'SKF 6205-2RS Deep Groove Ball Bearing',
                        image: 'https://picsum.photos/80/80?random=101',
                        quantity: 2,
                        price: 125000
                    },
                    {
                        name: 'NSK 6206-ZZ Deep Groove Ball Bearing',
                        image: 'https://picsum.photos/80/80?random=102',
                        quantity: 1,
                        price: 145000
                    }
                ],
                subtotal: 395000,
                shipping: 15000,
                total: 410000,
                payment: 'Transfer Bank BCA',
                reviewed: true
            },
            {
                id: 'ORD-2024-002',
                date: '2024-12-04 10:15:00',
                status: 'shipped',
                items: [
                    {
                        name: 'NTN 6207-LLU Deep Groove Ball Bearing',
                        image: 'https://picsum.photos/80/80?random=103',
                        quantity: 3,
                        price: 165000
                    }
                ],
                subtotal: 495000,
                shipping: 15000,
                total: 510000,
                payment: 'Transfer Bank Mandiri',
                trackingNumber: 'JNE1234567890',
                courier: 'JNE Reguler'
            },
            {
                id: 'ORD-2024-003',
                date: '2024-12-03 16:45:00',
                status: 'processed',
                items: [
                    {
                        name: 'FAG 6208-2RSR Deep Groove Ball Bearing',
                        image: 'https://picsum.photos/80/80?random=104',
                        quantity: 1,
                        price: 185000
                    },
                    {
                        name: 'TIMKEN 6209-2RS Ball Bearing',
                        image: 'https://picsum.photos/80/80?random=105',
                        quantity: 2,
                        price: 205000
                    }
                ],
                subtotal: 595000,
                shipping: 0,
                total: 595000,
                payment: 'COD (Bayar di Tempat)'
            },
            {
                id: 'ORD-2024-004',
                date: '2024-12-02 09:20:00',
                status: 'pending',
                items: [
                    {
                        name: 'KOYO 6210-ZZ Deep Groove Ball Bearing',
                        image: 'https://picsum.photos/80/80?random=106',
                        quantity: 4,
                        price: 155000
                    }
                ],
                subtotal: 620000,
                shipping: 0,
                total: 620000,
                payment: 'Transfer Bank BNI',
                paymentDeadline: '2024-12-03 09:20:00'
            },
            {
                id: 'ORD-2024-005',
                date: '2024-11-30 13:10:00',
                status: 'cancelled',
                items: [
                    {
                        name: 'SKF 6211-2RS Deep Groove Ball Bearing',
                        image: 'https://picsum.photos/80/80?random=107',
                        quantity: 1,
                        price: 175000
                    }
                ],
                subtotal: 175000,
                shipping: 15000,
                total: 190000,
                payment: 'Transfer Bank BCA',
                cancelReason: 'Dibatalkan oleh pembeli'
            }
        ];

        let currentFilter = 'all';
        let filteredOrders = [...ordersData];

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Format tanggal
        function formatDate(dateString) {
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
            return `<span class="${badge.class} px-3 py-1 rounded-full text-sm font-semibold flex items-center">
                                <i class="fas fa-${badge.icon} mr-2"></i>${badge.text}
                            </span>`;
        }

        // Render Pesanan
        function renderOrders() {
            const container = document.getElementById('ordersList');
            const emptyOrders = document.getElementById('emptyOrders');

            if (filteredOrders.length === 0) {
                container.classList.add('hidden');
                emptyOrders.classList.remove('hidden');
                return;
            }

            container.classList.remove('hidden');
            emptyOrders.classList.add('hidden');

            container.innerHTML = filteredOrders.map(order => `
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all">
                            <!-- Header Pesanan -->
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">No. Pesanan</p>
                                            <p class="font-bold text-gray-900">${order.id}</p>
                                        </div>
                                        <div class="hidden sm:block">
                                            <p class="text-sm text-gray-500">Tanggal Pembelian</p>
                                            <p class="font-medium text-gray-900">${formatDate(order.date)}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        ${getStatusBadge(order.status)}
                                    </div>
                                </div>
                            </div>

                            <!-- Item Pesanan -->
                            <div class="p-6">
                                <div class="space-y-4 mb-6">
                                    ${order.items.map(item => `
                                        <div class="flex items-start space-x-4">
                                            <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                                                <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-semibold text-gray-900 mb-1 line-clamp-2">${item.name}</h4>
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm text-gray-600">${item.quantity} × ${formatCurrency(item.price)}</p>
                                                    <p class="font-bold text-blue-600">${formatCurrency(item.quantity * item.price)}</p>
                                                </div>
                                            </div>
                                        </div>
                                    `).join('')}
                                </div>

                                <!-- Informasi Pengiriman & Pembayaran -->
                                ${order.status === 'shipped' ? `
                                    <div class="bg-blue-50 rounded-lg p-4 mb-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm text-gray-600 mb-1">Nomor Resi</p>
                                                <p class="font-bold text-gray-900">${order.trackingNumber}</p>
                                                <p class="text-xs text-gray-500 mt-1">${order.courier}</p>
                                            </div>
                                            <button onclick="trackOrder('${order.trackingNumber}')"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all text-sm">
                                                <i class="fas fa-map-marker-alt mr-2"></i>Lacak Paket
                                            </button>
                                        </div>
                                    </div>
                                ` : ''}

                                ${order.status === 'pending' ? `
                                    <div class="bg-yellow-50 rounded-lg p-4 mb-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm text-gray-600 mb-1">Batas Waktu Pembayaran</p>
                                                <p class="font-bold text-red-600">${formatDate(order.paymentDeadline)}</p>
                                            </div>
                                            <button onclick="payNow('${order.id}')"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all text-sm">
                                                <i class="fas fa-credit-card mr-2"></i>Bayar Sekarang
                                            </button>
                                        </div>
                                    </div>
                                ` : ''}

                                ${order.status === 'cancelled' ? `
                                    <div class="bg-red-50 rounded-lg p-4 mb-4">
                                        <p class="text-sm text-gray-600 mb-1">Alasan Pembatalan</p>
                                        <p class="font-medium text-red-700">${order.cancelReason}</p>
                                    </div>
                                ` : ''}

                                <!-- Total & Aksi -->
                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <p class="text-sm text-gray-600 mb-1">Total Belanja</p>
                                            <p class="text-2xl font-bold text-gray-900">${formatCurrency(order.total)}</p>
                                            <p class="text-xs text-gray-500 mt-1">Pembayaran: ${order.payment}</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap gap-3">
                                        <button onclick="viewOrderDetail('${order.id}')"
                                            class="flex-1 min-w-[120px] px-4 py-2.5 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-all">
                                            <i class="fas fa-info-circle mr-2"></i>Lihat Detail
                                        </button>

                                        ${order.status === 'completed' && !order.reviewed ? `
                                            <button onclick="reviewOrder('${order.id}')"
                                                class="flex-1 min-w-[120px] px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                                                <i class="fas fa-star mr-2"></i>Beri Ulasan
                                            </button>
                                        ` : ''}

                                        ${order.status === 'completed' ? `
                                            <button onclick="buyAgain('${order.id}')"
                                                class="flex-1 min-w-[120px] px-4 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-all">
                                                <i class="fas fa-redo mr-2"></i>Beli Lagi
                                            </button>
                                        ` : ''}

                                        ${order.status === 'shipped' ? `
                                            <button onclick="confirmReceived('${order.id}')"
                                                class="flex-1 min-w-[120px] px-4 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-all">
                                                <i class="fas fa-check mr-2"></i>Pesanan Diterima
                                            </button>
                                        ` : ''}

                                        ${order.status === 'pending' ? `
                                            <button onclick="cancelOrder('${order.id}')"
                                                class="flex-1 min-w-[120px] px-4 py-2.5 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all">
                                                <i class="fas fa-times mr-2"></i>Batalkan
                                            </button>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');

            updateStatusCounts();
        }

        // Perbarui Jumlah Status
        function updateStatusCounts() {
            const counts = {
                all: ordersData.length,
                pending: ordersData.filter(o => o.status === 'pending').length,
                processed: ordersData.filter(o => o.status === 'processed').length,
                shipped: ordersData.filter(o => o.status === 'shipped').length,
                completed: ordersData.filter(o => o.status === 'completed').length,
                cancelled: ordersData.filter(o => o.status === 'cancelled').length
            };

            Object.keys(counts).forEach(status => {
                document.getElementById(`count-${status}`).textContent = counts[status];
            });
        }

        // Filter Pesanan
        function filterOrders(status) {
            currentFilter = status;

            if (status === 'all') {
                filteredOrders = [...ordersData];
            } else {
                filteredOrders = ordersData.filter(order => order.status === status);
            }

            // Perbarui Gaya Tab
            document.querySelectorAll('.status-tab').forEach(tab => {
                if (tab.dataset.status === status) {
                    tab.classList.remove('border-transparent', 'text-gray-600');
                    tab.classList.add('border-blue-600', 'text-blue-600');
                } else {
                    tab.classList.remove('border-blue-600', 'text-blue-600');
                    tab.classList.add('border-transparent', 'text-gray-600');
                }
            });

            renderOrders();
        }

        // Urutkan Pesanan
        function sortOrders() {
            const sortValue = document.getElementById('sortSelect').value;

            switch (sortValue) {
                case 'newest':
                    filteredOrders.sort((a, b) => new Date(b.date) - new Date(a.date));
                    break;
                case 'oldest':
                    filteredOrders.sort((a, b) => new Date(a.date) - new Date(b.date));
                    break;
                case 'highest':
                    filteredOrders.sort((a, b) => b.total - a.total);
                    break;
                case 'lowest':
                    filteredOrders.sort((a, b) => a.total - b.total);
                    break;
            }

            renderOrders();
        }

        // Filter Berdasarkan Tanggal
        function filterByDate() {
            // TODO: Implementasi filter tanggal
            alert('Filter tanggal dalam pengembangan');
        }

        // Lihat Detail Pesanan
        function viewOrderDetail(orderId) {
            alert(`Lihat detail pesanan ${orderId}\n\nFitur dalam pengembangan`);
        }

        // Lacak Pesanan
        function trackOrder(trackingNumber) {
            alert(`Melacak paket dengan nomor resi: ${trackingNumber}\n\nFitur dalam pengembangan`);
        }

        // Bayar Sekarang
        function payNow(orderId) {
            alert(`Lanjut ke pembayaran untuk pesanan ${orderId}\n\nFitur dalam pengembangan`);
        }

        // Konfirmasi Penerimaan
        function confirmReceived(orderId) {
            if (confirm('Konfirmasi bahwa pesanan telah diterima dengan baik?')) {
                alert(`Pesanan ${orderId} dikonfirmasi diterima\n\nFitur dalam pengembangan`);
            }
        }

        // Beri Ulasan Pesanan
        function reviewOrder(orderId) {
            alert(`Beri ulasan untuk pesanan ${orderId}\n\nFitur dalam pengembangan`);
        }

        // Beli Lagi
        function buyAgain(orderId) {
            if (confirm('Tambahkan produk dari pesanan ini ke keranjang?')) {
                alert(`Produk dari pesanan ${orderId} ditambahkan ke keranjang\n\nFitur dalam pengembangan`);
            }
        }

        // Batalkan Pesanan
        function cancelOrder(orderId) {
            if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
                alert(`Pesanan ${orderId} dibatalkan\n\nFitur dalam pengembangan`);
            }
        }

        // Cari Pesanan
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const search = e.target.value.toLowerCase();
            filteredOrders = ordersData.filter(order => {
                const matchId = order.id.toLowerCase().includes(search);
                const matchItems = order.items.some(item => item.name.toLowerCase().includes(search));
                return matchId || matchItems;
            });

            if (currentFilter !== 'all') {
                filteredOrders = filteredOrders.filter(order => order.status === currentFilter);
            }

            renderOrders();
        });

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function () {
            renderOrders();
        });
    </script>
@endsection