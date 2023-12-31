<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pelanggan',
        'id_mitra',
        'nama_pel',
        'alamat',
        'email',
        'no_telp',
        'nik',
        'npwp',
        'foto',
        'statuspel',
    ];

    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }
}
