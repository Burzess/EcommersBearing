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
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>Dari pesanan selesai
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
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalPesanan ?? 0) }}</p>
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
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalProduk ?? 0) }}</p>
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
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalPelanggan ?? 0) }}</p>
                    <p class="text-xs text-yellow-600 mt-2">
                        <i class="fas fa-user-plus mr-1"></i>Akun terdaftar
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

            <div class="space-y-4">
                @forelse($pesananTerbaru ?? [] as $pesanan)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900 text-sm">{{ $pesanan->order_number }}</p>
                            <p class="text-xs text-gray-500">{{ $pesanan->user->name ?? 'Guest' }}</p>
                            <p class="text-xs text-blue-600 mt-1">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            {!! $pesanan->status_badge !!}
                            <p class="text-xs text-gray-400 mt-1">{{ $pesanan->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2"></i>
                        <p>Belum ada pesanan</p>
                    </div>
                @endforelse
            </div>

            <a href="{{ route('admin.pembelian.index') }}"
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

            <div class="space-y-4">
                @forelse($produkStokMenipis ?? [] as $produk)
                    <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 text-sm">{{ $produk->nama }}</p>
                                <p class="text-xs text-gray-500">SKU: {{ $produk->sku }}</p>
                            </div>
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600">Stok: <span class="font-bold text-red-600">{{ $produk->stok }}</span> / {{ $produk->min_stok }}</span>
                            <a href="{{ route('admin.produk.edit', $produk->id) }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                Edit Stok
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-check-circle text-4xl mb-2 text-green-500"></i>
                        <p>Semua stok aman</p>
                    </div>
                @endforelse
            </div>

            <a href="{{ route('admin.produk.index') }}"
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

        // Data untuk grafik dari backend
        const salesData = @json($penjualan7Hari ?? []);

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        // Grafik penjualan
        let salesChart;
        function createSalesChart() {
            const ctx = document.getElementById('salesChart').getContext('2d');

            // Gunakan data dari controller
            const labels = salesData.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
            });
            const data = salesData.map(item => item.total);

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
            window.location.href = '{{ route('admin.dashboard.index') }}?period=' + period;
        }

        // Inisialisasi
        createSalesChart();
    </script>
@endsection