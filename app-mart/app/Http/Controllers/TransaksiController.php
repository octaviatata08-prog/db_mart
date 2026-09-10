<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $pelanggans = Pelanggan::all();
        return view('pos', compact('produks', 'pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'qty' => 'required|integer|min:1',
            'pelanggan_id' => 'nullable|exists:pelanggans,id',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        if ($produk->stok < $request->qty) {
            return back()->with('error', "Stok {$produk->nama_produk} tidak mencukupi! Sisa stok: {$produk->stok}");
        }

        $produk->stok = $produk->stok - $request->qty;
        $produk->save();

        // GANTI NOMOR NOTA JADI PASTI UNIK (Pakai Mikrodetik)
        $nomorNota = 'TRX-' . now()->format('YmdHis') . '-' . substr(uniqid(), -4);

        $transaksi = Transaksi::create([
            'nomor_nota' => $nomorNota,
            'pelanggan_id' => $request->pelanggan_id,
            'nama_produk' => $produk->nama_produk,
            'harga' => $produk->harga,
            'qty' => $request->qty,
            'total_bayar' => $produk->harga * $request->qty,
        ]);

        return redirect()->route('laporan.index')->with('success', "Transaksi berhasil! Stok {$produk->nama_produk} berkurang {$request->qty} unit. Silakan cetak struk di bawah.");
    }
}