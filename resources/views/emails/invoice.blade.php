<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Belanja Anda</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header-title { text-align:center; margin-bottom:0; }
        .header-subtitle { text-align:center; margin-top:2px; }
        .info-table { border-collapse: collapse; width: 100%; margin-bottom: 10px; }
        .info-table td { border: none; padding: 2px 6px; font-size: 14px; }
        .info-table .label { width: 90px; }
        .info-table .spacer { width: 20px; }
        .product-table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        .product-table th, .product-table td { border: 1px solid #000; padding: 6px; text-align: left; font-size: 14px; }
        .product-table th { background: #f2f2f2; }
        .right { text-align: right; }
        .signature { text-align:right; margin-top:30px; font-weight: bold; }
        .total-row td { font-weight: bold; border: none; }
    </style>
</head>
<body>
    <h2 class="header-title">Toko Alat Kesehatan</h2>
    <h3 class="header-subtitle">Laporan Belanja Anda</h3>
    <table class="info-table">
        <tr>
            <td class="label">User ID :</td>
            <td>{{ $order->user->id ?? '-' }}</td>
            <td class="spacer"></td>
            <td class="label">Tanggal :</td>
            <td>{{ $order->created_at->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="label">Nama :</td>
            <td>{{ $order->user->name ?? '-' }}</td>
            <td class="spacer"></td>
            <td class="label">ID Paypal :</td>
            <td>{{ $order->user->paypal_id ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Alamat :</td>
            <td>{{ $order->shipping_address ?? '-' }}</td>
            <td class="spacer"></td>
            <td class="label">Nama Bank :</td>
            <td>{{ $order->user->bank_name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">No HP :</td>
            <td>{{ $order->user->phone ?? '-' }}</td>
            <td class="spacer"></td>
            <td class="label">Cara Bayar :</td>
            <td>{{ $order->payment_method ?? '-' }}</td>
        </tr>
    </table>

    <table class="product-table">
        <thead>
            <tr>
                <th style="width:40px;">No.</th>
                <th>Nama Produk dengan ID-nya</th>
                <th style="width:70px;">Jumlah</th>
                <th style="width:120px;">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->product->name }} {{ $item->product->code ? '('.$item->product->code.')' : '(' . $item->product->id . ')' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp{{ number_format($item->price) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3">Total belanja (termasuk pajak):</td>
                <td>Rp{{ number_format($order->total_amount) }}</td>
            </tr>
        </tfoot>
    </table>
    <div class="signature">
        TANDATANGAN TOKO
    </div>
</body>
</html>
