<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_purchase_order',
        'id_mitra',
        'tanggal',
        'spk',
        'ba',
        'statuspo',
    ];

    protected $primaryKey = 'id_purchase_order';
    public $incrementing = false;

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }
}
