@extends('layout.admin.app')

@section('title', 'Manajemen Kategori')

@section('content')
    <!-- Header -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Manajemen Kategori</h1>
                <p class="text-blue-100">Kelola kategori produk bearing Anda</p>
            </div>
            <div class="md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-layer-group text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Kategori</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $kategoris->total() }}</h3>
                </div>
                <div class="bg-blue-100 p-4 rounded-lg">
                    <i class="fas fa-layer-group text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Kategori Aktif</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $kategoris->where('is_active', 1)->count() }}</h3>
                </div>
                <div class="bg-green-100 p-4 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Kategori Tidak Aktif</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $kategoris->where('is_active', 0)->count() }}</h3>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg">
                    <i class="fas fa-pause-circle text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-8">
        <form action="{{ route('admin.kategori.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Kategori</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
                <a href="{{ route('admin.kategori.index') }}"
                    class="px-4 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition-all">
                    <i class="fas fa-undo mr-2"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel Kategori -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($kategoris as $index => $kategori)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $kategoris->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($kategori->icon)
                                    <img src="{{ asset('storage/' . $kategori->icon) }}" alt="{{ $kategori->nama }}" 
                                        class="w-12 h-12 rounded-lg object-cover border border-gray-200">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $kategori->nama }}</div>
                                <div class="text-xs text-gray-500">Urutan: {{ $kategori->urutan ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 max-w-xs truncate">{{ $kategori->deskripsi ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    {{ $kategori->produks()->count() }} produk
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($kategori->is_active)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-pause-circle mr-1"></i> Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <!-- Toggle Status -->
                                    <form action="{{ route('admin.kategori.toggle-status', $kategori->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-all" 
                                            title="{{ $kategori->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <i class="fas {{ $kategori->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    
                                    <!-- Edit -->
                                    <a href="{{ route('admin.kategori.edit', $kategori->id) }}" 
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <!-- Delete -->
                                    <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-layer-group text-gray-300 text-5xl mb-4"></i>
                                    <p class="text-gray-500 text-lg">Tidak ada data kategori</p>
                                    <p class="text-gray-400 text-sm mb-4">Mulai tambahkan kategori baru</p>
                                    <a href="{{ route('admin.kategori.create') }}" 
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                                        <i class="fas fa-plus mr-2"></i>Tambah Kategori
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($kategoris->hasPages())
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $kategoris->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection