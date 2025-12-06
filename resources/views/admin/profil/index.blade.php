@extends('layout.admin.app')

@section('title', 'Profil Admin - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Profil Admin</h1>
                <p class="text-blue-100">Kelola informasi profil administrator</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-shield text-blue-800 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Sidebar Menu Profil -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md">
                <!-- Avatar -->
                <div class="bg-linear-to-br from-blue-700 to-blue-900 p-8 text-center rounded-xl">
                    <div class="w-32 h-32 mx-auto mb-4 relative">
                        <img id="profileAvatar"
                            src="/assets/profil.jpg"
                            alt="Avatar" class="w-full h-full rounded-full border-4 border-white shadow-lg object-cover">
                        <button onclick="changeAvatar()"
                            class="absolute bottom-0 right-0 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-gray-100 transition-all">
                            <i class="fas fa-camera text-blue-600"></i>
                        </button>
                    </div>
                    <p class="text-blue-100 text-sm" id="profileEmailDisplay">admin@bearingshop.com</p>
                    <span
                        class="inline-block text-white text-xs font-semibold rounded-full">
                        Super Administrator
                    </span>
                </div>

                <!-- Menu -->
                <div class="p-2">
                    <button onclick="showSection('info')" data-section="info"
                        class="profile-menu-item w-full flex items-center px-4 py-3 rounded-lg text-left font-medium text-white bg-blue-600 mb-1 transition-all">
                        <i class="fas fa-user w-5 mr-3"></i>
                        <span>Informasi Pribadi</span>
                    </button>
                    <button onclick="showSection('keamanan')" data-section="keamanan"
                        class="profile-menu-item w-full flex items-center px-4 py-3 rounded-lg text-left font-medium text-gray-700 hover:bg-gray-100 mb-1 transition-all">
                        <i class="fas fa-lock w-5 mr-3"></i>
                        <span>Keamanan</span>
                    </button>
                    <button onclick="showSection('role')" data-section="role"
                        class="profile-menu-item w-full flex items-center px-4 py-3 rounded-lg text-left font-medium text-gray-700 hover:bg-gray-100 mb-1 transition-all">
                        <i class="fas fa-user-tag w-5 mr-3"></i>
                        <span>Role & Akses</span>
                    </button>
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
                            <p class="text-gray-900 font-medium mt-1" id="viewNama">Admin User</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900 font-medium mt-1" id="viewEmail">admin@bearingshop.com</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nomor Telepon</label>
                            <p class="text-gray-900 font-medium mt-1" id="viewTelepon">+62 811-1234-5678</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Role</label>
                            <p class="text-gray-900 font-medium mt-1">Super Administrator</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Department</label>
                            <p class="text-gray-900 font-medium mt-1" id="viewDepartment">IT & Operations</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Bergabung Sejak</label>
                            <p class="text-gray-900 font-medium mt-1">1 Januari 2024</p>
                        </div>
                    </div>

                    <!-- Info Tambahan -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="font-bold text-gray-900 mb-3">Informasi Tambahan</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Employee ID</label>
                                <p class="text-gray-900 font-medium mt-1">EMP-2024-001</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Status</label>
                                <span
                                    class="inline-block mt-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full">
                                    Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Mode -->
                <div id="infoEdit" class="hidden">
                    <form onsubmit="saveInfo(event)">
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="editNama" value="Admin User"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="editEmail" value="admin@bearingshop.com"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="tel" id="editTelepon" value="+62 811-1234-5678"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                                <input type="text" id="editDepartment" value="IT & Operations"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                                <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter dengan kombinasi huruf, angka, dan
                                    simbol</p>
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
                <div class="border-t border-gray-200 pt-8 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Verifikasi Dua Faktor</h3>
                    <div class="flex items-start space-x-4">
                        <div class="flex-1">
                            <p class="text-gray-600 mb-4">Tingkatkan keamanan akun admin dengan verifikasi dua faktor (Wajib
                                untuk admin)</p>
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
                            <p class="text-xs text-gray-500 mt-2 ml-14">Menggunakan Google Authenticator</p>
                        </div>
                    </div>
                </div>

                <!-- Session Management -->
                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Manajemen Sesi Login</h3>
                    <p class="text-gray-600 mb-4">Perangkat yang sedang login dengan akun Anda</p>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-laptop text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Windows PC - Chrome</p>
                                    <p class="text-xs text-gray-500">Jakarta, Indonesia • Aktif sekarang</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                Perangkat ini
                            </span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-mobile-alt text-gray-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">iPhone 13 - Safari</p>
                                    <p class="text-xs text-gray-500">Jakarta, Indonesia • 2 jam lalu</p>
                                </div>
                            </div>
                            <button onclick="logoutDevice('mobile')"
                                class="text-red-600 hover:text-red-700 text-sm font-medium">
                                Logout
                            </button>
                        </div>
                    </div>
                    <button onclick="logoutAllDevices()"
                        class="mt-4 px-4 py-2 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout dari Semua Perangkat
                    </button>
                </div>
            </div>

            <!-- Section Role & Akses -->
            <div id="section-role" class="profile-section hidden bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-user-tag mr-2 text-blue-600"></i>Role & Hak Akses
                </h2>

                <!-- Current Role -->
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Role Saat Ini</h3>
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold text-blue-900">Super Administrator</p>
                                <p class="text-sm text-blue-700 mt-1">Akses penuh ke semua fitur sistem</p>
                            </div>
                            <span class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg">
                                Full Access
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Permissions -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Hak Akses</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-box text-blue-600 w-6 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Manajemen Produk</p>
                                    <p class="text-xs text-gray-500">Create, Read, Update, Delete</p>
                                </div>
                            </div>
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-shopping-cart text-green-600 w-6 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Manajemen Pesanan</p>
                                    <p class="text-xs text-gray-500">Read, Update Status</p>
                                </div>
                            </div>
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-users text-purple-600 w-6 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Manajemen Pelanggan</p>
                                    <p class="text-xs text-gray-500">Read, Update, Suspend</p>
                                </div>
                            </div>
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-chart-line text-orange-600 w-6 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Laporan & Analitik</p>
                                    <p class="text-xs text-gray-500">View All Reports</p>
                                </div>
                            </div>
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-cog text-gray-600 w-6 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Pengaturan Sistem</p>
                                    <p class="text-xs text-gray-500">Full Configuration Access</p>
                                </div>
                            </div>
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data Dummy Log Aktivitas
        const activities = [
            {
                action: 'Login ke sistem',
                icon: 'sign-in-alt',
                color: 'blue',
                time: '2 jam lalu',
                details: 'Login dari Chrome di Windows PC'
            },
            {
                action: 'Update produk SKF 6205',
                icon: 'edit',
                color: 'green',
                time: '3 jam lalu',
                details: 'Mengubah harga dari Rp 125.000 ke Rp 120.000'
            },
            {
                action: 'Approve pesanan #ORD-2024-015',
                icon: 'check-circle',
                color: 'purple',
                time: '4 jam lalu',
                details: 'Pesanan disetujui dan diteruskan ke pengiriman'
            },
            {
                action: 'Tambah produk baru',
                icon: 'plus-circle',
                color: 'green',
                time: '5 jam lalu',
                details: 'Menambahkan NSK 6208-ZZ ke katalog'
            },
            {
                action: 'Hapus produk FAG 6210',
                icon: 'trash',
                color: 'red',
                time: '1 hari lalu',
                details: 'Produk dihapus karena tidak tersedia'
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
            const department = document.getElementById('editDepartment').value;

            // Update tampilan
            document.getElementById('viewNama').textContent = nama;
            document.getElementById('viewEmail').textContent = email;
            document.getElementById('viewTelepon').textContent = telepon;
            document.getElementById('viewDepartment').textContent = department;

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

            if (newPass.length < 8) {
                alert('Password harus minimal 8 karakter!');
                return;
            }

            alert('Password berhasil diubah!\n\nFitur dalam pengembangan');
            e.target.reset();
        }

        // Logout Device
        function logoutDevice(device) {
            if (confirm('Logout dari perangkat ini?')) {
                alert(`Berhasil logout dari ${device}\n\nFitur dalam pengembangan`);
            }
        }

        // Logout All Devices
        function logoutAllDevices() {
            if (confirm('Logout dari semua perangkat?\n\nAnda akan tetap login di perangkat ini.')) {
                alert('Berhasil logout dari semua perangkat lain\n\nFitur dalam pengembangan');
            }
        }

        // Render Activity Log
        function renderActivityLog() {
            const container = document.getElementById('activityLog');
            container.innerHTML = activities.map(activity => `
                                <div class="flex items-start p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                                    <div class="w-10 h-10 bg-${activity.color}-100 rounded-lg flex items-center justify-center mr-4 shrink-0">
                                        <i class="fas fa-${activity.icon} text-${activity.color}-600"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-gray-900">${activity.action}</p>
                                        <p class="text-sm text-gray-600 mt-1">${activity.details}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            <i class="fas fa-clock mr-1"></i>${activity.time}
                                        </p>
                                    </div>
                                </div>
                            `).join('');
        }

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function () {
            renderActivityLog();
        });
    </script>
@endsection