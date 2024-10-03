<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $fillable = ['feedback', 'users', 'acc']; // Add username to fillable fields

    public $timestamps = true; // Optional
}
