@extends('layout.admin.app')

@section('title', 'Manajemen Merk')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Manajemen Merk</h1>
                        <p class="text-blue-100">Kelola merk produk bearing Anda</p>
                    </div>
                    <div class="md:block">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-tag text-blue-900 text-4xl"></i>
                        </div>
                    </div>
                </div>
            </div> <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Total Merk</p>
                            <h3 class="text-3xl font-bold text-gray-800" id="totalMerk">0</h3>
                        </div>
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <i class="fas fa-tag text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Merk Aktif</p>
                            <h3 class="text-3xl font-bold text-gray-800" id="merkAktif">0</h3>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-2xl"></i>
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

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Merk Premium</p>
                            <h3 class="text-3xl font-bold text-gray-800" id="merkPremium">0</h3>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <i class="fas fa-star text-yellow-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-2">
                <div class="flex items-end gap-4 overflow-x-auto">

                    <!-- Cari Merk -->
                    <div class="w-50 shrink-0">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Merk</label>
                        <input type="text" id="searchInput" placeholder="Cari nama merk..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Negara Asal -->
                    <div class="w-50 shrink-0">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Negara Asal</label>
                        <select id="countryFilter"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Negara</option>
                            <option value="jepang">Jepang</option>
                            <option value="jerman">Jerman</option>
                            <option value="usa">USA</option>
                            <option value="swedia">Swedia</option>
                            <option value="china">China</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="w-50 shrink-0">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="statusFilter"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak-aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="flex items-end gap-3">

                        <button onclick="exportData()"
                            class="bg-green-600 text-white px-8 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                            <i class="fas fa-file-excel mr-2"></i> Export Excel
                        </button>
                        <button onclick="resetFilter()"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300">
                            <i class="fas fa-undo mr-2"></i> Reset
                        </button>


                        <a href="/admin/merk/tambah"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-plus mr-2"></i> Tambah Merk
                        </a>

                    </div>
                </div>
            </div>


            <!-- Tabel Merk -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" onclick="selectAll(this)" class="rounded">
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Logo</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Merk</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Negara Asal</th>
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
        // Data dummy merk
        const merkData = [
            {
                id: 1,
                nama: 'SKF',
                negara: 'Swedia',
                deskripsi: 'Produsen bearing terkemuka dunia sejak 1907',
                logo: 'https://via.placeholder.com/80x80/1976D2/FFFFFF?text=SKF',
                jumlahProduk: 342,
                status: 'aktif',
                isPremium: true
            },
            {
                id: 2,
                nama: 'NSK',
                negara: 'Jepang',
                deskripsi: 'Bearing presisi tinggi untuk industri otomotif',
                logo: 'https://via.placeholder.com/80x80/D32F2F/FFFFFF?text=NSK',
                jumlahProduk: 298,
                status: 'aktif',
                isPremium: true
            },
            {
                id: 3,
                nama: 'NTN',
                negara: 'Jepang',
                deskripsi: 'Bearing berkualitas tinggi dengan teknologi terkini',
                logo: 'https://via.placeholder.com/80x80/388E3C/FFFFFF?text=NTN',
                jumlahProduk: 256,
                status: 'aktif',
                isPremium: true
            },
            {
                id: 4,
                nama: 'FAG',
                negara: 'Jerman',
                deskripsi: 'Bearing premium untuk aplikasi industri berat',
                logo: 'https://via.placeholder.com/80x80/F57C00/FFFFFF?text=FAG',
                jumlahProduk: 189,
                status: 'aktif',
                isPremium: true
            },
            {
                id: 5,
                nama: 'Timken',
                negara: 'USA',
                deskripsi: 'Spesialis tapered roller bearing',
                logo: 'https://via.placeholder.com/80x80/303F9F/FFFFFF?text=TMK',
                jumlahProduk: 167,
                status: 'aktif',
                isPremium: false
            },
            {
                id: 6,
                nama: 'INA',
                negara: 'Jerman',
                deskripsi: 'Bearing untuk aplikasi otomotif dan industri',
                logo: 'https://via.placeholder.com/80x80/7B1FA2/FFFFFF?text=INA',
                jumlahProduk: 145,
                status: 'aktif',
                isPremium: false
            },
            {
                id: 7,
                nama: 'KOYO',
                negara: 'Jepang',
                deskripsi: 'Bearing ekonomis dengan kualitas terjamin',
                logo: 'https://via.placeholder.com/80x80/0097A7/FFFFFF?text=KYO',
                jumlahProduk: 134,
                status: 'aktif',
                isPremium: false
            },
            {
                id: 8,
                nama: 'NACHI',
                negara: 'Jepang',
                deskripsi: 'Bearing presisi untuk mesin perkakas',
                logo: 'https://via.placeholder.com/80x80/C62828/FFFFFF?text=NCH',
                jumlahProduk: 112,
                status: 'tidak-aktif',
                isPremium: false
            },
            {
                id: 9,
                nama: 'FYH',
                negara: 'China',
                deskripsi: 'Bearing housing berkualitas dengan harga kompetitif',
                logo: 'https://via.placeholder.com/80x80/E64A19/FFFFFF?text=FYH',
                jumlahProduk: 98,
                status: 'aktif',
                isPremium: false
            },
            {
                id: 10,
                nama: 'ZWZ',
                negara: 'China',
                deskripsi: 'Bearing ekonomis untuk aplikasi umum',
                logo: 'https://via.placeholder.com/80x80/5D4037/FFFFFF?text=ZWZ',
                jumlahProduk: 87,
                status: 'aktif',
                isPremium: false
            }
        ];

        // Render tabel
        function renderTable() {
            const tbody = document.getElementById('tableBody');
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const countryValue = document.getElementById('countryFilter').value;
            const statusValue = document.getElementById('statusFilter').value;

            let filtered = merkData.filter(item => {
                const matchSearch = item.nama.toLowerCase().includes(searchValue) ||
                    item.deskripsi.toLowerCase().includes(searchValue);
                const matchCountry = !countryValue || item.negara.toLowerCase() === countryValue;
                const matchStatus = !statusValue || item.status === statusValue;
                return matchSearch && matchCountry && matchStatus;
            });

            tbody.innerHTML = filtered.map(item => `
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="${item.logo}" alt="${item.nama}" class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">${item.nama}</div>
                                    ${item.isPremium ? '<i class="fas fa-crown text-yellow-500 ml-2" title="Merk Premium"></i>' : ''}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    ${item.negara}
                                </span>
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
                                <button onclick="viewMerk(${item.id})" class="text-green-600 hover:text-green-900 mr-3" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editMerk(${item.id})" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteMerk(${item.id})" class="text-red-600 hover:text-red-900" title="Hapus">
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
        function updateStatistics(data = merkData) {
            document.getElementById('totalMerk').textContent = merkData.length;
            document.getElementById('merkAktif').textContent = merkData.filter(m => m.status === 'aktif').length;
            document.getElementById('totalProduk').textContent = merkData.reduce((sum, m) => sum + m.jumlahProduk, 0);
            document.getElementById('merkPremium').textContent = merkData.filter(m => m.isPremium).length;
        }

        // Select all checkbox
        function selectAll(checkbox) {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
        }

        // View merk
        function viewMerk(id) {
            alert(`Melihat detail merk ID: ${id}`);
        }

        // Edit merk
        function editMerk(id) {
            window.location.href = `/admin/merk/${id}/edit`;
        }

        // Delete merk
        function deleteMerk(id) {
            if (confirm('Apakah Anda yakin ingin menghapus merk ini?')) {
                alert('Merk berhasil dihapus!');
                // Di sini akan ada logika untuk menghapus data
            }
        }

        // Export data
        function exportData() {
            alert('Mengexport data ke Excel...');
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', renderTable);
        document.getElementById('countryFilter').addEventListener('change', renderTable);
        document.getElementById('statusFilter').addEventListener('change', renderTable);

        // Inisialisasi
        renderTable();
    </script>
@endsection