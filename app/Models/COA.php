<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class COA extends Model
{
    use HasFactory;

    protected $table = 'coa';
    protected $fillable = ['vendor', 'nama', 'NIK', 'jabatan', 'approve_at'];

    // Uncomment if using a custom primary key
    // protected $primaryKey = 'your_primary_key';
    // public $incrementing = false;

    // Enable timestamps if your table has them
    public $timestamps = true; // Optional
}
