<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GITAOCMART - Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #fff0f5; }
        .navbar { margin-top: 20px; border-radius: 50px; background-color: #ffffff; box-shadow: 0 4px 15px rgba(255, 182, 193, 0.3); padding: 10px 20px; }
        .navbar-nav .nav-link { border-radius: 50px; padding: 8px 20px; font-weight: 500; color: #555; transition: all 0.3s; }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: white; background-color: #d63384; }
        .text-pink { color: #d63384; }
        .btn-pink { background-color: #d63384; color: white; border-radius: 50px; font-weight: bold; }
        .btn-pink:hover { background-color: #b02a6b; color: white; }
        .btn-green { background-color: #198754; color: white; border-radius: 50px; font-weight: bold; }
        .btn-green:hover { background-color: #146c43; color: white; }

        .logo-box { width: 40px; height: 40px; background: linear-gradient(135deg, #ff758c 0%, #d63384 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; margin-right: 10px; box-shadow: 0 4px 10px rgba(214, 51, 132, 0.3); }
        .brand-text { font-size: 1.2rem; font-weight: 800; letter-spacing: -0.5px; color: #333; }
        .brand-text span { color: #d63384; }

        .hero-section { background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); color: white; border-radius: 0 0 30px 30px; padding: 60px 0; text-align: center; margin-bottom: 40px; }
        .table-container { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1); }
        .table thead th { color: #d63384; }
        
        .filter-box { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1); margin-bottom: 20px; }
        
        /* Notifikasi Sukses dengan Border & Latar Lebih Jelas */
        .success-box {
            background-color: #d4edda;
            border: 2px solid #155724;
            color: #155724;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .success-box strong {
            font-size: 1.1rem;
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
                        <li class="nav-item"><a class="nav-link" href="{{ route('pos.index') }}">POS</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('produk.index') }}">Produk</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ route('laporan.index') }}">Laporan</a></li>
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

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Laporan Transaksi</h1>
            <p class="lead">Lihat riwayat dan laporan penjualan toko Anda.</p>
        </div>
    </div>

    <div class="container mb-5">
        <!-- NOTIFIKASI SUKSES (Stok Berkurang & Transaksi Berhasil) -->
        @if(session('success'))
            <div class="success-box">
                <div>
                    <i class="bi bi-check-circle-fill"></i> <strong>{{ session('success') }}</strong>
                    <br>
                    <small>Stok produk telah otomatis berkurang. Silakan cek di menu Produk jika diperlukan.</small>
                </div>
                <div>
                    @php $lastTransaksi = \App\Models\Transaksi::latest()->first(); @endphp
                    @if($lastTransaksi)
                        <a href="{{ route('struk.show', $lastTransaksi->id) }}" target="_blank" class="btn btn-pink btn-lg">
                            <i class="bi bi-receipt"></i> Cetak Struk
                        </a>
                    @endif
                </div>
            </div>
        @endif

        <!-- FILTER -->
        <div class="filter-box">
            <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="tanggal" class="form-label text-pink fw-bold">Pilih Tanggal (Harian)</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-pink me-2"><i class="bi bi-funnel"></i> Filter</button>
                    <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
                    
                    <span class="ms-3 text-muted">Total Unit Terjual:</span>
                    <span class="fw-bold text-pink fs-5">{{ number_format($totalUnit, 0, ',', '.') }} Unit</span>
                </div>
            </form>
        </div>

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-pink">Riwayat Penjualan</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('laporan.cetak-pdf', request()->query()) }}" class="btn btn-pink">
                        <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
                    </a>
                    <a href="{{ route('laporan.cetak-excel', request()->query()) }}" class="btn btn-green">
                        <i class="bi bi-file-earmark-excel"></i> Cetak Excel
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No. Nota</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Unit</th>
                            <th>Total Belanja</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->nomor_nota }}</td>
                            <td>
                                @if($transaksi->pelanggan_id)
                                    {{ $transaksi->pelanggan->nama_pelanggan ?? 'Pelanggan Umum' }}
                                @else
                                    Pelanggan Umum
                                @endif
                            </td>
                            <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                            <td>{{ $transaksi->nama_produk }}</td>
                            <td>{{ $transaksi->qty }}</td>
                            <td>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                            <td><span class="badge bg-success">Lunas</span></td>
                            <td class="text-center">
                                <a href="{{ route('struk.show', $transaksi->id) }}" target="_blank" class="btn btn-sm btn-pink">
                                    <i class="bi bi-receipt"></i> Struk
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada transaksi pada tanggal ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>