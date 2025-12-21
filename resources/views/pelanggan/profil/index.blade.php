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

    <!-- Alert Messages menggunakan komponen -->
    @if (session('success'))
        @include('pelanggan.component.alert', ['type' => 'success', 'slot' => session('success')])
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>Terjadi kesalahan:</strong>
            </div>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Sidebar Menu Profil -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md">
                <!-- Avatar -->
                <div class="relative bg-linear-to-br from-blue-700 to-blue-900 p-8 text-center rounded-t-xl overflow-hidden">
                    <div class="w-32 h-32 mx-auto mb-4 relative">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                class="w-full h-full rounded-full border-4 border-white shadow-lg object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128&background=3b82f6&color=fff"
                                alt="Avatar" class="w-full h-full rounded-full border-4 border-white shadow-lg object-cover">
                        @endif
                    </div>
                    <h2 class="text-xl font-bold text-white mb-1">{{ $user->name }}</h2>
                    <p class="text-blue-100 text-sm">{{ $user->email }}</p>
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

            <!-- Info Singkat -->
            <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                <h3 class="font-bold text-gray-900 mb-4">Info Akun</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Telepon:</span>
                        <span class="font-medium">{{ $user->telepon ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Bergabung:</span>
                        <span class="font-medium">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Alamat:</span>
                        <span class="font-medium">{{ $alamats->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Profil -->
        <div class="lg:col-span-2">
            <!-- Section Informasi Pribadi -->
            <div id="section-info" class="profile-section bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-user mr-2 text-blue-600"></i>Informasi Pribadi
                </h2>

                <form action="{{ route('pelanggan.profil.update-pribadi') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" name="telepon" value="{{ old('telepon', $user->telepon) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('telepon') border-red-500 @enderror"
                                placeholder="08xx-xxxx-xxxx">
                            @error('telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>

                <!-- Upload Avatar -->
                <div class="mt-8 pt-8 border-t">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Foto Profil</h3>
                    <form action="{{ route('pelanggan.profil.update-avatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <input type="file" name="avatar" accept="image/jpeg,image/png,image/jpg" required
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('avatar') border-red-500 @enderror">
                            <button type="submit"
                                class="px-4 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition-all">
                                <i class="fas fa-upload mr-2"></i>Upload
                            </button>
                        </div>
                        @error('avatar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-2">Format: jpeg, png, jpg. Maksimal 2MB</p>
                    </form>
                </div>
            </div>

            <!-- Section Alamat Pengiriman -->
            <div id="section-alamat" class="profile-section hidden bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Alamat Pengiriman
                    </h2>
                    <button type="button" onclick="document.getElementById('formAlamatBaru').classList.toggle('hidden')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all">
                        <i class="fas fa-plus mr-2"></i>Tambah Alamat
                    </button>
                </div>

                <!-- Form Tambah Alamat -->
                <div id="formAlamatBaru" class="hidden mb-6 p-4 bg-gray-50 rounded-lg border">
                    <h3 class="font-bold text-gray-900 mb-4">Tambah Alamat Baru</h3>
                    <form action="{{ route('pelanggan.alamat.store') }}" method="POST">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Label Alamat <span class="text-red-500">*</span></label>
                                <input type="text" name="label" value="{{ old('label') }}" placeholder="Contoh: Rumah, Kantor" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('label') border-red-500 @enderror">
                                @error('label')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penerima <span class="text-red-500">*</span></label>
                                <input type="text" name="penerima" value="{{ old('penerima') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('penerima') border-red-500 @enderror">
                                @error('penerima')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Telepon <span class="text-red-500">*</span></label>
                                <input type="tel" name="telepon" value="{{ old('telepon') }}" required placeholder="08xx-xxxx-xxxx"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('telepon') border-red-500 @enderror">
                                @error('telepon')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi <span class="text-red-500">*</span></label>
                                <input type="text" name="provinsi" value="{{ old('provinsi') }}" required placeholder="Contoh: Jawa Barat"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('provinsi') border-red-500 @enderror">
                                @error('provinsi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten <span class="text-red-500">*</span></label>
                                <input type="text" name="kota" value="{{ old('kota') }}" required placeholder="Contoh: Bandung"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kota') border-red-500 @enderror">
                                @error('kota')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" required placeholder="Contoh: Coblong"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kecamatan') border-red-500 @enderror">
                                @error('kecamatan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos <span class="text-red-500">*</span></label>
                                <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" required placeholder="Contoh: 40132"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kode_pos') border-red-500 @enderror">
                                @error('kode_pos')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat_lengkap" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW, dll"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('alamat_lengkap') border-red-500 @enderror">{{ old('alamat_lengkap') }}</textarea>
                                @error('alamat_lengkap')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="document.getElementById('formAlamatBaru').classList.add('hidden')"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                <i class="fas fa-save mr-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Daftar Alamat -->
                <div class="space-y-4">
                    @forelse ($alamats as $alamat)
                        <div class="border rounded-lg p-4 {{ $alamat->is_default ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full mr-2">
                                        {{ $alamat->label ?? 'Alamat' }}
                                    </span>
                                    @if ($alamat->is_default)
                                        <span class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full">Utama</span>
                                    @endif
                                </div>
                                <div class="flex space-x-2">
                                    @if (!$alamat->is_default)
                                        <form action="{{ route('pelanggan.alamat.set-default', $alamat->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-blue-600 hover:text-blue-700 text-sm">
                                                <i class="fas fa-check-circle"></i> Jadikan Utama
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('pelanggan.alamat.destroy', $alamat->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Hapus alamat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="space-y-1 text-sm">
                                <p class="font-bold text-gray-900">{{ $alamat->penerima }}</p>
                                <p class="text-gray-600">{{ $alamat->telepon }}</p>
                                <p class="text-gray-700">{{ $alamat->alamat_lengkap }}</p>
                                <p class="text-gray-600">{{ $alamat->kecamatan }}, {{ $alamat->kota }}</p>
                                <p class="text-gray-500">{{ $alamat->provinsi }} {{ $alamat->kode_pos }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-map-marker-alt text-4xl mb-2"></i>
                            <p>Belum ada alamat tersimpan</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Section Keamanan -->
            <div id="section-keamanan" class="profile-section hidden bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-lock mr-2 text-blue-600"></i>Keamanan Akun
                </h2>

                <!-- Ubah Password -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ubah Password</h3>
                    <form action="{{ route('pelanggan.profil.update-password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Lama <span class="text-red-500">*</span></label>
                                <input type="password" name="current_password" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('current_password') border-red-500 @enderror">
                                @error('current_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru <span class="text-red-500">*</span></label>
                                <input type="password" name="password" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                                    placeholder="Minimal 8 karakter">
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                            <i class="fas fa-key mr-2"></i>Ubah Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Section Notifikasi -->
            <div id="section-notifikasi" class="profile-section hidden bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-bell mr-2 text-blue-600"></i>Pengaturan Notifikasi
                </h2>

                <form action="{{ route('pelanggan.profil.update-notifikasi') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4 mb-6">
                        <label class="flex items-center justify-between cursor-pointer p-4 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">Notifikasi Email</p>
                                <p class="text-sm text-gray-500">Terima pemberitahuan via email</p>
                            </div>
                            <input type="checkbox" name="notifikasi_email" value="1" 
                                {{ $user->notifikasi_email ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                        </label>
                        <label class="flex items-center justify-between cursor-pointer p-4 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">Update Pesanan</p>
                                <p class="text-sm text-gray-500">Notifikasi status pesanan dan pengiriman</p>
                            </div>
                            <input type="checkbox" name="notifikasi_order" value="1"
                                {{ $user->notifikasi_order ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                        </label>
                        <label class="flex items-center justify-between cursor-pointer p-4 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">Promosi & Penawaran</p>
                                <p class="text-sm text-gray-500">Info promo dan diskon spesial</p>
                            </div>
                            <input type="checkbox" name="notifikasi_promo" value="1"
                                {{ $user->notifikasi_promo ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                        </label>
                    </div>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                        <i class="fas fa-save mr-2"></i>Simpan Pengaturan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
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
    </script>
@endsection