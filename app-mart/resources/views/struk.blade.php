<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GITAOCMART - Struk Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #fff0f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .navbar { margin-top: 20px; border-radius: 50px; background-color: #ffffff; box-shadow: 0 4px 15px rgba(255, 182, 193, 0.3); padding: 10px 20px; }
        .navbar-nav .nav-link { border-radius: 50px; padding: 8px 20px; font-weight: 500; color: #555; transition: all 0.3s; }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: white; background-color: #d63384; }
        
        .logo-box { width: 40px; height: 40px; background: linear-gradient(135deg, #ff758c 0%, #d63384 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; margin-right: 10px; box-shadow: 0 4px 10px rgba(214, 51, 132, 0.3); }
        .brand-text { font-size: 1.2rem; font-weight: 800; letter-spacing: -0.5px; color: #333; }
        .brand-text span { color: #d63384; }
        .text-pink { color: #d63384; }
        .btn-pink { background-color: #d63384; color: white; border-radius: 50px; font-weight: bold; }
        .btn-pink:hover { background-color: #b02a6b; color: white; }

        /* STYLE STRUK */
        .receipt-container {
            max-width: 300px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(214, 51, 132, 0.15);
        }
        .receipt-header {
            text-align: center;
            border-bottom: 2px dashed #ccc;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .receipt-title {
            font-size: 1.4rem;
            font-weight: 900;
            color: #d63384;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .receipt-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        .receipt-total {
            font-size: 1.1rem;
            font-weight: bold;
            color: #d63384;
            border-top: 2px dashed #ccc;
            padding-top: 15px;
            margin-top: 15px;
        }
        .receipt-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 0.8rem;
            color: #777;
        }
        
        /* Tombol Print */
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        @media print {
            body { background: white; margin: 0; }
            .navbar, .print-btn { display: none !important; }
            .receipt-container { box-shadow: none; margin: 0; padding: 10px; }
            
            @page { size: 80mm auto; margin: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    <div class="logo-box"><i class="bi bi-bag-heart-fill"></i></div>
                    <span class="brand-text">GITA<span>OCMART</span></span>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ route('pos.index') }}">POS</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('produk.index') }}">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('backup.index') }}">Backup</a></li>
                    </ul>
                    <div class="d-flex gap-2 align-items-center">
                        @auth
                            <span class="fw-bold me-2 text-pink"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-pink"><i class="bi bi-box-arrow-right"></i> Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-pink"><i class="bi bi-box-arrow-right"></i> Logout</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <button onclick="window.print()" class="btn btn-pink print-btn">
        <i class="bi bi-printer"></i> Cetak Struk
    </button>

    <div class="container">
        <div class="receipt-container">
            <div class="receipt-header">
                <h2 class="receipt-title">GITAOCMART</h2>
                <p class="mb-0">Jl. Kawis Coper Jetis Ponorogo</p>
                <p>Telp: 0858-1540-8992</p>
            </div>

            <div class="receipt-line">
                <span>No. Nota</span>
                <span><strong>{{ $transaksi->nomor_nota }}</strong></span>
            </div>
            <div class="receipt-line">
                <span>Tanggal</span>
                <span>{{ $transaksi->created_at->format('d-m-Y H:i') }}</span>
            </div>
            <div class="receipt-line">
                <span>Kasir</span>
                <span>{{ Auth::user()->name ?? 'Admin' }}</span>
            </div>
            
            <!-- BARIS PELANGGAN DITAMBAHKAN DI SINI -->
            <div class="receipt-line">
                <span>Pelanggan</span>
                <span>{{ $transaksi->pelanggan ? $transaksi->pelanggan->nama_pelanggan : 'Pelanggan Umum' }}</span>
            </div>
            <!-- END BARIS PELANGGAN -->

            <hr style="border-top: 2px dashed #ccc; margin: 20px 0;">

            <div class="receipt-line">
                <span>{{ $transaksi->nama_produk }}</span>
                <span>{{ $transaksi->qty }} x Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</span>
            </div>

            <div class="receipt-total">
                <span>TOTAL</span>
                <span>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
            </div>

            <div class="receipt-footer">
                <p>Terima kasih telah berbelanja!</p>
                <p>Barang yang sudah dibeli tidak dapat dikembalikan.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>