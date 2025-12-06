<!-- Navigasi Atas -->
<header class="bg-white shadow-sm z-10 border-b border-gray-200">
    <div class="flex items-center justify-between h-16 px-4 lg:px-8">
        <!-- Tombol menu mobile & Bar Pencarian -->
        <div class="flex items-center space-x-4 flex-1">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                <i class="fas fa-bars text-gray-600"></i>
            </button>

            <!-- Bar Pencarian -->
            <div class="flex-1 max-w-2xl">
                <form onsubmit="alert('Fitur pencarian dalam pengembangan'); return false;">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari produk bearing..."
                            class="w-full px-4 py-2 pl-10 pr-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </form>
            </div>
        </div>

        <!-- Ikon Sisi Kanan -->
        <div class="flex items-center space-x-4">
            <!-- Tombol Keranjang -->
            <a href="#" onclick="alert('Fitur keranjang dalam pengembangan'); return false;"
                class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i class="fas fa-shopping-cart text-gray-600 text-lg"></i>
                <span
                    class="absolute -top-1 -right-1 w-5 h-5 bg-orange-500 text-white text-xs rounded-full flex items-center justify-center font-medium">3</span>
            </a>

            <!-- Notifikasi -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bell text-gray-600 text-lg"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Dropdown Notifikasi -->
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-200">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900">Notifikasi</h3>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                            <div class="flex items-start">
                                <div class="shrink-0">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm text-gray-900">Pesanan Anda telah dikirim</p>
                                    <p class="text-xs text-gray-500 mt-1">2 jam yang lalu</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <div class="flex items-start">
                                <div class="shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-tag text-blue-600"></i>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm text-gray-900">Promo spesial untuk Anda!</p>
                                    <p class="text-xs text-gray-500 mt-1">5 jam yang lalu</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="px-4 py-3 border-t border-gray-200 text-center">
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Lihat semua notifikasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profil Pengguna -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-semibold">P</span>
                    </div>
                    <span class="hidden md:block text-sm font-medium text-gray-700">Pelanggan Demo</span>
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </button>

                <!-- Dropdown Profil -->
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-200">

                    <div class="px-4 py-3 border-b border-gray-200">
                        <p class="text-sm font-medium text-gray-900">Pelanggan Demo</p>
                        <p class="text-xs text-gray-500">pelanggan@demo.com</p>
                    </div>
                    <a href="#" onclick="alert('Fitur profil dalam pengembangan'); return false;"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-2 text-gray-400"></i>Profil Saya
                    </a>
                    <a href="#" onclick="alert('Fitur pesanan dalam pengembangan'); return false;"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-box mr-2 text-gray-400"></i>Pesanan Saya
                    </a>
                    <a href="#" onclick="alert('Fitur keranjang dalam pengembangan'); return false;"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-shopping-cart mr-2 text-gray-400"></i>Keranjang
                    </a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <form onsubmit="alert('Fitur logout dalam pengembangan'); return false;">
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>