<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    // Ini fungsi yang dituju oleh route('pos.index')
    public function index()
    {
        // Kamu bisa ganti 'pos.index' dengan nama view yang kamu punya.
        // Contoh: return view('pos.index'); 
        // Tapi karena kamu sedang di welcome, kita buat return simple dulu saja:
        return view('welcome'); 
    }

    // Fungsi lain (create, store, edit, dll) bisa ditambahkan di sini sesuai kebutuhan
}