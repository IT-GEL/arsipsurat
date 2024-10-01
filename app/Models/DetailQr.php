<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailQr extends Model
{
    use HasFactory;

    protected $table = 'detail_qr';
    protected $fillable = ['nosurat', 'nama', 'NIK', 'jabatan', 'approve_at'];

    // Uncomment if using a custom primary key
    // protected $primaryKey = 'your_primary_key';
    // public $incrementing = false;

    // Enable timestamps if your table has them
    public $timestamps = true; // Optional
}
