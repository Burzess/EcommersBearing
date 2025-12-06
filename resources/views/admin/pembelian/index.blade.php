@extends('layout.admin.app')

@section('title', 'Manajemen Pembelian - Admin')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Manajemen Pembelian</h1>
                <p class="text-blue-100">Kelola semua pesanan pelanggan</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-blue-800 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Pesanan</p>
                    <p class="text-2xl font-bold text-gray-900">1,542</p>
                    <p class="text-xs text-gray-500 mt-1">Semua waktu</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Menunggu Pembayaran</p>
                    <p class="text-2xl font-bold text-gray-900">32</p>
                    <p class="text-xs text-yellow-600 mt-1"><i class="fas fa-arrow-up mr-1"></i>+5 hari ini</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Diproses</p>
                    <p class="text-2xl font-bold text-gray-900">18</p>
                    <p class="text-xs text-blue-600 mt-1"><i class="fas fa-sync mr-1"></i>Aktif</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-cogs text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Selesai Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900">24</p>
                    <p class="text-xs text-green-600 mt-1"><i class="fas fa-check mr-1"></i>+12 sejak kemarin</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="lg:col-span-2">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari nomor pesanan, pelanggan..."
                        class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                </div>
            </div>
            <div>
                <select id="statusFilter" onchange="filterOrders()"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="pending">Menunggu Pembayaran</option>
                    <option value="paid">Dibayar</option>
                    <option value="processing">Diproses</option>
                    <option value="shipped">Dikirim</option>
                    <option value="delivered">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
            </div>
            <div>
                <select id="sortFilter" onchange="sortOrders()"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="highest">Nilai Tertinggi</option>
                    <option value="lowest">Nilai Terendah</option>
                </select>
            </div>
            <div>
                <button onclick="exportData()"
                    class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-all">
                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                </button>
            </div>
        </div>
    </div>

    <!-- Tabel Pesanan -->
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
                            Pesanan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Pelanggan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Produk
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Total
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="orderTableBody" class="divide-y divide-gray-200">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">Menampilkan <span class="font-medium">1-10</span> dari <span
                        class="font-medium">1,542</span> pesanan</p>
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
        // Data dummy pesanan
        let orders = [
            {
                id: 'ORD-2024-001',
                customer: { name: 'John Doe', email: 'john@example.com', avatar: 'https://ui-avatars.com/api/?name=John+Doe&size=64&background=3b82f6&color=fff' },
                products: ['SKF 6204 Bearing', 'NSK Ball Bearing'],
                productCount: 2,
                total: 850000,
                status: 'pending',
                date: '2024-01-20 10:30',
                paymentMethod: 'Transfer Bank'
            },
            {
                id: 'ORD-2024-002',
                customer: { name: 'Jane Smith', email: 'jane@example.com', avatar: 'https://ui-avatars.com/api/?name=Jane+Smith&size=64&background=10b981&color=fff' },
                products: ['NTN Bearing Set'],
                productCount: 1,
                total: 1250000,
                status: 'processing',
                date: '2024-01-20 09:15',
                paymentMethod: 'Transfer Bank'
            },
            {
                id: 'ORD-2024-003',
                customer: { name: 'Robert Johnson', email: 'robert@example.com', avatar: 'https://ui-avatars.com/api/?name=Robert+Johnson&size=64&background=f59e0b&color=fff' },
                products: ['FAG Deep Groove', 'SKF Roller Bearing', 'Timken Bearing'],
                productCount: 3,
                total: 2400000,
                status: 'processing',
                date: '2024-01-19 16:45',
                paymentMethod: 'COD'
            },
            {
                id: 'ORD-2024-004',
                customer: { name: 'Maria Garcia', email: 'maria@example.com', avatar: 'https://ui-avatars.com/api/?name=Maria+Garcia&size=64&background=8b5cf6&color=fff' },
                products: ['NSK 6205 Bearing'],
                productCount: 1,
                total: 450000,
                status: 'shipped',
                date: '2024-01-19 14:20',
                paymentMethod: 'Transfer Bank'
            },
            {
                id: 'ORD-2024-005',
                customer: { name: 'David Lee', email: 'david@example.com', avatar: 'https://ui-avatars.com/api/?name=David+Lee&size=64&background=ef4444&color=fff' },
                products: ['SKF Ball Bearing', 'NTN Roller'],
                productCount: 2,
                total: 1800000,
                status: 'delivered',
                date: '2024-01-18 11:00',
                paymentMethod: 'Transfer Bank'
            },
            {
                id: 'ORD-2024-006',
                customer: { name: 'Sarah Wilson', email: 'sarah@example.com', avatar: 'https://ui-avatars.com/api/?name=Sarah+Wilson&size=64&background=06b6d4&color=fff' },
                products: ['FAG Bearing Set'],
                productCount: 1,
                total: 950000,
                status: 'cancelled',
                date: '2024-01-18 08:30',
                paymentMethod: 'Transfer Bank'
            },
            {
                id: 'ORD-2024-007',
                customer: { name: 'Michael Brown', email: 'michael@example.com', avatar: 'https://ui-avatars.com/api/?name=Michael+Brown&size=64&background=3b82f6&color=fff' },
                products: ['Timken Tapered', 'SKF Bearing'],
                productCount: 2,
                total: 1500000,
                status: 'processing',
                date: '2024-01-17 15:45',
                paymentMethod: 'COD'
            },
            {
                id: 'ORD-2024-008',
                customer: { name: 'Lisa Anderson', email: 'lisa@example.com', avatar: 'https://ui-avatars.com/api/?name=Lisa+Anderson&size=64&background=10b981&color=fff' },
                products: ['NSK Deep Groove', 'FAG Ball Bearing', 'NTN Roller'],
                productCount: 3,
                total: 3200000,
                status: 'processing',
                date: '2024-01-17 13:20',
                paymentMethod: 'Transfer Bank'
            },
            {
                id: 'ORD-2024-009',
                customer: { name: 'James Taylor', email: 'james@example.com', avatar: 'https://ui-avatars.com/api/?name=James+Taylor&size=64&background=f59e0b&color=fff' },
                products: ['SKF 6206 Bearing'],
                productCount: 1,
                total: 650000,
                status: 'shipped',
                date: '2024-01-16 10:15',
                paymentMethod: 'Transfer Bank'
            },
            {
                id: 'ORD-2024-010',
                customer: { name: 'Emily Martinez', email: 'emily@example.com', avatar: 'https://ui-avatars.com/api/?name=Emily+Martinez&size=64&background=8b5cf6&color=fff' },
                products: ['NTN Bearing Set', 'FAG Roller'],
                productCount: 2,
                total: 2100000,
                status: 'delivered',
                date: '2024-01-16 09:00',
                paymentMethod: 'COD'
            }
        ];

        let filteredOrders = [...orders];

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        // Dapatkan badge status
        function getStatusBadge(status) {
            const badges = {
                'pending': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i>Menunggu Bayar</span>',
                'processing': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"><i class="fas fa-cogs mr-1"></i>Diproses</span>',
                'shipped': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800"><i class="fas fa-truck mr-1"></i>Dikirim</span>',
                'delivered': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Selesai</span>',
                'cancelled': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"><i class="fas fa-times-circle mr-1"></i>Dibatalkan</span>'
            };
            return badges[status] || '';
        }

        // Render tabel
        function renderTable() {
            const tbody = document.getElementById('orderTableBody');

            if (filteredOrders.length === 0) {
                tbody.innerHTML = `
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                    <p>Tidak ada pesanan ditemukan</p>
                                </td>
                            </tr>
                        `;
                return;
            }

            tbody.innerHTML = filteredOrders.map(order => `
                        <tr class="hover:bg-gray-50 transition-all">
                            <td class="px-6 py-4">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <div class="font-semibold text-gray-900">${order.id}</div>
                                    <div class="text-sm text-gray-500">${order.date}</div>
                                    <div class="text-xs text-gray-400 mt-1">${order.paymentMethod}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="${order.customer.avatar}" alt="${order.customer.name}" 
                                        class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <div class="font-medium text-gray-900">${order.customer.name}</div>
                                        <div class="text-sm text-gray-500">${order.customer.email}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">${order.products[0]}</div>
                                ${order.productCount > 1 ? `<div class="text-xs text-blue-600 mt-1">+${order.productCount - 1} produk lainnya</div>` : ''}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">${formatCurrency(order.total)}</div>
                            </td>
                            <td class="px-6 py-4">
                                ${getStatusBadge(order.status)}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <button onclick="viewOrder('${order.id}')" 
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" 
                                        title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="updateStatus('${order.id}')" 
                                        class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-all" 
                                        title="Update Status">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="printInvoice('${order.id}')" 
                                        class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-all" 
                                        title="Cetak Invoice">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `).join('');
        }

        // Select semua checkbox
        function selectAll(checkbox) {
            const checkboxes = document.querySelectorAll('#orderTableBody input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
        }

        // Filter pesanan
        function filterOrders() {
            const statusFilter = document.getElementById('statusFilter').value;
            const searchInput = document.getElementById('searchInput').value.toLowerCase();

            filteredOrders = orders.filter(order => {
                const matchStatus = !statusFilter || order.status === statusFilter;
                const matchSearch = !searchInput ||
                    order.id.toLowerCase().includes(searchInput) ||
                    order.customer.name.toLowerCase().includes(searchInput) ||
                    order.customer.email.toLowerCase().includes(searchInput);

                return matchStatus && matchSearch;
            });

            renderTable();
        }

        // Sort pesanan
        function sortOrders() {
            const sortValue = document.getElementById('sortFilter').value;

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

            renderTable();
        }

        // Event pencarian
        document.getElementById('searchInput').addEventListener('input', filterOrders);

        // Lihat pesanan
        function viewOrder(orderId) {
            alert('Lihat detail pesanan: ' + orderId + '\n\nFitur dalam pengembangan');
            // window.location.href = '/admin/pembelian/detail/' + orderId;
        }

        // Update status
        function updateStatus(orderId) {
            alert('Update status pesanan: ' + orderId + '\n\nFitur dalam pengembangan');
        }

        // Cetak invoice
        function printInvoice(orderId) {
            alert('Cetak invoice pesanan: ' + orderId + '\n\nFitur dalam pengembangan');
        }

        // Export data
        function exportData() {
            alert('Export data ke Excel\n\nFitur dalam pengembangan');
        }

        // Inisialisasi
        renderTable();
    </script>
@endsection