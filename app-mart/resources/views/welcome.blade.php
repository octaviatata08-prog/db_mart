<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GITAOCMART - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #fff0f5; }

        /* GABUNGKAN NAVBAR & HERO DALAM SATU WRAPPER */
        .top-wrapper {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .navbar {
            margin-top: 20px;
            border-radius: 50px 50px 0 0; /* Sudut atas membulat, bawah menyatu dengan hero */
            background-color: #ffffff;
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.3);
            padding: 10px 20px;
            border-bottom: none;
            z-index: 10;
        }
        .navbar-nav .nav-link {
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 500;
            color: #555;
            transition: all 0.3s;
        }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active {
            color: white;
            background-color: #d63384;
        }

        /* STYLE LOGO */
        .logo-box {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ff758c 0%, #d63384 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin-right: 10px;
            box-shadow: 0 4px 10px rgba(214, 51, 132, 0.3);
        }
        .brand-text {
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #333;
        }
        .brand-text span {
            color: #d63384;
        }

        /* HERO SECTION - MENYATU DENGAN NAVBAR */
        .hero-section {
            background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
            color: white;
            border-radius: 0 0 30px 30px; /* Sudut bawah membulat, atas menyatu dengan navbar */
            padding: 60px 40px;
            margin-bottom: 50px;
        }
        
        .btn-hero {
            border-radius: 50px;
            background-color: white;
            color: #d63384;
            font-weight: bold;
            font-size: 1.2rem;
            padding: 15px 40px;
            white-space: nowrap;
        }
        .btn-hero:hover {
            background-color: #f8f9fa;
            color: #b02a6b;
        }

        .text-pink { color: #d63384; }

        /* FITUR UNGGULAN */
        .feature-card {
            transition: 0.3s;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1);
            height: 100%;
            text-decoration: none;
            color: inherit;
            background: white;
            margin-bottom: 20px;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(214, 51, 132, 0.2);
        }
        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #d63384;
            background-color: #fce4ec;
            margin: 0 auto 15px auto;
        }
        
        .chart-container { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1); }
        
        /* STATISTIK MINI CARDS */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 15px;
            box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1);
            text-decoration: none;
            color: inherit;
            transition: all 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(214, 51, 132, 0.2);
        }
        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: #333;
        }
        .stat-label {
            font-size: 0.8rem;
            color: #777;
            font-weight: 500;
        }

        /* TABEL */
        .table-container {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1);
        }
        .table thead th { color: #d63384; }
        
        /* PRODUK UNGGULAN CARDS */
        .product-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1);
            transition: all 0.3s;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(214, 51, 132, 0.2);
            color: inherit;
        }
        .product-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- GABUNGKAN NAVBAR & HERO -->
        <div class="top-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <!-- LOGO GITAOCMART -->
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                        <div class="logo-box"><i class="bi bi-bag-heart-fill"></i></div>
                        <span class="brand-text">GITA<span>OCMART</span></span>
                    </a>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('pos.index') }}">POS</a></li>
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

            <div class="hero-section d-flex justify-content-between align-items-center">
                <div class="text-start">
                    <h1 class="display-4 fw-bold mb-3">Selamat Datang di GITAOCMART</h1>
                    <p class="lead mb-0">Sistem Point of Sale (POS) untuk mengelola transaksi penjualan dengan mudah.</p>
                </div>
                <div class="ms-4">
                    <a href="{{ route('pos.index') }}" class="btn btn-hero">
                        <i class="bi bi-cart-check"></i> Mulai Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="container mb-5">
        <div class="row g-3">
            <div class="col-md-3">
                <a href="{{ route('laporan.index') }}" class="stat-card d-flex align-items-center">
                    <div class="stat-icon bg-success bg-opacity-10 text-success me-3"><i class="bi bi-cash-stack"></i></div>
                    <div>
                        <div class="stat-value">Rp {{ number_format(\App\Models\Transaksi::sum('total_bayar'), 0, ',', '.') }}</div>
                        <div class="stat-label">Total Pendapatan</div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('laporan.index') }}" class="stat-card d-flex align-items-center">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3"><i class="bi bi-receipt"></i></div>
                    <div>
                        <div class="stat-value">{{ \App\Models\Transaksi::count() }}</div>
                        <div class="stat-label">Total Transaksi</div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('produk.index') }}" class="stat-card d-flex align-items-center">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning me-3"><i class="bi bi-box-seam"></i></div>
                    <div>
                        <div class="stat-value">{{ \App\Models\Produk::count() }}</div>
                        <div class="stat-label">Total Produk</div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('pelanggan.index') }}" class="stat-card d-flex align-items-center">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger me-3"><i class="bi bi-people"></i></div>
                    <div>
                        <div class="stat-value">{{ \App\Models\Pelanggan::count() }}</div>
                        <div class="stat-label">Total Pelanggan</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- FITUR UNGGULAN -->
    <div class="container mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-pink">Fitur Unggulan</h2>
            <p class="text-muted">Kelola toko Anda dengan lebih mudah dan profesional</p>
        </div>

        <div class="row g-2">
            <div class="col-md-4 col-lg">
                <a href="{{ route('pos.index') }}" class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="icon-circle"><i class="bi bi-cart-check"></i></div>
                        <h5 class="card-title fw-bold text-pink">POS (Kasir)</h5>
                        <p class="card-text text-muted">Proses transaksi penjualan dengan cepat dan akurat.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg">
                <a href="{{ route('produk.index') }}" class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="icon-circle"><i class="bi bi-box-seam"></i></div>
                        <h5 class="card-title fw-bold text-pink">Manajemen Produk</h5>
                        <p class="card-text text-muted">Kelola stok dan data produk dengan mudah.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg">
                <a href="{{ route('laporan.index') }}" class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="icon-circle"><i class="bi bi-receipt"></i></div>
                        <h5 class="card-title fw-bold text-pink">Laporan Transaksi</h5>
                        <p class="card-text text-muted">Lihat riwayat dan laporan penjualan.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg">
                <a href="{{ route('pelanggan.index') }}" class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="icon-circle"><i class="bi bi-people"></i></div>
                        <h5 class="card-title fw-bold text-pink">Manajemen Pelanggan</h5>
                        <p class="card-text text-muted">Data pelanggan terintegrasi dengan transaksi.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg">
                <a href="{{ route('backup.index') }}" class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="icon-circle"><i class="bi bi-database-check"></i></div>
                        <h5 class="card-title fw-bold text-pink">Backup & Restore</h5>
                        <p class="card-text text-muted">Amankan data dengan backup dan pulihkan dengan restore.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- GRAFIK, PRODUK UNGGULAN & TRANSAKSI TERBARU -->
    <div class="container mb-5">
        <div class="chart-container mb-4">
            <h4 class="fw-bold text-pink text-center mb-4">Grafik Penjualan Bulanan</h4>
            <canvas id="salesChart" height="100"></canvas>
        </div>

        <div class="table-container mb-4">
            <h5 class="fw-bold text-pink mb-4">Produk Unggulan</h5>
            <div class="row g-3">
                @forelse(\App\Models\Produk::take(4)->get() as $produk)
                <div class="col-md-3">
                    <a href="{{ route('produk.index') }}" class="product-card text-center p-3">
                        @if($produk->foto)
                            <img src="{{ asset('storage/' . $produk->foto) }}" class="product-img mb-3" alt="{{ $produk->nama_produk }}">
                        @else
                            <div class="product-img mb-3 d-flex align-items-center justify-content-center bg-light text-muted">
                                <i class="bi bi-image" style="font-size: 2rem;"></i>
                            </div>
                        @endif
                        <h6 class="fw-bold text-pink mb-1">{{ $produk->nama_produk }}</h6>
                        <small class="text-muted d-block mb-2">{{ $produk->kategori }}</small>
                        <div class="d-flex justify-content-between px-2">
                            <span class="text-muted small">Stok: {{ $produk->stok }}</span>
                            <span class="fw-bold small">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada produk.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="table-container">
            <h5 class="fw-bold text-pink mb-4">Transaksi Terbaru</h5>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No. Nota</th>
                        <th>Tanggal</th>
                        <th>Nama Produk</th>
                        <th>Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Transaksi::latest()->limit(5)->get() as $transaksi)
                    <tr>
                        <td>{{ $transaksi->nomor_nota }}</td>
                        <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                        <td>{{ $transaksi->nama_produk }}</td>
                        <td>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('struk.show', $transaksi->id) }}" target="_blank" class="btn btn-sm btn-pink">
                                <i class="bi bi-receipt"></i> Struk
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada transaksi terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
                datasets: [{
                    label: 'Penjualan',
                    data: [1200000, 1900000, 1500000, 2500000, 2200000, 3000000, 2800000, 3500000, 3200000],
                    borderColor: '#d63384',
                    backgroundColor: 'rgba(214, 51, 132, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#d63384'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, grid: { color: '#fce4ec' } }, x: { grid: { display: false } } }
            }
        });
    </script>
</body>
</html>