<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DQR extends Model
{
    use HasFactory;

    protected $table = 'detail_qr'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel

    // Jika tidak menggunakan timestamps (created_at, updated_at)
    //public $timestamps = false;

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['nosurat', 'name', 'NIK', 'jabatan', 'qrCodeUrl', 'approve_at']; // Sesuaikan dengan kolom di tabel profile
}
