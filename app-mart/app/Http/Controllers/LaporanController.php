<?php

namespace App\Http\Controllers;

use App\Jobs\ProsesExportLaporan;
use App\Models\RiwayatExport;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        return view('laporan', compact('transaksis'));
    }

    public function exportApi(Request $request)
    {
        // Validasi format
        $request->validate([
            'format' => 'required|in:pdf,excel'
        ]);

        $format = $request->input('format', 'excel');

        // Simpan ke tabel riwayat (Tabel ini SUDAH ADA sekarang)
        $riwayat = RiwayatExport::create([
            'nama_file' => 'Laporan Transaksi ' . date('Y-m-d H:i'),
            'format' => $format,
            'status' => 'pending'
        ]);

        // Dispatch ke Background
        ProsesExportLaporan::dispatch($format, $riwayat->id);

        return response()->json([
            'message' => 'Proses export ' . strtoupper($format) . ' sedang berjalan di latar belakang.',
            'riwayat_id' => $riwayat->id
        ]);
    }

    public function riwayatExport()
    {
        $riwayat = RiwayatExport::orderBy('created_at', 'desc')->get();
        return response()->json($riwayat);
    }
}