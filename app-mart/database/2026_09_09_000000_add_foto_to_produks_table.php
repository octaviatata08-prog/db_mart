<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Pastikan tabel 'produks' sudah ada di database
        if (Schema::hasTable('produks')) {
            Schema::table('produks', function (Blueprint $table) {
                if (!Schema::hasColumn('produks', 'foto')) {
                    $table->string('foto')->nullable()->after('stok');
                }
            });
        }
    }

    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};