<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk TRX-{{ $transaksi->id_transaksi }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 0;
            width: 58mm;
        }
        .container { padding: 5px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .divider { border-bottom: 1px dashed #000; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; padding: 2px 0; }

        @media print {
            .no-print { display: none !important; }
            @page { margin: 0; } 
            body { width: 58mm; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="text-center">
        <h3 style="margin:0; font-size: 16px;">MINIMARKET KITA</h3>
        <p style="margin:0;">Jl. Teknologi No. 1, Kota Lama</p>
        <p style="margin:0;">Telp: 0811-2222-3333</p>
    </div>
    
    <div class="divider"></div>
    
    <div>
        No       : TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}<br>
        Tgl      : {{ $transaksi->tanggal }}<br>
        Kasir    : {{ auth()->user()->name ?? 'Admin' }}<br>
        Pelanggan: {{ $transaksi->pelanggan->nama_pelanggan ?? 'Umum' }}
    </div>
    
    <div class="divider"></div>

    <table>
        @foreach($detail as $item)
        <tr>
            <td colspan="3" class="bold">{{ $item->nama_produk }}</td>
        </tr>
        <tr>
            <td>{{ $item->qty }}x</td>
            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="divider"></div>

    <table>
        <tr>
            <td class="bold">TOTAL</td>
            <td class="text-right bold">Rp {{ number_format($transaksi->total_belanja, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="divider"></div>
    
    <div class="text-center" style="margin-top: 10px;">
        <p style="margin:0;">Terima Kasih Atas Kunjungan Anda!</p>
        <p style="margin:0; font-size: 10px;">Layanan Konsumen: 1500-123</p>
    </div>

    <div class="no-print text-center" style="margin-top: 20px; padding-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px; background: #10b981; color: white; border: none; border-radius: 4px; width: 90%; cursor: pointer; margin-bottom: 8px;">🖨️ Cetak Ulang</button>
        <br>
        <a href="{{ route('kasir.index') }}" style="padding: 10px; background: #4f46e5; color: white; text-decoration: none; border-radius: 4px; display: inline-block; width: 90%; box-sizing: border-box; text-align: center;">⬅️ Kembali ke POS</a>
    </div>
</div>

<script>
    window.onload = function() {
        window.print();
    };
</script>
</body>
</html>