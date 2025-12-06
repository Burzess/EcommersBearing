@extends('layout.pelanggan.app')

@section('title', 'Profil Saya - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Profil Saya</h1>
                <p class="text-blue-100">Kelola informasi profil Anda</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-blue-800 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Sidebar Menu Profil -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md">

                <!-- Avatar -->
                <div class="relative bg-linear-to-br from-blue-700 to-blue-900 p-8 text-center rounded-xl overflow-hidden">
                    <!-- Background coretan SVG -->
                    <svg class="absolute top-0 left-0 w-full h-full" preserveAspectRatio="none">
                        <!-- Coretan 1 -->
                        <path d="M0,120 C160,210 340,10 500,120 L500,0 L0,0 Z" fill="rgba(255,255,255,0.10)">
                            <animate attributeName="d" dur="6s" repeatCount="indefinite" values="
                    M0,120 C160,210 340,10 500,120 L500,0 L0,0 Z;
                    M0,110 C140,190 360,30 500,110 L500,0 L0,0 Z;
                    M0,130 C150,200 350,20 500,130 L500,0 L0,0 Z;
                    M0,120 C160,210 340,10 500,120 L500,0 L0,0 Z" />
                        </path>

                        <!-- Coretan 2 -->
                        <path d="M0,160 C180,120 320,260 500,160 L500,0 L0,0 Z" fill="rgba(255,255,255,0.08)">
                            <animate attributeName="d" dur="5s" repeatCount="indefinite" values="
                    M0,160 C180,120 320,260 500,160 L500,0 L0,0 Z;
                    M0,150 C200,100 300,240 500,150 L500,0 L0,0 Z;
                    M0,170 C190,130 310,270 500,170 L500,0 L0,0 Z;
                    M0,160 C180,120 320,260 500,160 L500,0 L0,0 Z " />
                        </path>

                        <!-- Coretan 3 -->
                        <path d="M0,100 C120,180 380,0 500,100 L500,0 L0,0 Z" fill="rgba(255,255,255,0.05)">
                            <animate attributeName="d" dur="4s" repeatCount="indefinite" values="
                    M0,100 C120,180 380,0 500,100 L500,0 L0,0 Z;
                    M0,90 C100,160 400,20 500,90 L500,0 L0,0 Z;
                    M0,110 C130,200 370,-10 500,110 L500,0 L0,0 Z;
                    M0,100 C120,180 380,0 500,100 L500,0 L0,0 Z" />
                        </path>
                    </svg>


                    <div class="w-32 h-32 mx-auto mb-4 relative">
                        <img id="profileAvatar" src="/assets/profil.jpg" alt="Avatar"
                            class="w-full h-full rounded-full border-4 border-white shadow-lg object-cover">
                        <button onclick="changeAvatar()"
                            class="absolute bottom-0 right-0 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-gray-100 transition-all">
                            <i class="fas fa-camera text-blue-600"></i>
                        </button>
                    </div>
                    <h2 class="text-xl font-bold text-white mb-1" id="profileNameDisplay">John Doe</h2>
                    <p class="text-blue-100 text-sm" id="profileEmailDisplay">john.doe@example.com</p>
                </div>


                <!-- Menu -->
                <div class="p-2">
                    <button onclick="showSection('info')" data-section="info"
                        class="profile-menu-item w-full flex items-center px-4 py-3 rounded-lg text-left font-medium text-white bg-blue-600 mb-1 transition-all">
                        <i class="fas fa-user w-5 mr-3"></i>
                        <span>Informasi Pribadi</span>
                    </button>
                    <button onclick="showSection('alamat')" data-section="alamat"
                        class="profile-menu-item w-full flex items-center px-4 py-3 rounded-lg text-left font-medium text-gray-700 hover:bg-gray-100 mb-1 transition-all">
                        <i class="fas fa-map-marker-alt w-5 mr-3"></i>
                        <span>Alamat Pengiriman</span>
                    </button>
                    <button onclick="showSection('keamanan')" data-section="keamanan"
                        class="profile-menu-item w-full flex items-center px-4 py-3 rounded-lg text-left font-medium text-gray-700 hover:bg-gray-100 mb-1 transition-all">
                        <i class="fas fa-lock w-5 mr-3"></i>
                        <span>Keamanan</span>
                    </button>
                    <button onclick="showSection('notifikasi')" data-section="notifikasi"
                        class="profile-menu-item w-full flex items-center px-4 py-3 rounded-lg text-left font-medium text-gray-700 hover:bg-gray-100 mb-1 transition-all">
                        <i class="fas fa-bell w-5 mr-3"></i>
                        <span>Notifikasi</span>
                    </button>
                </div>
            </div>

            <!-- Statistik -->
            <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                <h3 class="font-bold text-gray-900 mb-4">Statistik Akun</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-shopping-bag text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Total Pesanan</p>
                                <p class="font-bold text-gray-900">24</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Selesai</p>
                                <p class="font-bold text-gray-900">20</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-star text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Ulasan</p>
                                <p class="font-bold text-gray-900">15</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Profil -->
        <div class="lg:col-span-2">
            <!-- Section Informasi Pribadi -->
            <div id="section-info" class="profile-section bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-user mr-2 text-blue-600"></i>Informasi Pribadi
                    </h2>
                    <button id="editInfoBtn" onclick="toggleEditInfo()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </button>
                </div>

                <!-- View Mode -->
                <div id="infoView" class="space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="text-gray-900 font-medium mt-1" id="viewNama">John Doe</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900 font-medium mt-1" id="viewEmail">john.doe@example.com</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nomor Telepon</label>
                            <p class="text-gray-900 font-medium mt-1" id="viewTelepon">+62 812-3456-7890</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="text-gray-900 font-medium mt-1" id="viewTanggalLahir">15 Januari 1990</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
                            <p class="text-gray-900 font-medium mt-1" id="viewGender">Laki-laki</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Bergabung Sejak</label>
                            <p class="text-gray-900 font-medium mt-1">5 Desember 2024</p>
                        </div>
                    </div>
                </div>

                <!-- Edit Mode -->
                <div id="infoEdit" class="hidden">
                    <form onsubmit="saveInfo(event)">
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="editNama" value="John Doe"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="editEmail" value="john.doe@example.com"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="tel" id="editTelepon" value="+62 812-3456-7890"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" id="editTanggalLahir" value="1990-01-15"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                <select id="editGender"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="cancelEditInfo()"
                                class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Section Alamat Pengiriman -->
            <div id="section-alamat" class="profile-section hidden bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Alamat Pengiriman
                    </h2>
                    <button onclick="addAddress()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all">
                        <i class="fas fa-plus mr-2"></i>Tambah Alamat
                    </button>
                </div>

                <div id="addressList" class="space-y-4">
                    <!-- Alamat akan dimuat oleh JavaScript -->
                </div>
            </div>

            <!-- Section Keamanan -->
            <div id="section-keamanan" class="profile-section hidden bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-lock mr-2 text-blue-600"></i>Keamanan Akun
                </h2>

                <!-- Ubah Password -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ubah Password</h3>
                    <form onsubmit="changePassword(event)">
                        <div class="space-y-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Lama</label>
                                <input type="password" id="oldPassword"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                <input type="password" id="newPassword"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                <input type="password" id="confirmPassword"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                            <i class="fas fa-key mr-2"></i>Ubah Password
                        </button>
                    </form>
                </div>

                <!-- Verifikasi 2 Faktor -->
                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Verifikasi Dua Faktor</h3>
                    <div class="flex items-start space-x-4">
                        <div class="flex-1">
                            <p class="text-gray-600 mb-4">Tambahkan lapisan keamanan ekstra dengan mengaktifkan verifikasi
                                dua faktor</p>


                            <label class="inline-flex items-center cursor-pointer select-none">
                                <input type="checkbox" id="toggle2FA" class="sr-only peer" onchange="toggle2FA()">

                                <div class="relative w-12 h-7 bg-gray-300 rounded-full transition-all duration-300
                               peer-focus:ring-4 peer-focus:ring-blue-300
                               peer-checked:bg-blue-600
                               after:content-[''] after:absolute after:top-0.5 after:left-0.5 
                               after:w-6 after:h-6 after:bg-white after:rounded-full after:border after:border-gray-300
                               after:transition-all after:duration-300
                               peer-checked:after:translate-x-5">
                                </div>

                                <span class="ml-3 text-sm font-medium text-gray-900">
                                    Aktifkan Verifikasi 2 Faktor
                                </span>
                            </label>


                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Notifikasi -->
            <div id="section-notifikasi" class="profile-section hidden bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-bell mr-2 text-blue-600"></i>Pengaturan Notifikasi
                </h2>

                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Notifikasi Email</h3>
                        <div class="space-y-4">
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">Pesanan & Pengiriman</p>
                                    <p class="text-sm text-gray-500">Update status pesanan dan pengiriman</p>
                                </div>
                                <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">Promosi & Penawaran</p>
                                    <p class="text-sm text-gray-500">Dapatkan info promo dan diskon spesial</p>
                                </div>
                                <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">Newsletter</p>
                                    <p class="text-sm text-gray-500">Tips & berita seputar produk bearing</p>
                                </div>
                                <input type="checkbox" class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                            </label>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Notifikasi Push</h3>
                        <div class="space-y-4">
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">Update Pesanan</p>
                                    <p class="text-sm text-gray-500">Notifikasi real-time untuk pesanan Anda</p>
                                </div>
                                <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">Chat & Pesan</p>
                                    <p class="text-sm text-gray-500">Notifikasi untuk pesan dari penjual</p>
                                </div>
                                <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <button onclick="saveNotificationSettings()"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                        <i class="fas fa-save mr-2"></i>Simpan Pengaturan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data Dummy Alamat
        const addresses = [
            {
                id: 1,
                label: 'Rumah',
                recipient: 'John Doe',
                phone: '0812-3456-7890',
                address: 'Jl. Sudirman No. 123, RT 05/RW 03',
                district: 'Kelurahan Senayan',
                city: 'Jakarta Selatan',
                province: 'DKI Jakarta',
                postal: '12190',
                isDefault: true
            },
            {
                id: 2,
                label: 'Kantor',
                recipient: 'John Doe',
                phone: '0812-3456-7890',
                address: 'Jl. Thamrin No. 45, Gedung XYZ Lt. 5',
                district: 'Kelurahan Menteng',
                city: 'Jakarta Pusat',
                province: 'DKI Jakarta',
                postal: '10350',
                isDefault: false
            }
        ];

        // Tampilkan Section
        function showSection(section) {
            // Sembunyikan semua section
            document.querySelectorAll('.profile-section').forEach(el => el.classList.add('hidden'));

            // Tampilkan section yang dipilih
            document.getElementById('section-' + section).classList.remove('hidden');

            // Update menu aktif
            document.querySelectorAll('.profile-menu-item').forEach(item => {
                if (item.dataset.section === section) {
                    item.classList.remove('text-gray-700', 'hover:bg-gray-100');
                    item.classList.add('text-white', 'bg-blue-600');
                } else {
                    item.classList.remove('text-white', 'bg-blue-600');
                    item.classList.add('text-gray-700', 'hover:bg-gray-100');
                }
            });
        }

        // Toggle Edit Info
        function toggleEditInfo() {
            document.getElementById('infoView').classList.add('hidden');
            document.getElementById('infoEdit').classList.remove('hidden');
            document.getElementById('editInfoBtn').classList.add('hidden');
        }

        // Cancel Edit Info
        function cancelEditInfo() {
            document.getElementById('infoView').classList.remove('hidden');
            document.getElementById('infoEdit').classList.add('hidden');
            document.getElementById('editInfoBtn').classList.remove('hidden');
        }

        // Save Info
        function saveInfo(e) {
            e.preventDefault();

            // Ambil nilai dari form
            const nama = document.getElementById('editNama').value;
            const email = document.getElementById('editEmail').value;
            const telepon = document.getElementById('editTelepon').value;
            const tanggalLahir = document.getElementById('editTanggalLahir').value;
            const gender = document.getElementById('editGender').value;

            // Update tampilan
            document.getElementById('viewNama').textContent = nama;
            document.getElementById('viewEmail').textContent = email;
            document.getElementById('viewTelepon').textContent = telepon;
            document.getElementById('viewTanggalLahir').textContent = new Date(tanggalLahir).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            document.getElementById('viewGender').textContent = gender;

            // Update header
            document.getElementById('profileNameDisplay').textContent = nama;
            document.getElementById('profileEmailDisplay').textContent = email;

            cancelEditInfo();
            alert('Informasi profil berhasil diperbarui!');
        }

        // Change Avatar
        function changeAvatar() {
            alert('Fitur upload foto profil dalam pengembangan\n\nNanti akan ada dialog untuk memilih foto dari komputer');
        }

        // Render Alamat
        function renderAddresses() {
            const container = document.getElementById('addressList');
            container.innerHTML = addresses.map(addr => `
                                            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition-all ${addr.isDefault ? 'border-blue-500 bg-blue-50' : ''}">
                                                <div class="flex items-start justify-between mb-3">
                                                    <div class="flex items-center">
                                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full mr-2">
                                                            ${addr.label}
                                                        </span>
                                                        ${addr.isDefault ? '<span class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full">Utama</span>' : ''}
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <button onclick="editAddress(${addr.id})" class="text-blue-600 hover:text-blue-700">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button onclick="deleteAddress(${addr.id})" class="text-red-600 hover:text-red-700">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="space-y-1 text-sm">
                                                    <p class="font-bold text-gray-900">${addr.recipient}</p>
                                                    <p class="text-gray-600">${addr.phone}</p>
                                                    <p class="text-gray-700">${addr.address}</p>
                                                    <p class="text-gray-700">${addr.district}, ${addr.city}</p>
                                                    <p class="text-gray-700">${addr.province} ${addr.postal}</p>
                                                </div>
                                                ${!addr.isDefault ? `
                                                    <button onclick="setDefaultAddress(${addr.id})" class="mt-3 text-blue-600 hover:text-blue-700 text-sm font-medium">
                                                        <i class="fas fa-check-circle mr-1"></i>Jadikan Alamat Utama
                                                    </button>
                                                ` : ''}
                                            </div>
                                        `).join('');
        }

        // Add Address
        function addAddress() {
            alert('Form tambah alamat baru\n\nFitur dalam pengembangan');
        }

        // Edit Address
        function editAddress(id) {
            alert(`Edit alamat dengan ID: ${id}\n\nFitur dalam pengembangan`);
        }

        // Delete Address
        function deleteAddress(id) {
            if (confirm('Hapus alamat ini?')) {
                alert(`Alamat dengan ID ${id} dihapus\n\nFitur dalam pengembangan`);
            }
        }

        // Set Default Address
        function setDefaultAddress(id) {
            alert(`Alamat dengan ID ${id} dijadikan alamat utama\n\nFitur dalam pengembangan`);
        }

        // Change Password
        function changePassword(e) {
            e.preventDefault();
            const oldPass = document.getElementById('oldPassword').value;
            const newPass = document.getElementById('newPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;

            if (newPass !== confirmPass) {
                alert('Password baru dan konfirmasi password tidak sama!');
                return;
            }

            alert('Password berhasil diubah!\n\nFitur dalam pengembangan');
            e.target.reset();
        }

        // Toggle 2FA
        function toggle2FA() {
            const enabled = document.getElementById('toggle2FA').checked;
            alert(enabled ? 'Verifikasi 2 faktor diaktifkan' : 'Verifikasi 2 faktor dinonaktifkan');
        }

        // Save Notification Settings
        function saveNotificationSettings() {
            alert('Pengaturan notifikasi berhasil disimpan!');
        }

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function () {
            renderAddresses();
        });
    </script>
@endsection