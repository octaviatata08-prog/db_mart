<?php

namespace App\Jobs;

use App\Models\RiwayatExport;
use App\Models\Transaksi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ProsesExportLaporan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $format;
    protected $riwayatId;

    public function __construct($format, $riwayatId)
    {
        $this->format = $format;
        $this->riwayatId = $riwayatId;
    }

    public function handle()
    {
        $riwayat = RiwayatExport::find($this->riwayatId);
        $riwayat->update(['status' => 'processing']);

        try {
            $transaksi = Transaksi::all();
            $fileName = 'export_' . time() . '_' . uniqid();
            $path = '';

            if ($this->format === 'excel') {
                $fileName .= '.xls';
                $path = 'public/exports/' . $fileName;

                $content = "<table border='1'><tr><th>No. Nota</th><th>Tanggal</th><th>Nama Produk</th><th>Total</th></tr>";
                foreach ($transaksi as $t) {
                    $content .= "<tr><td>{$t->nomor_nota}</td><td>{$t->created_at->format('d-m-Y')}</td><td>{$t->nama_produk}</td><td>Rp " . number_format($t->total_bayar, 0, ',', '.') . "</td></tr>";
                }
                $content .= "</table>";
                Storage::put($path, $content);
            } 
            elseif ($this->format === 'pdf') {
                $fileName .= '.pdf';
                $path = 'public/exports/' . $fileName;
                
                $pdf = Pdf::loadView('laporan_pdf', compact('transaksi'));
                Storage::put($path, $pdf->output());
            }

            $riwayat->update([
                'status' => 'completed',
                'file_url' => Storage::url($path)
            ]);

        } catch (\Exception $e) {
            $riwayat->update(['status' => 'failed']);
            throw $e;
        }
    }
}