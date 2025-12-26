<!-- Sidebar Mobile -->
<div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 -translate-x-full"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform lg:hidden">

    <!-- Header Sidebar -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 bg-primary-600">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <i class="fas fa-cog text-primary-600 text-xl"></i>
            </div>
            <div>
                <h1 class="text-white font-bold text-lg">Bearing Shop</h1>
                <p class="text-primary-200 text-xs">Premium Quality</p>
            </div>
        </div>
        <button @click="sidebarOpen = false" class="p-2 rounded-lg hover:bg-primary-700 text-white transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigasi Sidebar -->
    <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 8rem);">
        <!-- Home -->
        <a href="{{ route('pelanggan.home.index') }}"
            class="flex items-center px-3 py-3 rounded-lg transition-colors {{ request()->routeIs('pelanggan.home.index') ? 'bg-primary-100 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
            <i class="fas fa-home w-6 text-center"></i>
            <span class="ml-3">Beranda</span>
        </a>

        <!-- Produk -->
        <a href="{{ route('pelanggan.produk.index') }}"
            class="flex items-center px-3 py-3 rounded-lg transition-colors {{ request()->routeIs('pelanggan.produk.*') ? 'bg-primary-100 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
            <i class="fas fa-shopping-bag w-6 text-center"></i>
            <span class="ml-3">Produk</span>
        </a>

        <!-- Keranjang -->
        <a href="{{ route('pelanggan.keranjang.index') }}"
            class="flex items-center px-3 py-3 rounded-lg transition-colors {{ request()->routeIs('pelanggan.keranjang.*') ? 'bg-primary-100 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
            <i class="fas fa-shopping-cart w-6 text-center"></i>
            <span class="ml-3">Keranjang</span>
        </a>

        <!-- Pesanan/Pembelian -->
        <div x-data="{ open: {{ request()->routeIs('pelanggan.pembelian.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-3 rounded-lg transition-colors {{ request()->routeIs('pelanggan.pembelian.*') ? 'bg-primary-100 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                <div class="flex items-center">
                    <i class="fas fa-box w-6 text-center"></i>
                    <span class="ml-3">Pesanan</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="ml-9 mt-1 space-y-1">
                <a href="{{ route('pelanggan.pembelian.index') }}"
                    class="block px-3 py-2 text-sm rounded-lg {{ request()->routeIs('pelanggan.pembelian.index') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600' }}">
                    <i class="fas fa-history mr-2"></i>Riwayat Pesanan
                </a>
            </div>
        </div>

        <!-- Pembatas -->
        <div class="border-t border-gray-200 my-4"></div>

        <!-- Contact Us -->
        <a href="{{ route('pelanggan.kontak') }}"
            class="flex items-center px-3 py-3 rounded-lg transition-colors {{ request()->routeIs('pelanggan.kontak') ? 'bg-primary-100 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
            <i class="fas fa-envelope w-6 text-center"></i>
            <span class="ml-3">kontak</span>
        </a>
    </nav>

    <!-- Footer Sidebar -->
    @auth
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
    @else
    <div class="border-t border-gray-200 p-4">
        <a href="{{ route('login') }}"
            class="flex items-center w-full px-3 py-3 text-gray-700 rounded-lg hover:bg-primary-50 hover:text-primary-600 transition-colors">
            <i class="fas fa-sign-in-alt w-6 text-center"></i>
            <span class="ml-3">Login</span>
        </a>
    </div>
    @endauth
</div>

<!-- Overlay untuk sidebar mobile -->
<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden">
</div>