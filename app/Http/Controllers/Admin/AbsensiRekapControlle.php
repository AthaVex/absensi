<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AbsensiRekapController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::with(['absensis' => function ($q) {
            $q->whereDate('tanggal', now());
        }])->get();

        return view('admin.anggota.rekap', compact('anggotas'));
    }

    // Hitung jarak antara dua koordinat
    private function hitungJarak($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000; // Radius Bumi dalam meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Jarak dalam meter
    }
}
