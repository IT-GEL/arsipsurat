<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PR extends Model
{
    use HasFactory;

    protected $table = 'profile'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel

    // Jika tidak menggunakan timestamps (created_at, updated_at)
    //public $timestamps = false;

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['name', 'NIK', 'jabatan', ]; // Sesuaikan dengan kolom di tabel profile
}
