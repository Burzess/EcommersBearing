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
                <h1 class="text-white font-bold text-lg">Bearing Shop</h1>
                <p class="text-blue-200 text-xs">Premium Quality</p>
            </div>
        </div>
        <button @click="sidebarOpen = false" class="p-2 rounded-lg hover:bg-blue-700 text-white transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigasi Sidebar -->
    <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 8rem);">
        <!-- Dashboard -->
        <a href="#" onclick="alert('Fitur dashboard dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-home w-6 text-center"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        <!-- Produk -->
        <a href="#" onclick="alert('Fitur katalog produk dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-shopping-bag w-6 text-center"></i>
            <span class="ml-3">Produk</span>
        </a>

        <!-- Keranjang -->
        <a href="#" onclick="alert('Fitur keranjang dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-shopping-cart w-6 text-center"></i>
            <span class="ml-3">Keranjang</span>
            <span class="ml-auto bg-orange-500 text-white text-xs px-2 py-1 rounded-full">3</span>
        </a>

        <!-- Pembelian -->
        <div x-data="{ open: false }">
            <button onclick="alert('Fitur pembelian dalam pengembangan'); return false;"
                class="flex items-center justify-between w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                <div class="flex items-center">
                    <i class="fas fa-box w-6 text-center"></i>
                    <span class="ml-3">Pesanan</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="ml-9 mt-1 space-y-1">
                <a href="#"
                    onclick="alert('Fitur riwayat pesanan dalam pengembangan'); sidebarOpen = false; return false;"
                    class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-history mr-2"></i>Riwayat Pesanan
                </a>
            </div>
        </div>

        <!-- Pembatas -->
        <div class="border-t border-gray-200 my-4"></div>

        <!-- Profil -->
        <a href="#" onclick="alert('Fitur profil dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-user w-6 text-center"></i>
            <span class="ml-3">Profil</span>
        </a>

        <!-- Kontak -->
        <a href="#" onclick="alert('Fitur kontak dalam pengembangan'); sidebarOpen = false; return false;"
            class="flex items-center px-3 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-envelope w-6 text-center"></i>
            <span class="ml-3">Kontak</span>
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