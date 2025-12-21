<!-- Sidebar Mobile -->
<div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 -translate-x-full"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform lg:hidden">

    <!-- Header Sidebar -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 bg-blue-600">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <i class="fas fa-cog text-blue-600 text-xl"></i>
            </div>
            <div>
                <h1 class="text-white font-bold text-lg">Admin Panel</h1>
                <p class="text-blue-200 text-xs">Bearing Shop</p>
            </div>
        </div>
        <button @click="sidebarOpen = false" class="p-2 rounded-lg hover:bg-blue-700 text-white transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigasi Sidebar -->
    <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 8rem);">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard.index') }}"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.dashboard.*') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="fas fa-home w-6 text-center"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        <!-- Produk -->
        <div x-data="{ open: {{ request()->routeIs('admin.produk.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.produk.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="flex items-center">
                    <i class="fas fa-box w-6 text-center"></i>
                    <span class="ml-3">Produk</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="ml-9 mt-1 space-y-1">
                <a href="{{ route('admin.produk.index') }}"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.produk.index') ? 'bg-blue-100 text-blue-600' : '' }}">
                    <i class="fas fa-list mr-2"></i>Daftar Produk
                </a>
                <a href="{{ route('admin.produk.create') }}"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.produk.create') ? 'bg-blue-100 text-blue-600' : '' }}">
                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                </a>
            </div>
        </div>

        {{-- Kategori --}}
        <div x-data="{ open: {{ request()->routeIs('admin.kategori.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.kategori.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="flex items-center">
                    <i class="fas fa-tags w-6 text-center"></i>
                    <span class="ml-3">Kategori</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="ml-9 mt-1 space-y-1">
                <a href="{{ route('admin.kategori.index') }}"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.kategori.index') ? 'bg-blue-100 text-blue-600' : '' }}">
                    <i class="fas fa-list mr-2"></i>Daftar Kategori
                </a>
                <a href="{{ route('admin.kategori.create') }}"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.kategori.create') ? 'bg-blue-100 text-blue-600' : '' }}">
                    <i class="fas fa-plus mr-2"></i>Tambah Kategori
                </a>
            </div>
        </div>

        {{-- Merk --}}
        <div x-data="{ open: {{ request()->routeIs('admin.merk.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.merk.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="flex items-center">
                    <i class="fas fa-tag w-6 text-center"></i>
                    <span class="ml-3">Merk</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="ml-9 mt-1 space-y-1">
                <a href="{{ route('admin.merk.index') }}"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.merk.index') ? 'bg-blue-100 text-blue-600' : '' }}">
                    <i class="fas fa-list mr-2"></i>Daftar Merk
                </a>
                <a href="{{ route('admin.merk.create') }}"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.merk.create') ? 'bg-blue-100 text-blue-600' : '' }}">
                    <i class="fas fa-plus mr-2"></i>Tambah Merk
                </a>
            </div>
        </div>

        <!-- Pembelian -->
        <a href="{{ route('admin.pembelian.index') }}"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.pembelian.*') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="fas fa-shopping-cart w-6 text-center"></i>
            <span class="ml-3">Pembelian</span>
        </a>

        <!-- Akun Pelanggan -->
        <a href="{{ route('admin.akunpelanggan.index') }}"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.akunpelanggan.*') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="fas fa-users w-6 text-center"></i>
            <span class="ml-3">Pelanggan</span>
        </a>

        <!-- Pembatas -->
        <div class="border-t border-gray-200 my-4"></div>

        <!-- Label Section Pengaturan -->
        <div class="px-3 mb-2">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pengaturan</span>
        </div>

        <!-- Halaman Statis -->
        <div x-data="{ open: {{ request()->routeIs('admin.tentang-kami.*') || request()->routeIs('admin.kontak.*') || request()->routeIs('admin.kebijakan-privasi.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.tentang-kami.*') || request()->routeIs('admin.kontak.*') || request()->routeIs('admin.kebijakan-privasi.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="flex items-center">
                    <i class="fas fa-file-alt w-6 text-center"></i>
                    <span class="ml-3">Halaman</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="ml-9 mt-1 space-y-1">
                <a href="{{ route('admin.tentang-kami.index') }}"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.tentang-kami.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                    <i class="fas fa-info-circle mr-2"></i>Tentang Kami
                </a>
                <a href="{{ route('admin.kontak.index') }}"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.kontak.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                    <i class="fas fa-phone mr-2"></i>Kontak
                </a>
                <a href="{{ route('admin.kebijakan-privasi.index') }}"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.kebijakan-privasi.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                    <i class="fas fa-shield-alt mr-2"></i>Kebijakan Privasi
                </a>
            </div>
        </div>

        <!-- Profil -->
        <a href="{{ route('admin.profil.index') }}"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.profil.*') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="fas fa-user w-6 text-center"></i>
            <span class="ml-3">Profil</span>
        </a>
    </nav>

    <!-- Footer Sidebar -->
    <div class="border-t border-gray-200 p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors">
                <i class="fas fa-sign-out-alt w-6 text-center"></i>
                <span class="ml-3">Logout</span>
            </button>
        </form>
    </div>
</div>

<!-- Overlay untuk sidebar mobile -->
<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden">
</div>