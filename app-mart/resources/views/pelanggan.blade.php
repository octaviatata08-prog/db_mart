<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GITAOCMART - Pelanggan</title>
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
        .table-container { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1); }
        .table thead th { color: #d63384; }
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
                        <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
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
            <h1 class="display-4 fw-bold mb-3">Manajemen Pelanggan</h1>
            <p class="lead">Data pelanggan terintegrasi dengan transaksi toko Anda.</p>
        </div>
    </div>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-pink">Daftar Pelanggan</h4>
                <button class="btn btn-pink" data-bs-toggle="modal" data-bs-target="#tambahPelangganModal">
                    <i class="bi bi-person-plus"></i> Tambah Pelanggan
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggans as $pelanggan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pelanggan->nama_pelanggan }}</td>
                            <td>{{ $pelanggan->no_telepon ?: '-' }}</td>
                            <td>{{ $pelanggan->alamat ?: '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPelangganModal{{ $pelanggan->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data pelanggan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PELANGGAN -->
    <div class="modal fade" id="tambahPelangganModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 20px;">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-pink">Tambah Pelanggan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-pink">Simpan Pelanggan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT PELANGGAN (Loop untuk setiap pelanggan) -->
    @foreach($pelanggans as $pelanggan)
    <div class="modal fade" id="editPelangganModal{{ $pelanggan->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 20px;">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-pink">Edit Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ $pelanggan->no_telepon }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $pelanggan->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-pink">Update Pelanggan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>