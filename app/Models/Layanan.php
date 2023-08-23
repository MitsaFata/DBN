<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_layanan',
        'id_mitra',
        'nama',
        'harga',
        'bandwidth',
        'status',
    ];

    protected $primaryKey = 'id_layanan';
}