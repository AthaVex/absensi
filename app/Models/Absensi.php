<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'tanggal',
        'waktu',
        'latitude',
        'longitude',
        'status',
        'keterangan',
        'scan_valid',
        'qr_token'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
