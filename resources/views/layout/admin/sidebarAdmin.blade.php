<!-- Sidebar Desktop -->
<aside x-show="!sidebarOpen || window.innerWidth >= 1024"
    class="hidden lg:block bg-white shadow-lg border-r border-gray-200 transition-all duration-300"
    :class="{ 'lg:w-64': !sidebarCollapsed, 'lg:w-20': sidebarCollapsed }">

    <!-- Header Sidebar -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 bg-blue-600">
        <div class="flex items-center space-x-3" :class="{ 'hidden': sidebarCollapsed }">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <i class="fas fa-cog text-blue-600 text-xl"></i>
            </div>
            <div>
                <h1 class="text-white font-bold text-lg">Admin Panel</h1>
                <p class="text-blue-200 text-xs">Bearing Shop</p>
            </div>
        </div>
        <button @click="sidebarCollapsed = !sidebarCollapsed"
            class="p-2 rounded-lg hover:bg-blue-700 text-white transition-colors">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Navigasi Sidebar -->
    <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 8rem);">
        <!-- Dashboard -->
        <a href="#" onclick="alert('Fitur dashboard admin dalam pengembangan'); return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-home w-6 text-center"></i>
            <span :class="{ 'hidden': sidebarCollapsed }" class="ml-3">Dashboard</span>
        </a>

        <!-- Produk -->
        <div x-data="{ open: false }">
            <button onclick="alert('Fitur manajemen produk dalam pengembangan'); return false;"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                <div class="flex items-center">
                    <i class="fas fa-box w-6 text-center"></i>
                    <span :class="{ 'hidden': sidebarCollapsed }" class="ml-3">Produk</span>
                </div>
                <i :class="{ 'hidden': sidebarCollapsed }" class="fas fa-chevron-down text-xs transition-transform"
                    :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse :class="{ 'hidden': sidebarCollapsed }" class="ml-9 mt-1 space-y-1">
                <a href="#" onclick="alert('Fitur daftar produk dalam pengembangan'); return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-list mr-2"></i>Daftar Produk
                </a>
                <a href="#" onclick="alert('Fitur tambah produk dalam pengembangan'); return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                </a>
            </div>
        </div>

        {{-- kategori --}}
        <div x-data="{ open: false }">
            <button onclick="alert('Fitur manajemen kategori dalam pengembangan'); return false;"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                <div class="flex items-center">
                    <i class="fas fa-tags w-6 text-center"></i>
                    <span :class="{ 'hidden': sidebarCollapsed }" class="ml-3">Kategori</span>
                </div>
                <i :class="{ 'hidden': sidebarCollapsed }" class="fas fa-chevron-down text-xs transition-transform"
                    :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse :class="{ 'hidden': sidebarCollapsed }" class="ml-9 mt-1 space-y-1">
                <a href="#" onclick="alert('Fitur daftar kategori dalam pengembangan'); return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-list mr-2"></i>Daftar Kategori
                </a>
                <a href="#" onclick="alert('Fitur tambah kategori dalam pengembangan'); return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-plus mr-2"></i>Tambah Kategori
                </a>
            </div>
        </div>

        {{-- merk --}}
        <div x-data="{ open: false }">
            <button onclick="alert('Fitur manajemen merk dalam pengembangan'); return false;"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                <div class="flex items-center">
                    <i class="fas fa-tags w-6 text-center"></i>
                    <span :class="{ 'hidden': sidebarCollapsed }" class="ml-3">Merk</span>
                </div>
                <i :class="{ 'hidden': sidebarCollapsed }" class="fas fa-chevron-down text-xs transition-transform"
                    :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse :class="{ 'hidden': sidebarCollapsed }" class="ml-9 mt-1 space-y-1">
                <a href="#" onclick="alert('Fitur daftar merk dalam pengembangan'); return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-list mr-2"></i>Daftar Merk
                </a>
                <a href="#" onclick="alert('Fitur tambah merk dalam pengembangan'); return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-plus mr-2"></i>Tambah Merk
                </a>
            </div>
        </div>

        <!-- Pembelian -->
        <a href="#" onclick="alert('Fitur manajemen pembelian dalam pengembangan'); return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-shopping-cart w-6 text-center"></i>
            <span :class="{ 'hidden': sidebarCollapsed }" class="ml-3">Pembelian</span>
            <span :class="{ 'hidden': sidebarCollapsed }"
                class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">5</span>
        </a>

        <!-- Akun Pelanggan -->
        <a href="#" onclick="alert('Fitur manajemen pelanggan dalam pengembangan'); return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-users w-6 text-center"></i>
            <span :class="{ 'hidden': sidebarCollapsed }" class="ml-3">Pelanggan</span>
        </a>

        <!-- Pembatas -->
        <div :class="{ 'hidden': sidebarCollapsed }" class="border-t border-gray-200 my-4"></div>

        <!-- Laporan -->
        <a href="#" onclick="alert('Fitur laporan dalam pengembangan'); return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-chart-bar w-6 text-center"></i>
            <span :class="{ 'hidden': sidebarCollapsed }" class="ml-3">Laporan</span>
        </a>

        <!-- Pengaturan -->
        <a href="#" onclick="alert('Fitur pengaturan dalam pengembangan'); return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-cog w-6 text-center"></i>
            <span :class="{ 'hidden': sidebarCollapsed }" class="ml-3">Pengaturan</span>
        </a>
    </nav>

    <!-- Footer Sidebar -->
    <div class="border-t border-gray-200 p-4">
        <form onsubmit="alert('Fitur logout dalam pengembangan'); return false;">
            <button type="submit"
                class="flex items-center w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors">
                <i class="fas fa-sign-out-alt w-6 text-center"></i>
                <span :class="{ 'hidden': sidebarCollapsed }" class="ml-3">Logout</span>
            </button>
        </form>
    </div>
</aside>