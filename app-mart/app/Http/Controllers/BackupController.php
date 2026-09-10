<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup');
    }

    public function backup()
    {
        $filename = "backup-db_mart-" . date('Y-m-d_H-i-s') . ".sql";
        $storagePath = storage_path('app/public/' . $filename);

        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $host = env('DB_HOST');

        $mysqlBinPath = 'C:\xampp\mysql\bin';
        $mysqldump = $mysqlBinPath . '\mysqldump.exe';

        $passwordStr = $password ? "-p{$password}" : "";
        $command = "\"{$mysqldump}\" -h {$host} -u {$user} {$passwordStr} {$database} > \"{$storagePath}\"";

        exec($command);

        if (File::exists($storagePath)) {
            return response()->download($storagePath)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Gagal melakukan backup database. Pastikan XAMPP terinstal di C:\xampp.');
    }

    public function restore(Request $request)
    {
        $request->validate([
            'file_sql' => 'required|file|max:102400',
        ]);

        $file = $request->file('file_sql');
        $extension = $file->getClientOriginalExtension();
        if (strtolower($extension) !== 'sql') {
            return back()->with('error', 'File harus berformat .sql');
        }

        $filePath = $file->getRealPath();

        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $host = env('DB_HOST');

        $mysqlBinPath = 'C:\xampp\mysql\bin';
        $mysql = $mysqlBinPath . '\mysql.exe';

        $passwordStr = $password ? "-p{$password}" : "";
        $command = "\"{$mysql}\" -h {$host} -u {$user} {$passwordStr} {$database} < \"{$filePath}\"";

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            return back()->with('success', 'Database berhasil di-restore!');
        }

        return back()->with('error', 'Gagal melakukan restore database. Pastikan XAMPP terinstal di C:\xampp.');
    }

    public function clearData()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $tables = ['produks', 'pelanggans', 'transaksis', 'users']; 
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        return back()->with('success', 'Semua data berhasil dikosongkan!');
    }
}