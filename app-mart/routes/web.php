<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/pos', [TransaksiController::class, 'index'])->name('pos.index');
Route::post('/pos', [TransaksiController::class, 'store'])->name('pos.store');

// Route Struk
Route::get('/struk/{id}', function ($id) {
    $transaksi = \App\Models\Transaksi::findOrFail($id);
    return view('struk', compact('transaksi'));
})->name('struk.show');

// Route Laporan (dengan Total Unit)
Route::get('/laporan', function (Request $request) {
    $transaksis = \App\Models\Transaksi::query();

    if ($request->filled('tanggal')) {
        $transaksis->whereDate('created_at', $request->tanggal);
    }

    $data = $transaksis->get();
    $totalUnit = $data->sum('qty');

    return view('laporan', [
        'transaksis' => $data,
        'totalUnit' => $totalUnit
    ]);
})->name('laporan.index');

// Cetak PDF
Route::get('/laporan/cetak-pdf', function (Request $request) {
    $transaksis = \App\Models\Transaksi::query();

    if ($request->filled('tanggal')) {
        $transaksis->whereDate('created_at', $request->tanggal);
    }

    $data = [
        'transaksis' => $transaksis->get(),
        'tanggal' => $request->tanggal ?? 'Semua Tanggal'
    ];

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan_pdf', $data);
    return $pdf->download('laporan-transaksi-' . now()->format('d-m-Y') . '.pdf');
})->name('laporan.cetak-pdf');

// Cetak Excel
Route::get('/laporan/cetak-excel', function (Request $request) {
    $transaksis = \App\Models\Transaksi::query();

    if ($request->filled('tanggal')) {
        $transaksis->whereDate('created_at', $request->tanggal);
    }

    $items = $transaksis->get();
    $tanggal = $request->tanggal ?? 'Semua Tanggal';

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=laporan-transaksi-" . now()->format('d-m-Y') . ".xls");

    echo "<table border='1'>";
    echo "<tr><th colspan='5'>Laporan Transaksi - GITAOCMART (Tanggal: $tanggal)</th></tr>";
    echo "<tr><th>No. Nota</th><th>Tanggal</th><th>Nama Produk</th><th>Total Belanja</th><th>Status</th></tr>";
    foreach ($items as $t) {
        echo "<tr>";
        echo "<td>" . $t->nomor_nota . "</td>";
        echo "<td>" . $t->created_at->format('d-m-Y') . "</td>";
        echo "<td>" . $t->nama_produk . "</td>";
        echo "<td>Rp " . number_format($t->total_bayar, 0, ',', '.') . "</td>";
        echo "<td>Lunas</td>";
        echo "</tr>";
    }
    echo "</table>";
    exit;
})->name('laporan.cetak-excel');

// Route Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');

// Route Pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

// Route Backup & Restore
Route::get('/backup-restore', [BackupController::class, 'index'])->name('backup.index');
Route::get('/backup-restore/download', [BackupController::class, 'backup'])->name('backup.download');
Route::post('/backup-restore/upload', [BackupController::class, 'restore'])->name('backup.upload');
Route::post('/backup-restore/clear', [BackupController::class, 'clearData'])->name('backup.clear');