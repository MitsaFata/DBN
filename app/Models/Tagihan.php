<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tagihan',
        'id_laypel',
        'tanggal_bayar',
        'tanggal_deadline',
        'pajak',
        'telat',
        'bayar',
        'sisa',
        'statustagihan',
    ];

    protected $primaryKey = 'id_tagihan';
    public $incrementing = false;

    public function laypel()
    {
        return $this->belongsTo(Laypel::class, 'id_laypel', 'id_laypel');
    }
}
