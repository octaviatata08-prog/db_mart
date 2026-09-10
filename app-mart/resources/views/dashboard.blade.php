<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - GITA OCTAVIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
            padding: 0;
        }
        .sidebar .brand {
            padding: 20px 25px;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar .brand h4 {
            font-weight: 700;
            margin: 0;
        }
        .sidebar .brand small {
            opacity: 0.7;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 25px;
            border-radius: 0;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.15);
            border-left: 3px solid #3498db;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }
        .main-content {
            padding: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s;
            border: none;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .stat-card .icon {
            font-size: 32px;
            color: #3498db;
        }
        .stat-card .number {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
        }
        .stat-card .label {
            color: #7f8c8d;
            font-size: 14px;
        }
        .topbar {
            background: white;
            padding: 15px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        .topbar h3 {
            margin: 0;
            color: #2c3e50;
        }
        .topbar .user-info {
            color: #7f8c8d;
        }
        .btn-pos {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-pos:hover {
            transform: scale(1.05);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            color: #7f8c8d;
            border-top: 1px solid #ecf0f1;
            margin-top: 30px;
        }
        .footer strong {
            color: #2c3e50;
        }
        .table-dashboard {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .table-dashboard thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            color: #495057;
        }
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
            .main-content {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="brand">
                    <h4>GITA OCTAVIA</h4>
                    <small>System Online</small>
                </div>
                <ul class="nav flex-column mt-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}">
                            <i class="bi bi-grid-1x2-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pos.index') }}">
                            <i class="bi bi-cart-check"></i> Kasir / POS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-boxes"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-receipt"></i> Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-people"></i> Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-gear"></i> Pengaturan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Top Bar -->
                <div class="topbar d-flex justify-content-between align-items-center">
                    <div>
                        <h3>Dashboard</h3>
                        <small class="text-muted">Selamat datang kembali, Admin!</small>
                    </div>
                    <div>
                        <a href="{{ route('pos.index') }}" class="btn-pos">
                            <i class="bi bi-cart-check"></i> Buka Kasir
                        </a>
                    </div>
                </div>

                <!-- Statistik Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="number">Rp 12.5M</div>
                                    <div class="label">Total Pendapatan</div>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="number">156</div>
                                    <div class="label">Total Transaksi</div>
                                </div>
                                <div class="icon" style="color: #27ae60;">
                                    <i class="bi bi-receipt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="number">45</div>
                                    <div class="label">Produk Terjual</div>
                                </div>
                                <div class="icon" style="color: #f39c12;">
                                    <i class="bi bi-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="number">23</div>
                                    <div class="label">Pelanggan Baru</div>
                                </div>
                                <div class="icon" style="color: #e74c3c;">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Transaksi Terbaru -->
                <div class="table-dashboard">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold">Transaksi Terbaru</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#001</td>
                                    <td>Budi Santoso</td>
                                    <td>Rp 150.000</td>
                                    <td>08 Sep 2026</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td>#002</td>
                                    <td>Ani Wijaya</td>
                                    <td>Rp 75.000</td>
                                    <td>08 Sep 2026</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td>#003</td>
                                    <td>Citra Dewi</td>
                                    <td>Rp 200.000</td>
                                    <td>07 Sep 2026</td>
                                    <td><span class="badge bg-warning">Proses</span></td>
                                </tr>
                                <tr>
                                    <td>#004</td>
                                    <td>Doni Permana</td>
                                    <td>Rp 50.000</td>
                                    <td>07 Sep 2026</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <i class="bi bi-heart-fill" style="color: #e74c3c;"></i>
                    <strong>GITA OCTAVIA</strong> · System Online
                    <br>
                    <small>v1.0.0</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>