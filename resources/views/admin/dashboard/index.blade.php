@extends('layout.admin.app')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Header Dashboard -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Dashboard Admin</h1>
                <p class="text-blue-100">Selamat datang kembali! Berikut ringkasan toko Anda hari ini.</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center text-blue-100">
            <i class="fas fa-calendar-day mr-2"></i>
            <span id="currentDate"></span>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Pendapatan -->
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-all">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Pendapatan bulan ini</p>
                    <p class="text-2xl font-bold text-gray-900">Rp 125,4 Jt</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>+12,5% dari bulan lalu
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-linear-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-dollar-sign text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-all">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Pesanan</p>
                    <p class="text-2xl font-bold text-gray-900">1,542</p>
                </div>
                <div
                    class="w-14 h-14 bg-linear-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-shopping-cart text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Produk -->
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-all">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Produk</p>
                    <p class="text-2xl font-bold text-gray-900">1,248</p>
                </div>
                <div
                    class="w-14 h-14 bg-linear-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-box text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pelanggan -->
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-all">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Pelanggan</p>
                    <p class="text-2xl font-bold text-gray-900">2,847</p>
                    <p class="text-xs text-yellow-600 mt-2">
                        <i class="fas fa-user-plus mr-1"></i>28 pelanggan baru
                    </p>
                </div>
                <div
                    class="w-14 h-14 bg-linear-to-br from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6 mb-8">
        <!-- Grafik Penjualan -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-chart-area mr-2 text-blue-600"></i>Grafik Penjualan
                </h2>
                <select id="chartPeriod" onchange="updateChart()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="7days">7 Hari Terakhir</option>
                    <option value="30days" selected>30 Hari Terakhir</option>
                    <option value="90days">90 Hari Terakhir</option>
                    <option value="year">Tahun Ini</option>
                </select>
            </div>

            <!-- Canvas untuk Chart -->
            <div class="h-80">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Pesanan Terbaru -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-clock mr-2 text-blue-600"></i>Pesanan Terbaru
            </h2>

            <div class="space-y-4" id="recentOrders">
                <!-- Orders akan diisi oleh JavaScript -->
            </div>

            <a href="#"
                class="block mt-4 px-4 py-2 text-center border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-all">
                Lihat Semua Pesanan
            </a>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6 mb-8">
        <!-- Produk Terlaris -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-fire mr-2 text-blue-600"></i>Produk Terlaris
            </h2>

            <div class="space-y-4" id="topProducts">
                <!-- Products akan diisi oleh JavaScript -->
            </div>
        </div>

        <!-- Stok Menipis -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-exclamation-triangle mr-2 text-red-600"></i>Stok Menipis
            </h2>

            <div class="space-y-4" id="lowStock">
                <!-- Low stock items akan diisi oleh JavaScript -->
            </div>

            <a href="#"
                class="block mt-4 px-4 py-2 text-center border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all">
                Kelola Stok
            </a>
        </div>
    </div>


    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        // Set tanggal saat ini
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('id-ID', options);

        // Data dummy
        const recentOrdersData = [
            { id: 'ORD-2024-001', customer: 'John Doe', amount: 850000, status: 'pending', time: '5 menit lalu' },
            { id: 'ORD-2024-002', customer: 'Jane Smith', amount: 1250000, status: 'paid', time: '15 menit lalu' },
            { id: 'ORD-2024-003', customer: 'Robert Johnson', amount: 650000, status: 'processing', time: '1 jam lalu' },
            { id: 'ORD-2024-004', customer: 'Maria Garcia', amount: 2400000, status: 'shipped', time: '2 jam lalu' },
            { id: 'ORD-2024-005', customer: 'David Lee', amount: 450000, status: 'delivered', time: '3 jam lalu' }
        ];

        const topProductsData = [
            { name: 'SKF 6204 Bearing', sold: 342, image: 'https://via.placeholder.com/50?text=SKF' },
            { name: 'NSK Ball Bearing', sold: 289, image: 'https://via.placeholder.com/50?text=NSK' },
            { name: 'NTN Roller Bearing', sold: 245, image: 'https://via.placeholder.com/50?text=NTN' },
            { name: 'FAG Deep Groove', sold: 198, image: 'https://via.placeholder.com/50?text=FAG' },
            { name: 'Timken Bearing', sold: 156, image: 'https://via.placeholder.com/50?text=TMK' }
        ];

        const lowStockData = [
            { name: 'NSK 6205 Bearing', stock: 8, minStock: 20, sku: 'NSK-6205' },
            { name: 'FAG 7208 Angular', stock: 5, minStock: 15, sku: 'FAG-7208' },
            { name: 'SKF 6208 Ball', stock: 12, minStock: 20, sku: 'SKF-6208' },
            { name: 'NTN 7210 Contact', stock: 3, minStock: 15, sku: 'NTN-7210' }
        ];

        const recentActivityData = [
            { type: 'order', text: 'Pesanan baru #ORD-2024-001', time: '5 menit lalu', icon: 'fa-shopping-cart', color: 'blue' },
            { type: 'product', text: 'Produk SKF-6204 stok diperbarui', time: '30 menit lalu', icon: 'fa-box', color: 'green' },
            { type: 'customer', text: 'Pelanggan baru mendaftar', time: '1 jam lalu', icon: 'fa-user-plus', color: 'purple' },
            { type: 'review', text: 'Review baru untuk NSK Ball Bearing', time: '2 jam lalu', icon: 'fa-star', color: 'yellow' },
            { type: 'payment', text: 'Pembayaran dikonfirmasi #ORD-2024-002', time: '3 jam lalu', icon: 'fa-check-circle', color: 'green' }
        ];

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        // Dapatkan badge status
        function getStatusBadge(status) {
            const badges = {
                'pending': '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i>Pending</span>',
                'paid': '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"><i class="fas fa-check mr-1"></i>Dibayar</span>',
                'processing': '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800"><i class="fas fa-cogs mr-1"></i>Diproses</span>',
                'shipped': '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800"><i class="fas fa-truck mr-1"></i>Dikirim</span>',
                'delivered': '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Selesai</span>'
            };
            return badges[status] || '';
        }

        // Render pesanan terbaru
        function renderRecentOrders() {
            const container = document.getElementById('recentOrders');
            container.innerHTML = recentOrdersData.map(order => `
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900 text-sm">${order.id}</p>
                                    <p class="text-xs text-gray-500">${order.customer}</p>
                                    <p class="text-xs text-blue-600 mt-1">${formatCurrency(order.amount)}</p>
                                </div>
                                <div class="text-right">
                                    ${getStatusBadge(order.status)}
                                    <p class="text-xs text-gray-400 mt-1">${order.time}</p>
                                </div>
                            </div>
                        `).join('');
        }

        // Render produk terlaris
        function renderTopProducts() {
            const container = document.getElementById('topProducts');
            container.innerHTML = topProductsData.map((product, index) => `
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                                <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 font-bold text-sm">
                                    ${index + 1}
                                </div>
                                <img src="${product.image}" alt="${product.name}" class="w-10 h-10 rounded-lg mr-3">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900 text-sm">${product.name}</p>
                                    <p class="text-xs text-gray-500">${product.sold} terjual</p>
                                </div>
                                <i class="fas fa-fire text-orange-500"></i>
                            </div>
                        `).join('');
        }

        // Render stok menipis
        function renderLowStock() {
            const container = document.getElementById('lowStock');
            container.innerHTML = lowStockData.map(item => `
                            <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-sm">${item.name}</p>
                                        <p class="text-xs text-gray-500">SKU: ${item.sku}</p>
                                    </div>
                                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-600">Stok: <span class="font-bold text-red-600">${item.stock}</span> / ${item.minStock}</span>
                                    <button onclick="restockProduct('${item.sku}')" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                        Restock
                                    </button>
                                </div>
                            </div>
                        `).join('');
        }

        // Grafik penjualan
        let salesChart;
        function createSalesChart() {
            const ctx = document.getElementById('salesChart').getContext('2d');

            // Data dummy untuk 30 hari
            const labels = [];
            const data = [];
            for (let i = 29; i >= 0; i--) {
                const date = new Date();
                date.setDate(date.getDate() - i);
                labels.push(date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }));
                data.push(Math.floor(Math.random() * 5000000) + 2000000);
            }

            salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: data,
                        borderColor: 'rgb(37, 99, 235)',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(37, 99, 235)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return 'Rp ' + (value / 1000000).toFixed(1) + 'Jt';
                                }
                            }
                        }
                    }
                }
            });
        }

        // Update grafik
        function updateChart() {
            const period = document.getElementById('chartPeriod').value;
            alert('Update chart untuk periode: ' + period + '\n\nFitur dalam pengembangan');
        }

        // Restock produk
        function restockProduct(sku) {
            const amount = prompt('Tambah stok untuk ' + sku + ' (unit):');
            if (amount && !isNaN(amount)) {
                alert(`Menambah ${amount} unit stok untuk ${sku}\n\nFitur dalam pengembangan`);
            }
        }

        // Export laporan
        function exportReport() {
            alert('Export laporan ke Excel\n\nFitur dalam pengembangan');
        }

        // Inisialisasi
        renderRecentOrders();
        renderTopProducts();
        renderLowStock();
        createSalesChart();
    </script>
@endsection