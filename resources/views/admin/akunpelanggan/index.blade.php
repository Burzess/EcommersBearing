@extends('layout.admin.app')

@section('title', 'Manajemen Akun Pelanggan - Admin')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Manajemen Akun Pelanggan</h1>
                <p class="text-blue-100">Kelola data pelanggan terdaftar</p>
            </div>
            <div class="md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Pelanggan</p>
                    <p class="text-3xl font-bold text-gray-900">2,847</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Aktif Bulan Ini</p>
                    <p class="text-3xl font-bold text-gray-900">1,234</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-check text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Baru Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-900">28</p>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-plus text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Tidak Aktif</p>
                    <p class="text-3xl font-bold text-gray-900">156</p>
                    <p class="text-xs text-red-600 mt-2">
                        <i class="fas fa-exclamation-triangle mr-1"></i>>30 hari
                    </p>
                </div>
                <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-slash text-red-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="grid md:grid-cols-4 gap-4">
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Cari nama, email, atau telepon..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
            </div>
            <select id="statusFilter" onchange="filterCustomers()"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="all">Semua Status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Tidak Aktif</option>
                <option value="suspended">Ditangguhkan</option>
            </select>
            <select id="sortFilter" onchange="sortCustomers()"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="newest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="name">Nama A-Z</option>
                <option value="orders">Pesanan Terbanyak</option>
            </select>
            <button onclick="exportData()"
                class="px-4 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-all">
                <i class="fas fa-download mr-2"></i>Export Excel
            </button>
        </div>
    </div>

    <!-- Tabel Pelanggan -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <input type="checkbox" onchange="selectAll(this)"
                                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Pelanggan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Kontak
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Total Pesanan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Total Belanja
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="customerTable" class="divide-y divide-gray-200">
                    <!-- Data akan dimuat oleh JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-medium">1-10</span> dari <span class="font-medium">2,847</span> pelanggan
            </div>
            <div class="flex space-x-2">
                <button
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
                <button
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">2</button>
                <button
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">3</button>
                <button
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Data dummy pelanggan
        let customers = [
            {
                id: 1,
                name: 'John Doe',
                email: 'john.doe@example.com',
                phone: '0812-3456-7890',
                avatar: 'https://ui-avatars.com/api/?name=John+Doe&size=40&background=3b82f6&color=fff',
                totalOrders: 24,
                totalSpent: 15750000,
                status: 'active',
                joinDate: '2024-01-15',
                lastActive: '2 jam lalu'
            },
            {
                id: 2,
                name: 'Jane Smith',
                email: 'jane.smith@example.com',
                phone: '0813-7654-3210',
                avatar: 'https://ui-avatars.com/api/?name=Jane+Smith&size=40&background=10b981&color=fff',
                totalOrders: 18,
                totalSpent: 12300000,
                status: 'active',
                joinDate: '2024-02-20',
                lastActive: '1 hari lalu'
            },
            {
                id: 3,
                name: 'Bob Johnson',
                email: 'bob.johnson@example.com',
                phone: '0814-9876-5432',
                avatar: 'https://ui-avatars.com/api/?name=Bob+Johnson&size=40&background=f59e0b&color=fff',
                totalOrders: 32,
                totalSpent: 22450000,
                status: 'active',
                joinDate: '2023-12-10',
                lastActive: '5 menit lalu'
            },
            {
                id: 4,
                name: 'Alice Brown',
                email: 'alice.brown@example.com',
                phone: '0815-5555-1234',
                avatar: 'https://ui-avatars.com/api/?name=Alice+Brown&size=40&background=8b5cf6&color=fff',
                totalOrders: 8,
                totalSpent: 5600000,
                status: 'inactive',
                joinDate: '2024-03-05',
                lastActive: '45 hari lalu'
            },
            {
                id: 5,
                name: 'Charlie Wilson',
                email: 'charlie.wilson@example.com',
                phone: '0816-7777-8888',
                avatar: 'https://ui-avatars.com/api/?name=Charlie+Wilson&size=40&background=ef4444&color=fff',
                totalOrders: 0,
                totalSpent: 0,
                status: 'suspended',
                joinDate: '2024-04-12',
                lastActive: 'Tidak pernah'
            },
            {
                id: 6,
                name: 'Diana Prince',
                email: 'diana.prince@example.com',
                phone: '0817-1111-2222',
                avatar: 'https://ui-avatars.com/api/?name=Diana+Prince&size=40&background=ec4899&color=fff',
                totalOrders: 15,
                totalSpent: 9850000,
                status: 'active',
                joinDate: '2024-01-28',
                lastActive: '3 jam lalu'
            },
            {
                id: 7,
                name: 'Ethan Hunt',
                email: 'ethan.hunt@example.com',
                phone: '0818-3333-4444',
                avatar: 'https://ui-avatars.com/api/?name=Ethan+Hunt&size=40&background=14b8a6&color=fff',
                totalOrders: 42,
                totalSpent: 31200000,
                status: 'active',
                joinDate: '2023-11-05',
                lastActive: '15 menit lalu'
            },
            {
                id: 8,
                name: 'Fiona Green',
                email: 'fiona.green@example.com',
                phone: '0819-6666-7777',
                avatar: 'https://ui-avatars.com/api/?name=Fiona+Green&size=40&background=f97316&color=fff',
                totalOrders: 12,
                totalSpent: 7900000,
                status: 'active',
                joinDate: '2024-02-14',
                lastActive: '1 hari lalu'
            },
            {
                id: 9,
                name: 'George Martin',
                email: 'george.martin@example.com',
                phone: '0821-9999-0000',
                avatar: 'https://ui-avatars.com/api/?name=George+Martin&size=40&background=6366f1&color=fff',
                totalOrders: 5,
                totalSpent: 3200000,
                status: 'inactive',
                joinDate: '2024-03-20',
                lastActive: '60 hari lalu'
            },
            {
                id: 10,
                name: 'Hannah White',
                email: 'hannah.white@example.com',
                phone: '0822-4444-5555',
                avatar: 'https://ui-avatars.com/api/?name=Hannah+White&size=40&background=06b6d4&color=fff',
                totalOrders: 28,
                totalSpent: 18600000,
                status: 'active',
                joinDate: '2024-01-10',
                lastActive: '30 menit lalu'
            }
        ];

        let filteredCustomers = [...customers];

        // Format mata uang
        function formatCurrency(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Badge status
        function getStatusBadge(status) {
            const badges = {
                active: { class: 'bg-green-100 text-green-700', icon: 'check-circle', text: 'Aktif' },
                inactive: { class: 'bg-yellow-100 text-yellow-700', icon: 'clock', text: 'Tidak Aktif' },
                suspended: { class: 'bg-red-100 text-red-700', icon: 'ban', text: 'Ditangguhkan' }
            };
            const badge = badges[status];
            return `<span class="${badge.class} px-3 py-1 rounded-full text-xs font-semibold flex items-center w-fit">
                                <i class="fas fa-${badge.icon} mr-1"></i>${badge.text}
                            </span>`;
        }

        // Render tabel
        function renderTable() {
            const tbody = document.getElementById('customerTable');
            tbody.innerHTML = filteredCustomers.map(customer => `
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="${customer.avatar}" alt="${customer.name}" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <p class="font-medium text-gray-900">${customer.name}</p>
                                        <p class="text-sm text-gray-500">Bergabung: ${new Date(customer.joinDate).toLocaleDateString('id-ID')}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">${customer.email}</p>
                                <p class="text-sm text-gray-500">${customer.phone}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">${customer.totalOrders} pesanan</p>
                                <p class="text-xs text-gray-500">Terakhir: ${customer.lastActive}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">${formatCurrency(customer.totalSpent)}</p>
                            </td>
                            <td class="px-6 py-4">
                                ${getStatusBadge(customer.status)}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <button onclick="viewCustomer(${customer.id})" 
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="editCustomer(${customer.id})" 
                                        class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-all" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="suspendCustomer(${customer.id})" 
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Tangguhkan">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `).join('');
        }

        // Select semua
        function selectAll(checkbox) {
            const checkboxes = document.querySelectorAll('#customerTable input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
        }

        // Filter pelanggan
        function filterCustomers() {
            const status = document.getElementById('statusFilter').value;

            if (status === 'all') {
                filteredCustomers = [...customers];
            } else {
                filteredCustomers = customers.filter(c => c.status === status);
            }

            renderTable();
        }

        // Sort pelanggan
        function sortCustomers() {
            const sort = document.getElementById('sortFilter').value;

            switch (sort) {
                case 'newest':
                    filteredCustomers.sort((a, b) => new Date(b.joinDate) - new Date(a.joinDate));
                    break;
                case 'oldest':
                    filteredCustomers.sort((a, b) => new Date(a.joinDate) - new Date(b.joinDate));
                    break;
                case 'name':
                    filteredCustomers.sort((a, b) => a.name.localeCompare(b.name));
                    break;
                case 'orders':
                    filteredCustomers.sort((a, b) => b.totalOrders - a.totalOrders);
                    break;
            }

            renderTable();
        }

        // Search
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const search = e.target.value.toLowerCase();
            filteredCustomers = customers.filter(c =>
                c.name.toLowerCase().includes(search) ||
                c.email.toLowerCase().includes(search) ||
                c.phone.includes(search)
            );
            renderTable();
        });

        // View Customer
        function viewCustomer(id) {
            alert(`Lihat detail pelanggan ID: ${id}\n\nFitur dalam pengembangan`);
        }

        // Edit Customer
        function editCustomer(id) {
            window.location.href = `/admin/akunpelanggan/edit?id=${id}`;
        }

        // Suspend Customer
        function suspendCustomer(id) {
            if (confirm('Tangguhkan akun pelanggan ini?')) {
                alert(`Pelanggan ID ${id} ditangguhkan\n\nFitur dalam pengembangan`);
            }
        }

        // Export Data
        function exportData() {
            alert('Export data pelanggan ke Excel\n\nFitur dalam pengembangan');
        }

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function () {
            renderTable();
        });
    </script>
@endsection