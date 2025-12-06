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
        <a href="#" onclick="alert('Fitur dashboard admin dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-home w-6 text-center"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        <!-- Produk -->
        <div x-data="{ open: false }">
            <button onclick="alert('Fitur manajemen produk dalam pengembangan'); return false;"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                <div class="flex items-center">
                    <i class="fas fa-box w-6 text-center"></i>
                    <span class="ml-3">Produk</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="ml-9 mt-1 space-y-1">
                <a href="#"
                    onclick="alert('Fitur daftar produk dalam pengembangan'); sidebarOpen = false; return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-list mr-2"></i>Daftar Produk
                </a>
                <a href="#"
                    onclick="alert('Fitur tambah produk dalam pengembangan'); sidebarOpen = false; return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                </a>
            </div>
        </div>

        {{-- kategori --}}
        <div x-data="{ open: false }">
            <button onclick="alert('Fitur manajemen kategori dalam pengembangan'); return false;"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                <div class="flex items-center">
                    <i class="fas fa-tags w-6 text-center"></i>
                    <span class="ml-3">Kategori</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="ml-9 mt-1 space-y-1">
                <a href="#"
                    onclick="alert('Fitur daftar kategori dalam pengembangan'); sidebarOpen = false; return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-list mr-2"></i>Daftar Kategori
                </a>
                <a href="#"
                    onclick="alert('Fitur tambah kategori dalam pengembangan'); sidebarOpen = false; return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-plus mr-2"></i>Tambah Kategori
                </a>
            </div>
        </div>

        {{-- merk --}}
        <div x-data="{ open: false }">
            <button onclick="alert('Fitur manajemen merk dalam pengembangan'); return false;"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                <div class="flex items-center">
                    <i class="fas fa-tag w-6 text-center"></i>
                    <span class="ml-3">Merk</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="ml-9 mt-1 space-y-1">
                <a href="#"
                    onclick="alert('Fitur daftar merk dalam pengembangan'); sidebarOpen = false; return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-list mr-2"></i>Daftar Merk
                </a>
                <a href="#"
                    onclick="alert('Fitur tambah merk dalam pengembangan'); sidebarOpen = false; return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-plus mr-2"></i>Tambah Merk
                </a>
            </div>
        </div>

        <!-- Pembelian -->
        <a href="#" onclick="alert('Fitur manajemen pembelian dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-shopping-cart w-6 text-center"></i>
            <span class="ml-3">Pembelian</span>
            <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">5</span>
        </a>

        <!-- Akun Pelanggan -->
        <a href="#" onclick="alert('Fitur manajemen pelanggan dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-users w-6 text-center"></i>
            <span class="ml-3">Pelanggan</span>
        </a>

        <!-- Pembatas -->
        <div class="border-t border-gray-200 my-4"></div>

        <!-- Laporan -->
        <a href="#" onclick="alert('Fitur laporan dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-chart-bar w-6 text-center"></i>
            <span class="ml-3">Laporan</span>
        </a>

        <!-- Pengaturan -->
        <a href="#" onclick="alert('Fitur pengaturan dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-cog w-6 text-center"></i>
            <span class="ml-3">Pengaturan</span>
        </a>
    </nav>

    <!-- Footer Sidebar -->
    <div class="border-t border-gray-200 p-4">
        <form onsubmit="alert('Fitur logout dalam pengembangan'); return false;">
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