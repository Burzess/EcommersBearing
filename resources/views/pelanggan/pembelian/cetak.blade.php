<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Bukti Pembayaran - {{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 30px;
        }
        .invoice-banner {
            background-color: #fce4e4;
            color: #000;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .kop-surat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .company-info {
            text-align: left;
            font-size: 14px;
            line-height: 1.5;
        }
        .company-info h2 {
            margin: 0 0 10px 0;
            font-size: 18px;
        }
        .kop-surat img {
            max-width: 150px;
        }
        .order-details-wrap {
            border-top: 1px solid #333;
            padding-top: 15px;
            margin-bottom: 25px;
        }
        .meta-table {
            border-collapse: collapse;
        }
        .meta-table td {
            padding: 2px 15px 2px 0;
            border: none;
            font-size: 14px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info-col {
            flex: 1;
        }
        .info-col h3 {
            margin-top: 0;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-col p {
            margin: 5px 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        table th {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right !important;
        }
        .total-section {
            width: 50%;
            float: right;
        }
        .total-section p {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin: 5px 0;
        }
        .total-section p.grand-total {
            font-weight: bold;
            font-size: 16px;
            border-top: 2px solid #333;
            padding-top: 5px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        @media print {
            body {
                padding: 0;
            }
            .container {
                border: none;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
        .print-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-btn no-print">Cetak Bukti Pembayaran</button>
    <div class="container">
        <div class="invoice-banner">
            BUKTI PEMBAYARAN / INVOICE
        </div>

        <div class="kop-surat">
            <div class="company-info">
                <h2>PT ASIAN BEARINDO GROUP</h2>
                Tanjung sari no.19 surabaya<br>
                Telp: 0123-456-789<br>
                Email: mail@ptabj.co.id
            </div>
            <div class="logo">
                <img src="{{ asset('images/logo_bearindo.png') }}" alt="Logo PT ASIAN BEARINDO GROUP">
            </div>
        </div>

        <div class="order-details-wrap">
            <table class="meta-table">
                <tr>
                    <td>Nomor Invoice:</td>
                    <td>{{ $order->order_number }}</td>
                </tr>
                <tr>
                    <td>Tanggal Invoice:</td>
                    <td>{{ $order->created_at->format('d F Y') }}</td>
                </tr>
            </table>
        </div>

        <div class="info-row">
            <div class="info-col" style="padding-right: 20px;">
                <h3>Informasi Pelanggan</h3>
                <p><strong>Nama:</strong> {{ $order->user->name ?? 'Pelanggan' }}</p>
                <p><strong>Status Pembayaran:</strong> {{ $order->status_label ?? ucfirst($order->status) }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran }}</p>
            </div>
            <div class="info-col">
                <h3>Informasi Pengiriman</h3>
                <p><strong>Penerima:</strong> {{ $order->alamat_penerima }}</p>
                <p><strong>Telepon:</strong> {{ $order->alamat_telepon }}</p>
                <p><strong>Alamat:</strong> {{ $order->alamat_lengkap }}, {{ $order->alamat_kecamatan }}, {{ $order->alamat_kota }}, {{ $order->alamat_provinsi }} {{ $order->alamat_kode_pos }}</p>
                @if($order->kurir)
                <p><strong>Kurir / Resi:</strong> {{ $order->kurir }} / {{ $order->resi ?? '-' }}</p>
                @endif
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga Satuan</th>
                    <th>Qty</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->produk_nama }}<br><small>SKU: {{ $item->produk->sku ?? '-' }}</small></td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="clearfix">
            <div class="total-section">
                <p><span>Subtotal Produk:</span> <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span></p>
                <p><span>Ongkos Kirim:</span> <span>@if($order->ongkir > 0) Rp {{ number_format($order->ongkir, 0, ',', '.') }} @else GRATIS @endif</span></p>
                <p class="grand-total"><span>Total Pembayaran:</span> <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span></p>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih telah berbelanja di Bearing Shop.</p>
            <p>Dokumen ini adalah bukti pembayaran yang sah.</p>
        </div>
    </div>
    <script>
        // Otomatis cetak saat halaman dimuat
        window.onload = function() {
            // Uncomment baris di bawah jika ingin langsung otomatis print
            // window.print();
        }
    </script>
</body>
</html>
