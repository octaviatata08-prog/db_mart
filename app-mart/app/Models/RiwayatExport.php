<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatExport extends Model
{
    use HasFactory;

    protected $fillable = ['nama_file', 'format', 'status', 'file_url'];
}