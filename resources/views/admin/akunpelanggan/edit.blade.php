@extends('layout.admin.app')

@section('title', 'Edit Akun Pelanggan - Admin')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" onclick="window.history.back();"
                    class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Edit Akun Pelanggan</h1>
                <p class="text-blue-100">Ubah informasi pelanggan</p>
            </div>
            <div class="hidden md:block">
                <div class="w-18 h-18 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-edit text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Informasi Singkat -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="text-center mb-6">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&size=128&background=3b82f6&color=fff" alt="Avatar"
                        class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-blue-100">
                    <h3 class="text-xl font-bold text-gray-900">John Doe</h3>
                    <p class="text-sm text-gray-500">ID: #CUST-2024-001</p>
                    <span
                        class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                        <i class="fas fa-check-circle mr-1"></i>Aktif
                    </span>
                </div>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Bergabung:</span>
                        <span class="font-medium">15 Jan 2024</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Pesanan:</span>
                        <span class="font-medium">24 pesanan</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Belanja:</span>
                        <span class="font-medium">Rp 15.750.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Login Terakhir:</span>
                        <span class="font-medium">2 jam lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Edit -->
        <div class="lg:col-span-2">
            <form onsubmit="saveCustomer(event)">
                <!-- Informasi Pribadi -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-user mr-2 text-blue-600"></i>Informasi Pribadi
                    </h2>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" value="John Doe" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" value="john.doe@example.com" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" value="0812-3456-7890" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" value="1990-01-15"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <select
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="Laki-laki" selected>Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Akun <span
                                    class="text-red-500">*</span></label>
                            <select required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="active" selected>Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                                <option value="suspended">Ditangguhkan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Alamat Utama
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">Jl. Sudirman No. 123, RT 05/RW 03</textarea>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan</label>
                                <input type="text" value="Senayan"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                                <input type="text" value="Jakarta Selatan"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                <input type="text" value="DKI Jakarta"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                <input type="text" value="12190"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('adminakunpelangganindex') }}"
                        class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simpan pelanggan
        function saveCustomer(e) {
            e.preventDefault();

            if (confirm('Simpan perubahan data pelanggan?')) {
                alert('Data pelanggan berhasil diperbarui!\n\nFitur dalam pengembangan');
                // window.location.href = "{{ route('adminakunpelangganindex') }}";
            }
        }

        // Tangguhkan akun
        function suspendAccount() {
            if (confirm('Tangguhkan akun pelanggan ini?\n\nPelanggan tidak akan dapat login setelah ditangguhkan.')) {
                alert('Akun pelanggan berhasil ditangguhkan\n\nFitur dalam pengembangan');
            }
        }
    </script>
@endsection