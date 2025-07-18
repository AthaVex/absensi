<?php

// app/Models/Anggota.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';

    protected $fillable = [
        'nama',
        'nomor_identitas',
        'kelas',
        'jenis_kelamin',
        'qr_code',
    ];

    public function absensis()
    {
        return $this->hasMany(\App\Models\Absensi::class);
    }
}

