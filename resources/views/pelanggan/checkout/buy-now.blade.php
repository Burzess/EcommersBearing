@extends('layout.pelanggan.app')

@section('title', 'Beli Sekarang - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-primary-600 to-primary-800 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('pelanggan.produk.show', $produk->slug) }}"
                    class="inline-flex mb-4 items-center text-white hover:text-white transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Produk
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Beli Sekarang</h1>
                <p class="text-primary-100">Selesaikan pembelian Anda</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-bolt text-white text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        @include('pelanggan.component.alert', ['type' => 'success', 'slot' => session('success')])
    @endif

    @if (session('error'))
        @include('pelanggan.component.alert', ['type' => 'error', 'slot' => session('error')])
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span class="font-semibold">Terjadi kesalahan:</span>
            </div>
            <ul class="list-disc list-inside ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $selectedAlamatId = old('alamat_id', optional($defaultAlamat ?? $alamats->first())->id);
        $selectedAlamat = $selectedAlamatId ? $alamats->firstWhere('id', (int) $selectedAlamatId) : null;
        if (! $selectedAlamat) {
            $selectedAlamat = $defaultAlamat ?? $alamats->first();
            $selectedAlamatId = $selectedAlamat->id ?? null;
        }

        $selectedMetodeId = old('metode_pembayaran_id', optional($metodes->first())->id);
        $selectedMetode = $selectedMetodeId ? $metodes->firstWhere('id', (int) $selectedMetodeId) : null;
        if (! $selectedMetode) {
            $selectedMetode = $metodes->first();
            $selectedMetodeId = $selectedMetode->id ?? null;
        }
    @endphp

    <form action="{{ route('pelanggan.buy-now') }}" method="POST">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">
        <input type="hidden" name="ongkir" id="input-ongkir" value="0">

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>Alamat Pengiriman
                </h2>

                @if ($selectedAlamat)
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                        <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span id="selected-alamat-label" class="font-bold text-gray-900">{{ $selectedAlamat->label }}</span>
                                    <span id="selected-alamat-badge" class="{{ $selectedAlamat->is_default ? '' : 'hidden' }} bg-primary-100 text-primary-600 text-xs px-2 py-0.5 rounded-full">Utama</span>
                                </div>
                                <p id="selected-alamat-receiver" class="text-gray-900 font-medium">{{ $selectedAlamat->penerima }}</p>
                                <p id="selected-alamat-phone" class="text-gray-600 text-sm">{{ $selectedAlamat->telepon }}</p>
                                <p id="selected-alamat-address" class="text-gray-600 text-sm mt-1">
                                    {{ $selectedAlamat->alamat_lengkap }}, {{ $selectedAlamat->kecamatan }},
                                    {{ $selectedAlamat->kota }}, {{ $selectedAlamat->provinsi }} {{ $selectedAlamat->kode_pos }}
                                </p>
                            </div>
                            <button type="button" onclick="openModal('alamat-modal')"
                                class="inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-semibold border border-gray-200 text-gray-700 hover:bg-white transition-colors">
                                Ubah
                            </button>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-map-marker-alt text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-600 mb-4">Anda belum memiliki alamat pengiriman</p>
                        <a href="{{ route('pelanggan.profil.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700">
                            <i class="fas fa-plus mr-2"></i>Tambah Alamat
                        </a>
                    </div>
                @endif

                @include('pelanggan.component.input-error', ['messages' => $errors->get('alamat_id')])
                <input type="hidden" name="alamat_id" id="selected-alamat-id" value="{{ $selectedAlamatId }}">
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-box mr-2 text-primary-600"></i>Produk yang Dibeli
                </h2>
                <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
                    <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                        @if ($produk->images->first())
                            <img src="{{ asset('storage/' . $produk->images->first()->image_path) }}"
                                alt="{{ $produk->nama }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-500 mb-1">{{ $produk->merk->nama ?? '-' }}</p>
                        <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $produk->nama }}</h4>
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">{{ $quantity }} × Rp {{ number_format($harga, 0, ',', '.') }}</p>
                            <p class="font-bold text-primary-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-credit-card mr-2 text-primary-600"></i>Metode Pembayaran
                </h2>

                @if ($selectedMetode)
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                        <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span id="selected-metode-label" class="font-semibold text-gray-900">{{ $selectedMetode->nama }}</span>
                                    <span id="selected-metode-type" class="text-xs px-2 py-0.5 rounded-full bg-gray-200 text-gray-600 uppercase">{{ $selectedMetode->tipe }}</span>
                                </div>
                                <p id="selected-metode-description" class="text-sm text-gray-600">{{ $selectedMetode->deskripsi }}</p>
                                <p id="selected-metode-bank" class="{{ $selectedMetode->tipe === 'transfer' && $selectedMetode->bank_nama ? '' : 'hidden' }} text-xs text-gray-500 mt-1">
                                    <i class="fas fa-university mr-1"></i>{{ $selectedMetode->bank_nama }} - {{ $selectedMetode->bank_rekening }} a.n {{ $selectedMetode->bank_atas_nama }}
                                </p>
                            </div>
                            <button type="button" onclick="openModal('metode-modal')"
                                class="inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-semibold border border-gray-200 text-gray-700 hover:bg-white transition-colors">
                                Ubah
                            </button>
                        </div>
                    </div>
                @else
                    <div class="text-center py-6 text-gray-500">
                        <p>Belum ada metode pembayaran yang tersedia</p>
                    </div>
                @endif

                @include('pelanggan.component.input-error', ['messages' => $errors->get('metode_pembayaran_id')])
                <input type="hidden" name="metode_pembayaran_id" id="selected-metode-id" value="{{ $selectedMetodeId }}">
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-sticky-note mr-2 text-primary-600"></i>Catatan Pesanan (Opsional)
                </h2>
                <textarea name="catatan" rows="3" placeholder="Contoh: Tolong packing dengan bubble wrap"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ old('catatan') }}</textarea>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Belanja</h2>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-gray-700">
                        <span>Total Harga ({{ $quantity }} barang)</span>
                        <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Ongkos Kirim</span>
                        <span id="ongkir-display" class="font-semibold text-gray-500">
                            <i class="fas fa-spinner fa-spin mr-1"></i>Menghitung...
                        </span>
                    </div>
                    <div id="estimasi-container" class="hidden">
                        <div class="flex justify-between text-gray-500 text-sm">
                            <span>Estimasi Pengiriman</span>
                            <span id="estimasi-display">-</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                        <span id="total-display" class="text-2xl font-bold text-primary-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if ($alamats->count() > 0 && $selectedMetode)
                    <button type="submit"
                        class="w-full bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-bolt mr-2"></i>Beli Sekarang
                    </button>
                @else
                    <button type="button" disabled
                        class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg font-semibold cursor-not-allowed flex items-center justify-center">
                        <i class="fas fa-bolt mr-2"></i>Tambahkan Alamat Terlebih Dahulu
                    </button>
                @endif

                <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-shield-alt text-green-600 mt-1"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Transaksi Aman</p>
                            <p class="text-xs text-gray-600">Data Anda dilindungi dengan enkripsi SSL</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-undo text-primary-600 mt-1"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Garansi Uang Kembali</p>
                            <p class="text-xs text-gray-600">Jika produk tidak sesuai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if ($alamats->count() > 0)
        <div id="alamat-modal" class="hidden fixed inset-0 z-50 bg-black/50 p-4" onclick="if (event.target === this) closeModal('alamat-modal')">
            <div class="mx-auto flex min-h-full max-w-3xl items-center justify-center">
                <div class="w-full max-h-[90vh] overflow-hidden rounded-2xl bg-white shadow-2xl">
                    <div class="sticky top-0 bg-white border-b px-6 py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Pilih Alamat Pengiriman</h3>
                            <p class="text-sm text-gray-500">Pilih alamat yang akan digunakan untuk checkout.</p>
                        </div>
                        <button type="button" onclick="closeModal('alamat-modal')" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="max-h-[70vh] overflow-y-auto p-6 space-y-3">
                        @foreach ($alamats as $alamat)
                            <label class="block cursor-pointer">
                                <input type="radio" name="alamat-modal-option" value="{{ $alamat->id }}"
                                    class="sr-only js-alamat-option"
                                    data-label="{{ $alamat->label }}"
                                    data-penerima="{{ $alamat->penerima }}"
                                    data-telepon="{{ $alamat->telepon }}"
                                    data-alamat-lengkap="{{ $alamat->alamat_lengkap }}"
                                    data-kecamatan="{{ $alamat->kecamatan }}"
                                    data-kota="{{ $alamat->kota }}"
                                    data-provinsi="{{ $alamat->provinsi }}"
                                    data-kode-pos="{{ $alamat->kode_pos }}"
                                    data-is-default="{{ $alamat->is_default ? 1 : 0 }}"
                                    {{ (int) $selectedAlamatId === (int) $alamat->id ? 'checked' : '' }}>
                                <div class="flex items-start gap-3 rounded-xl border-2 border-gray-200 p-4 hover:border-primary-500 transition-all js-alamat-option-card {{ (int) $selectedAlamatId === (int) $alamat->id ? 'border-primary-600 bg-primary-50' : '' }}">
                                    <div class="mt-1 h-5 w-5 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0">
                                        <div class="h-2.5 w-2.5 rounded-full bg-primary-600 {{ (int) $selectedAlamatId === (int) $alamat->id ? '' : 'hidden' }}"></div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-bold text-gray-900">{{ $alamat->label }}</span>
                                            @if ($alamat->is_default)
                                                <span class="bg-primary-100 text-primary-600 text-xs px-2 py-0.5 rounded-full">Utama</span>
                                            @endif
                                        </div>
                                        <p class="text-gray-900 font-medium">{{ $alamat->penerima }}</p>
                                        <p class="text-gray-600 text-sm">{{ $alamat->telepon }}</p>
                                        <p class="text-gray-600 text-sm mt-1">
                                            {{ $alamat->alamat_lengkap }}, {{ $alamat->kecamatan }},
                                            {{ $alamat->kota }}, {{ $alamat->provinsi }} {{ $alamat->kode_pos }}
                                        </p>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($metodes->count() > 0)
        <div id="metode-modal" class="hidden fixed inset-0 z-50 bg-black/50 p-4" onclick="if (event.target === this) closeModal('metode-modal')">
            <div class="mx-auto flex min-h-full max-w-3xl items-center justify-center">
                <div class="w-full max-h-[90vh] overflow-hidden rounded-2xl bg-white shadow-2xl">
                    <div class="sticky top-0 bg-white border-b px-6 py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Pilih Metode Pembayaran</h3>
                            <p class="text-sm text-gray-500">Pilih metode pembayaran yang akan digunakan untuk checkout.</p>
                        </div>
                        <button type="button" onclick="closeModal('metode-modal')" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="max-h-[70vh] overflow-y-auto p-6 space-y-3">
                        @foreach ($metodes as $metode)
                            <label class="block cursor-pointer">
                                <input type="radio" name="metode-modal-option" value="{{ $metode->id }}"
                                    class="sr-only js-metode-option"
                                    data-nama="{{ $metode->nama }}"
                                    data-deskripsi="{{ $metode->deskripsi }}"
                                    data-tipe="{{ $metode->tipe }}"
                                    data-bank-nama="{{ $metode->bank_nama }}"
                                    data-bank-rekening="{{ $metode->bank_rekening }}"
                                    data-bank-atas-nama="{{ $metode->bank_atas_nama }}"
                                    {{ (int) $selectedMetodeId === (int) $metode->id ? 'checked' : '' }}>
                                <div class="flex items-start gap-3 rounded-xl border-2 border-gray-200 p-4 hover:border-primary-500 transition-all js-metode-option-card {{ (int) $selectedMetodeId === (int) $metode->id ? 'border-primary-600 bg-primary-50' : '' }}">
                                    <div class="mt-1 h-5 w-5 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0">
                                        <div class="h-2.5 w-2.5 rounded-full bg-primary-600 {{ (int) $selectedMetodeId === (int) $metode->id ? '' : 'hidden' }}"></div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-semibold text-gray-900">{{ $metode->nama }}</span>
                                            <span class="text-xs px-2 py-0.5 rounded-full bg-gray-200 text-gray-600 uppercase">{{ $metode->tipe }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $metode->deskripsi }}</p>
                                        @if ($metode->tipe === 'transfer' && $metode->bank_nama)
                                            <p class="text-xs text-gray-500 mt-1">
                                                <i class="fas fa-university mr-1"></i>{{ $metode->bank_nama }} - {{ $metode->bank_rekening }} a.n {{ $metode->bank_atas_nama }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        const subtotal = {{ $subtotal }};
        let currentOngkir = 0;

        function formatRupiah(number) {
            return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function openModal(id) {
            const modal = document.getElementById(id);
            if (! modal) {
                return;
            }

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (! modal) {
                return;
            }

            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function updateAlamatSummary(option) {
            const selectedAlamatId = document.getElementById('selected-alamat-id');
            const alamatLabel = document.getElementById('selected-alamat-label');
            const alamatBadge = document.getElementById('selected-alamat-badge');
            const alamatReceiver = document.getElementById('selected-alamat-receiver');
            const alamatPhone = document.getElementById('selected-alamat-phone');
            const alamatAddress = document.getElementById('selected-alamat-address');

            if (! selectedAlamatId || ! option) {
                return;
            }

            selectedAlamatId.value = option.value;
            if (alamatLabel) {
                alamatLabel.textContent = option.dataset.label || '-';
            }
            if (alamatReceiver) {
                alamatReceiver.textContent = option.dataset.penerima || '-';
            }
            if (alamatPhone) {
                alamatPhone.textContent = option.dataset.telepon || '-';
            }
            if (alamatAddress) {
                alamatAddress.textContent = [option.dataset.alamatLengkap, option.dataset.kecamatan, option.dataset.kota, option.dataset.provinsi + ' ' + (option.dataset.kodePos || '')].filter(Boolean).join(', ');
            }
            if (alamatBadge) {
                alamatBadge.classList.toggle('hidden', option.dataset.isDefault !== '1');
            }

            document.querySelectorAll('.js-alamat-option-card').forEach(card => {
                card.classList.remove('border-primary-600', 'bg-primary-50');
                card.classList.add('border-gray-200');
            });

            const activeCard = option.closest('label')?.querySelector('.js-alamat-option-card');
            if (activeCard) {
                activeCard.classList.add('border-primary-600', 'bg-primary-50');
                activeCard.classList.remove('border-gray-200');
            }

            document.querySelectorAll('.js-alamat-option-card .bg-primary-600').forEach(dot => dot.classList.add('hidden'));
            const activeDot = option.closest('label')?.querySelector('.js-alamat-option-card .bg-primary-600');
            if (activeDot) {
                activeDot.classList.remove('hidden');
            }
        }

        function updateMetodeSummary(option) {
            const selectedMetodeId = document.getElementById('selected-metode-id');
            const metodeLabel = document.getElementById('selected-metode-label');
            const metodeType = document.getElementById('selected-metode-type');
            const metodeDescription = document.getElementById('selected-metode-description');
            const metodeBank = document.getElementById('selected-metode-bank');

            if (! selectedMetodeId || ! option) {
                return;
            }

            selectedMetodeId.value = option.value;
            if (metodeLabel) {
                metodeLabel.textContent = option.dataset.nama || '-';
            }
            if (metodeType) {
                metodeType.textContent = (option.dataset.tipe || '').toUpperCase();
            }
            if (metodeDescription) {
                metodeDescription.textContent = option.dataset.deskripsi || '-';
            }
            if (metodeBank) {
                const bankNama = option.dataset.bankNama || '';
                const bankRekening = option.dataset.bankRekening || '';
                const bankAtasNama = option.dataset.bankAtasNama || '';
                const shouldShowBank = (option.dataset.tipe === 'transfer') && bankNama;
                metodeBank.classList.toggle('hidden', ! shouldShowBank);
                if (shouldShowBank) {
                    metodeBank.innerHTML = '<i class="fas fa-university mr-1"></i>' + [bankNama, bankRekening ? ' - ' + bankRekening : '', bankAtasNama ? ' a.n ' + bankAtasNama : ''].join('');
                }
            }

            document.querySelectorAll('.js-metode-option-card').forEach(card => {
                card.classList.remove('border-primary-600', 'bg-primary-50');
                card.classList.add('border-gray-200');
            });

            const activeCard = option.closest('label')?.querySelector('.js-metode-option-card');
            if (activeCard) {
                activeCard.classList.add('border-primary-600', 'bg-primary-50');
                activeCard.classList.remove('border-gray-200');
            }

            document.querySelectorAll('.js-metode-option-card .bg-primary-600').forEach(dot => dot.classList.add('hidden'));
            const activeDot = option.closest('label')?.querySelector('.js-metode-option-card .bg-primary-600');
            if (activeDot) {
                activeDot.classList.remove('hidden');
            }
        }

        async function hitungOngkir(alamatId) {
            const ongkirDisplay = document.getElementById('ongkir-display');
            const estimasiContainer = document.getElementById('estimasi-container');
            const estimasiDisplay = document.getElementById('estimasi-display');
            const totalDisplay = document.getElementById('total-display');
            const inputOngkir = document.getElementById('input-ongkir');

            if (! ongkirDisplay || ! estimasiContainer || ! estimasiDisplay || ! totalDisplay || ! inputOngkir) {
                return;
            }

            ongkirDisplay.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Menghitung...';
            ongkirDisplay.className = 'font-semibold text-gray-500';
            estimasiContainer.classList.add('hidden');

            try {
                const response = await fetch('/api/ongkir/hitung-by-alamat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ alamat_id: alamatId, subtotal: subtotal })
                });

                const data = await response.json();

                if (data.success) {
                    currentOngkir = data.data.tarif;
                    inputOngkir.value = currentOngkir;
                    const isFreeShipping = Boolean(data.data.is_free_shipping);

                    ongkirDisplay.textContent = isFreeShipping ? 'Gratis Ongkir' : data.data.tarif_formatted;
                    ongkirDisplay.className = isFreeShipping ? 'font-semibold text-green-600' : 'font-semibold text-primary-600';

                    estimasiDisplay.textContent = data.data.estimasi;
                    estimasiContainer.classList.remove('hidden');

                    const total = subtotal + currentOngkir;
                    totalDisplay.textContent = formatRupiah(total);
                } else {
                    ongkirDisplay.textContent = 'Gagal menghitung';
                    ongkirDisplay.className = 'font-semibold text-red-500';
                }
            } catch (error) {
                console.error('Error:', error);
                ongkirDisplay.textContent = 'Error';
                ongkirDisplay.className = 'font-semibold text-red-500';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const selectedAlamatOption = document.querySelector('.js-alamat-option:checked');
            const selectedMetodeOption = document.querySelector('.js-metode-option:checked');

            if (selectedAlamatOption) {
                updateAlamatSummary(selectedAlamatOption);
                hitungOngkir(selectedAlamatOption.value);
            } else {
                const ongkirDisplay = document.getElementById('ongkir-display');
                if (ongkirDisplay) {
                    ongkirDisplay.textContent = 'Pilih alamat dulu';
                    ongkirDisplay.className = 'font-semibold text-gray-500';
                }
            }

            if (selectedMetodeOption) {
                updateMetodeSummary(selectedMetodeOption);
            }

            document.querySelectorAll('.js-alamat-option').forEach(option => {
                option.addEventListener('change', function() {
                    updateAlamatSummary(this);
                    hitungOngkir(this.value);
                    closeModal('alamat-modal');
                });
            });

            document.querySelectorAll('.js-metode-option').forEach(option => {
                option.addEventListener('change', function() {
                    updateMetodeSummary(this);
                    closeModal('metode-modal');
                });
            });
        });
    </script>
@endsection
