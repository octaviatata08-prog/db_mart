<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        p { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi - GITAOCMART</h2>
    <p>Tanggal: {{ $tanggal }}</p>

    <table>
        <thead>
            <tr>
                <th>No. Nota</th>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Total Belanja</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $t)
            <tr>
                <td>{{ $t->nomor_nota }}</td>
                <td>{{ $t->created_at->format('d-m-Y') }}</td>
                <td>{{ $t->nama_produk }}</td>
                <td>Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                <td>Lunas</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>