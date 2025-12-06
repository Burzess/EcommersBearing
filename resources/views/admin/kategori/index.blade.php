@extends('layout.admin.app')

@section('title', 'Manajemen Kategori')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Manajemen Kategori</h1>
                        <p class="text-blue-100">Kelola kategori produk bearing Anda</p>
                    </div>
                    <div class="md:block">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-layer-group text-blue-900 text-4xl"></i>
                        </div>
                    </div>
                </div>
            </div> <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Total Kategori</p>
                            <h3 class="text-3xl font-bold text-gray-800" id="totalKategori">0</h3>
                        </div>
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <i class="fas fa-layer-group text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Kategori Aktif</p>
                            <h3 class="text-3xl font-bold text-gray-800" id="kategoriAktif">0</h3>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Kategori Tidak Aktif</p>
                            <h3 class="text-3xl font-bold text-gray-800" id="kategoriNonAktif">0</h3>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <i class="fas fa-pause-circle text-yellow-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Total Produk</p>
                            <h3 class="text-3xl font-bold text-gray-800" id="totalProduk">0</h3>
                        </div>
                        <div class="bg-purple-100 p-4 rounded-lg">
                            <i class="fas fa-box text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="bg-white rounded-xl shadow-md p-4 mb-8">

                <!-- Bikin grid 4 kolom agar Input + Input + Button Area muat -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <!-- Cari -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Kategori</label>
                        <input type="text" id="searchInput" placeholder="Cari nama atau deskripsi..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="statusFilter"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak-aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="md:col-span-2 flex flex-wrap md:flex-nowrap gap-4 items-end justify-end">

                        <!-- Export -->
                        <button onclick="exportData()"
                            class="flex-1 lg:flex-none px-15 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-all">
                            <i class="fas fa-file-excel mr-2"></i>Export
                        </button>

                        <!-- Reset -->
                        <button onclick="resetFilter()"
                            class="flex-1 lg:flex-none px-10 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition-all">
                            <i class="fas fa-undo mr-2"></i>Reset
                        </button>

                        <!-- Tambah -->
                        <a href="#"
                            class="flex-1 lg:flex-none px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all text-center">
                            <i class="fas fa-plus mr-2"></i>Tambah Kategori
                        </a>

                    </div>

                </div>
            </div>



            <!-- Tabel Kategori -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" onclick="selectAll(this)" class="rounded">
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gambar</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Produk</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data dummy kategori
        const kategoriData = [
            {
                id: 1,
                nama: 'Ball Bearing',
                deskripsi: 'Bantalan bola untuk beban radial dan aksial ringan',
                image: '/assets/ball_bearing.jpeg',
                jumlahProduk: 342,
                status: 'aktif'
            },
            {
                id: 2,
                nama: 'Roller Bearing',
                deskripsi: 'Bantalan rol untuk beban berat dan kecepatan tinggi',
                image: '/assets/roller_bearing.jpeg',
                jumlahProduk: 248,
                status: 'aktif'
            },
            {
                id: 3,
                nama: 'Thrust Bearing',
                deskripsi: 'Bantalan aksial untuk beban aksial murni',
                image: '/assets/thrust_bearing.jpg',
                jumlahProduk: 156,
                status: 'aktif'
            },
            {
                id: 4,
                nama: 'Angular Contact',
                deskripsi: 'Bantalan kontak sudut untuk beban kombinasi',
                image: '/assets/angular_contact_bearing.jpeg',
                jumlahProduk: 189,
                status: 'aktif'
            },
            {
                id: 5,
                nama: 'Tapered Roller',
                deskripsi: 'Bantalan rol tirus untuk beban berat',
                image: '/assets/thrust_bearing.jpg',
                jumlahProduk: 134,
                status: 'aktif'
            },
            {
                id: 6,
                nama: 'Needle Bearing',
                deskripsi: 'Bantalan jarum untuk ruang sempit',
                image: '/assets/needle_bearing.jpeg',
                jumlahProduk: 98,
                status: 'aktif'
            },
            {
                id: 7,
                nama: 'Spherical Bearing',
                deskripsi: 'Bantalan bulat untuk kompensasi misalignment',
                image: '/assets/spherical_bearing.jpeg',
                jumlahProduk: 76,
                status: 'tidak-aktif'
            },
            {
                id: 8,
                nama: 'Cylindrical Roller',
                deskripsi: 'Bantalan rol silinder untuk beban radial tinggi',
                image: '/assets/semua bearing.jpg',
                jumlahProduk: 112,
                status: 'aktif'
            }
        ];

        // Render tabel
        function renderTable() {
            const tbody = document.getElementById('tableBody');
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const statusValue = document.getElementById('statusFilter').value;

            let filtered = kategoriData.filter(item => {
                const matchSearch = item.nama.toLowerCase().includes(searchValue) ||
                    item.deskripsi.toLowerCase().includes(searchValue);
                const matchStatus = !statusValue || item.status === statusValue;
                return matchSearch && matchStatus;
            });

            tbody.innerHTML = filtered.map(item => `
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="rounded">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="${item.image}" alt="${item.nama}" class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">${item.nama}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">${item.deskripsi}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        ${item.jumlahProduk} produk
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    ${getStatusBadge(item.status)}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editKategori(${item.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteKategori(${item.id})" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `).join('');

            updateStatistics(filtered);
        }

        // Get status badge
        function getStatusBadge(status) {
            if (status === 'aktif') {
                return '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i> Aktif</span>';
            } else {
                return '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"><i class="fas fa-pause-circle mr-1"></i> Tidak Aktif</span>';
            }
        }

        // Update statistik
        function updateStatistics(data = kategoriData) {
            document.getElementById('totalKategori').textContent = kategoriData.length;
            document.getElementById('kategoriAktif').textContent = kategoriData.filter(k => k.status === 'aktif').length;
            document.getElementById('kategoriNonAktif').textContent = kategoriData.filter(k => k.status === 'tidak-aktif').length;
            document.getElementById('totalProduk').textContent = kategoriData.reduce((sum, k) => sum + k.jumlahProduk, 0);
        }

        // Select all checkbox
        function selectAll(checkbox) {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
        }

        // Edit kategori
        function editKategori(id) {
            window.location.href = `/admin/kategori/${id}/edit`;
        }

        // Delete kategori
        function deleteKategori(id) {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                alert('Kategori berhasil dihapus!');
                // Di sini akan ada logika untuk menghapus data
            }
        }

        // Export data
        function exportData() {
            alert('Mengexport data ke Excel...');
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', renderTable);
        document.getElementById('statusFilter').addEventListener('change', renderTable);

        // Inisialisasi
        renderTable();
    </script>
@endsection