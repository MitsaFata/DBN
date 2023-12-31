<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pinjaman',
        'id_mitra',
        'tanggal',
        'tenggat',
        'total',
        'statuspinj',
    ];

    protected $primaryKey = 'id_pinjaman';
    public $incrementing = false;

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }
}
