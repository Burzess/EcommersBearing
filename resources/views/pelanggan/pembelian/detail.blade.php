@extends('layout.pelanggan.app')

@section('title', 'Detail Pesanan ' . $order->order_number . ' - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('pelanggan.pembelian.index') }}"
                    class="inline-flex mb-6 items-center text-white hover:text-white transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Detail Pesanan</h1>
                <p class="text-blue-100">No. Pesanan: {{ $order->order_number }}</p>
            </div>
            <div class="md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-receipt text-blue-800 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages menggunakan komponen -->
    @if (session('success'))
        @include('pelanggan.component.alert', ['type' => 'success', 'slot' => session('success')])
    @endif

    @if (session('error'))
        @include('pelanggan.component.alert', ['type' => 'error', 'slot' => session('error')])
    @endif

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Detail Pesanan -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Pesanan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Status Pesanan</h2>
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'paid' => 'bg-blue-100 text-blue-700',
                        'processing' => 'bg-blue-100 text-blue-700',
                        'shipped' => 'bg-purple-100 text-purple-700',
                        'delivered' => 'bg-green-100 text-green-700',
                        'cancelled' => 'bg-red-100 text-red-700',
                    ];
                    $statusIcons = [
                        'pending' => 'clock',
                        'paid' => 'check-circle',
                        'processing' => 'box',
                        'shipped' => 'truck',
                        'delivered' => 'check-circle',
                        'cancelled' => 'times-circle',
                    ];
                @endphp
                <div class="{{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }} px-4 py-3 rounded-lg flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-{{ $statusIcons[$order->status] ?? 'info-circle' }} text-2xl mr-3"></i>
                        <span class="font-bold text-lg">{{ $order->status_label }}</span>
                    </div>
                </div>

                <!-- Timeline Status -->
                @if ($order->statuses->count() > 0)
                    <div class="relative pl-8">
                        @foreach ($order->statuses->sortByDesc('created_at') as $index => $status)
                            <div class="relative {{ !$loop->last ? 'pb-8' : 'pb-0' }}">
                                @if (!$loop->last)
                                    <span class="absolute top-8 left-[-20px] -ml-px h-full w-0.5 bg-blue-600"></span>
                                @endif
                                <div class="relative flex items-start">
                                    <span class="h-10 w-10 rounded-full flex items-center justify-center absolute -left-10 bg-blue-600 text-white {{ $loop->first ? 'ring-4 ring-blue-200' : '' }}">
                                        <i class="fas fa-{{ $statusIcons[$status->status] ?? 'info-circle' }}"></i>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p class="font-bold text-gray-900 {{ $loop->first ? 'text-blue-600' : '' }}">
                                            {{ $status->status_label ?? ucfirst($status->status) }}
                                        </p>
                                        @if ($status->keterangan)
                                            <p class="text-sm text-gray-600 mt-1">{{ $status->keterangan }}</p>
                                        @endif
                                        <p class="text-xs text-gray-500 mt-1">{{ $status->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Produk yang Dipesan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-box mr-2 text-blue-600"></i>Produk yang Dipesan
                </h2>
                <div class="space-y-4">
                    @foreach ($order->items as $item)
                        <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                            <div class="w-24 h-24 bg-white rounded-lg overflow-hidden shrink-0 shadow-sm">
                                @if ($item->produk && $item->produk->images->first())
                                    <img src="{{ asset('storage/' . $item->produk->images->first()->image_path) }}" 
                                        alt="{{ $item->nama_produk }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $item->nama_produk }}</h4>
                                <p class="text-xs text-gray-500 mb-2">SKU: {{ $item->produk->sku ?? '-' }}</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600">{{ $item->quantity }} × Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                    <p class="font-bold text-blue-600 text-lg">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-truck mr-2 text-blue-600"></i>Informasi Pengiriman
                </h2>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-3">Penerima</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex">
                                <span class="text-gray-600 w-24">Nama</span>
                                <span class="text-gray-900 font-medium">: {{ $order->alamat_penerima }}</span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-600 w-24">Telepon</span>
                                <span class="text-gray-900 font-medium">: {{ $order->alamat_telepon }}</span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-600 w-24">Alamat</span>
                                <span class="text-gray-900 font-medium flex-1">: {{ $order->alamat_lengkap }}, 
                                    {{ $order->alamat_kecamatan }}, {{ $order->alamat_kota }}, 
                                    {{ $order->alamat_provinsi }} {{ $order->alamat_kode_pos }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($order->kurir || $order->resi)
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-900 mb-3">Kurir & Pengiriman</h3>
                            <div class="space-y-2 text-sm">
                                @if ($order->kurir)
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">Kurir</span>
                                        <span class="text-gray-900 font-medium">: {{ $order->kurir }}</span>
                                    </div>
                                @endif
                                @if ($order->resi)
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">No. Resi</span>
                                        <span class="text-gray-900 font-medium">: {{ $order->resi }}</span>
                                    </div>
                                @endif
                                @if ($order->estimasi_sampai)
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">Estimasi Tiba</span>
                                        <span class="text-gray-900 font-medium">: {{ $order->estimasi_sampai->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-credit-card mr-2 text-blue-600"></i>Informasi Pembayaran
                </h2>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-3">Metode Pembayaran</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex">
                                <span class="text-gray-600 w-32">Metode</span>
                                <span class="text-gray-900 font-medium">: {{ $order->metode_pembayaran }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($order->paid_at)
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-gray-900">Status Pembayaran</h3>
                                <span class="px-3 py-1 bg-green-600 text-white rounded-full text-sm font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>Sudah Dibayar
                                </span>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Dibayar Pada</span>
                                    <span class="text-gray-900 font-medium">{{ $order->paid_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    @elseif ($order->status == 'pending')
                        <div class="bg-yellow-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-gray-900">Status Pembayaran</h3>
                                <span class="px-3 py-1 bg-yellow-600 text-white rounded-full text-sm font-semibold">
                                    <i class="fas fa-clock mr-1"></i>Menunggu Pembayaran
                                </span>
                            </div>
                            @if (!$order->bukti_pembayaran)
                                <form action="{{ route('pelanggan.pembelian.upload-bukti', $order->id) }}" 
                                    method="POST" enctype="multipart/form-data" class="mt-4">
                                    @csrf
                                    <p class="text-sm text-gray-600 mb-2">Upload bukti pembayaran:</p>
                                    <div class="flex items-center space-x-2">
                                        <input type="file" name="bukti_pembayaran" accept="image/*" required
                                            class="flex-1 text-sm border border-gray-300 rounded-lg">
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                                            <i class="fas fa-upload mr-1"></i>Upload
                                        </button>
                                    </div>
                                </form>
                            @else
                                <p class="text-sm text-green-600 mt-2">
                                    <i class="fas fa-check-circle mr-1"></i>Bukti pembayaran sudah diupload, menunggu verifikasi
                                </p>
                            @endif
                        </div>
                    @endif

                    @if ($order->bukti_pembayaran)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-900 mb-3">Bukti Pembayaran</h3>
                            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti Pembayaran" 
                                class="w-full max-w-xs rounded-lg border border-gray-200">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Ringkasan & Aksi -->
        <div class="lg:col-span-1">
            <div class="sticky top-2 space-y-6">
                <!-- Ringkasan Pembayaran -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h2>
                    <div class="space-y-3 mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal Produk</span>
                            <span class="font-medium">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span class="font-medium">
                                @if ($order->ongkir > 0)
                                    Rp {{ number_format($order->ongkir, 0, ',', '.') }}
                                @else
                                    GRATIS
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-xs text-gray-500 text-center">Termasuk PPN jika berlaku</p>
                </div>

                <!-- Tombol Aksi -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Aksi</h2>
                    <div class="space-y-3">
                        @if ($order->canBeCancelled())
                            <button onclick="document.getElementById('cancelFormDetail').classList.toggle('hidden')"
                                class="w-full px-4 py-2.5 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all">
                                <i class="fas fa-times mr-2"></i>Batalkan Pesanan
                            </button>
                            <form id="cancelFormDetail" action="{{ route('pelanggan.pembelian.cancel', $order->id) }}" 
                                method="POST" class="hidden">
                                @csrf
                                <input type="text" name="cancelled_reason" placeholder="Alasan pembatalan" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm mb-2">
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700">
                                    Konfirmasi Batalkan
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('pelanggan.pembelian.index') }}"
                            class="w-full px-4 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all block text-center">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Riwayat
                        </a>
                    </div>
                </div>

                <!-- Catatan -->
                @if ($order->catatan)
                    <div class="bg-gray-50 rounded-xl shadow-md p-6">
                        <h3 class="font-bold text-gray-900 mb-3">
                            <i class="fas fa-sticky-note mr-2 text-blue-600"></i>Catatan
                        </h3>
                        <p class="text-sm text-gray-700">{{ $order->catatan }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection