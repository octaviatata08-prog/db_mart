<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GITAOCMART - Backup & Restore</title>
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

        /* STYLE LOGO */
        .logo-box { width: 40px; height: 40px; background: linear-gradient(135deg, #ff758c 0%, #d63384 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; margin-right: 10px; box-shadow: 0 4px 10px rgba(214, 51, 132, 0.3); }
        .brand-text { font-size: 1.2rem; font-weight: 800; letter-spacing: -0.5px; color: #333; }
        .brand-text span { color: #d63384; }

        .hero-section { background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); color: white; border-radius: 0 0 30px 30px; padding: 60px 0; text-align: center; margin-bottom: 40px; }
        .card-custom { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1); }
        
        .btn-danger-outline { border: 1px solid #dc3545; color: #dc3545; background-color: transparent; border-radius: 8px; padding: 8px 16px; font-size: 0.9rem; font-weight: 500; transition: all 0.3s; }
        .btn-danger-outline:hover { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- LOGO BARU -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    <div class="logo-box"><i class="bi bi-bag-heart-fill"></i></div>
                    <span class="brand-text">GITA<span>OCMART</span></span>
                </a>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pos.index') }}">POS</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('produk.index') }}">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ route('backup.index') }}">Backup</a></li>
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

    <!-- HERO -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Backup & Restore Database</h1>
            <p class="lead">Kelola keamanan data database toko Anda.</p>
        </div>
    </div>

    <!-- KONTEN -->
    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Card Backup -->
            <div class="col-md-6">
                <div class="card-custom h-100">
                    <h4 class="fw-bold text-pink mb-3">📥 Backup Database</h4>
                    <p class="text-muted">
                        Unduh seluruh data dari database <b>db_mart</b> ke dalam bentuk file <code>.sql</code>. 
                        Simpan file ini di tempat yang aman.
                    </p>
                    <a href="{{ route('backup.download') }}" class="btn btn-pink mt-auto">
                        <i class="bi bi-download"></i> Download Backup (.sql)
                    </a>
                </div>
            </div>

            <!-- Card Restore -->
            <div class="col-md-6">
                <div class="card-custom h-100">
                    <h4 class="fw-bold text-pink mb-3">📤 Restore Database</h4>
                    <p class="text-muted text-danger fw-medium">
                        Peringatan: Melakukan restore akan menimpa (overwrite) data saat ini dengan data dari file backup.
                    </p>
                    
                    <form action="{{ route('backup.upload') }}" method="POST" enctype="multipart/form-data" class="mt-auto">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="file_sql" accept=".sql" class="form-control" required>
                            @error('file_sql') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-pink w-100">
                            <i class="bi bi-upload"></i> Restore Data
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- CARD KOSONGKAN DATA -->
        <div class="card-custom mt-4" style="border-left: 4px solid #dc3545;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold text-danger mb-1" style="font-size: 1.2rem;">⚠️ Kosongkan Data</h4>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">
                        Hapus semua data di database (produk, pelanggan, transaksi). Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
                <div>
                    <form action="{{ route('backup.clear') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan SEMUA data? Tindakan ini tidak bisa dibatalkan!')">
                        @csrf
                        <button type="submit" class="btn btn-danger-outline">
                            <i class="bi bi-trash3"></i> Kosongkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>