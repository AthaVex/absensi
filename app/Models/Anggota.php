<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'nama',
        'nomor_identitas',
        'jenis_kelamin',
        'qr_code'
    ];
}
