<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GITAOCMART - Kasir (POS)</title>
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

        .logo-box { width: 40px; height: 40px; background: linear-gradient(135deg, #ff758c 0%, #d63384 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; margin-right: 10px; box-shadow: 0 4px 10px rgba(214, 51, 132, 0.3); }
        .brand-text { font-size: 1.2rem; font-weight: 800; letter-spacing: -0.5px; color: #333; }
        .brand-text span { color: #d63384; }

        .hero-section { background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); color: white; border-radius: 0 0 30px 30px; padding: 60px 0; text-align: center; margin-bottom: 40px; }
        .form-card { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1); }
        .form-control:focus { border-color: #d63384; box-shadow: 0 0 0 0.25rem rgba(214, 51, 132, 0.25); }
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

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Halaman Kasir (POS)</h1>
            <p class="lead">Silakan lakukan proses transaksi penjualan di sini.</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-card">
                    <h5 class="fw-bold text-pink mb-4">Form Transaksi</h5>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('pos.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="pelanggan_id" class="form-label">Pilih Pelanggan</label>
                            <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                                <option value="">-- Pelanggan Umum --</option>
                                @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="produk_id" class="form-label">Pilih Produk</label>
                            <select name="produk_id" id="produk_id" class="form-control" required onchange="updateHarga()">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($produks as $produk)
                                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}">
                                        {{ $produk->nama_produk }} (Stok: {{ $produk->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Satuan</label>
                            <input type="number" class="form-control" id="harga" name="harga" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="qty" class="form-label">Jumlah (Qty)</label>
                            <input type="number" class="form-control" id="qty" name="qty" required oninput="hitungTotal()">
                        </div>

                        <button type="submit" class="btn btn-pink w-100">Proses Transaksi</button>
                    </form>

                    <hr class="my-4">
                    <h5 class="text-center">Total Pembayaran: <span class="fw-bold text-pink" id="totalBayar">Rp 0</span></h5>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const produkSelect = document.getElementById('produk_id');
        const hargaInput = document.getElementById('harga');
        const qtyInput = document.getElementById('qty');
        const totalBayar = document.getElementById('totalBayar');

        function updateHarga() {
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            hargaInput.value = harga;
            hitungTotal();
        }

        function hitungTotal() {
            const harga = parseFloat(hargaInput.value) || 0;
            const qty = parseFloat(qtyInput.value) || 0;
            totalBayar.innerText = 'Rp ' + (harga * qty).toLocaleString('id-ID');
        }
    </script>
</body>
</html>