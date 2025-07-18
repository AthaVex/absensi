<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Absensi;
use App\Models\LokasiValid;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    // Form scan QR
    public function form()
    {
        return view('absen.form');
    }

    // Simpan hasil scan QR
    public function store(Request $request)
    {
        $request->validate([
            'qr_code'   => 'required',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $anggota = Anggota::where('qr_code', $request->qr_code)->first();
        if (!$anggota) {
            return back()->with('error', 'QR tidak valid.');
        }

        $userLat = $request->latitude;
        $userLng = $request->longitude;

        $lokasiValid = LokasiValid::all();
        $lokasiCocok = $lokasiValid->contains(function ($lokasi) use ($userLat, $userLng) {
            return $this->hitungJarak($userLat, $userLng, $lokasi->latitude, $lokasi->longitude) <= $lokasi->radius_meter;
        });

        if (!$lokasiCocok) {
            return back()->with('error', 'Lokasi tidak valid.');
        }

        $now = Carbon::now();
        $batasMasuk = Carbon::createFromTime(9, 5, 0);
        $status = $now->lessThanOrEqualTo($batasMasuk) ? 'masuk' : 'terlambat';

        Absensi::create([
            'anggota_id' => $anggota->id,
            'tanggal'    => $now->toDateString(),
            'waktu'      => $now->toTimeString(),
            'latitude'   => $userLat,
            'longitude'  => $userLng,
            'status'     => $status,
            'keterangan' => null,
            'scan_valid' => true,
            'qr_token'   => null,
        ]);

        return back()->with('success', 'Absensi berhasil dicatat.');
    }

    // Form absensi manual
    public function manualForm()
    {
        $anggotaList = Anggota::all();
        return view('absen.manual_form', compact('anggotaList'));
    }

    // Simpan absensi manual
    public function manualStore(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal'    => 'required|date',
            'status'     => 'required|in:izin,sakit',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Absensi::create([
            'anggota_id' => $request->anggota_id,
            'tanggal'    => $request->tanggal,
            'waktu'      => Carbon::now()->toTimeString(),
            'latitude'   => null,
            'longitude'  => null,
            'status'     => $request->status,
            'keterangan' => $request->keterangan,
            'scan_valid' => false,
            'qr_token'   => null,
        ]);

        return back()->with('success', 'Absensi manual berhasil disimpan.');
    }

    // Rekap absensi harian
    public function rekapHarian()
    {
        $tanggal = Carbon::now()->toDateString();
        $rekap = Absensi::with('anggota')
                    ->where('tanggal', $tanggal)
                    ->orderBy('waktu', 'asc')
                    ->get();

        return view('absensi.rekap_harian', compact('rekap', 'tanggal'));
    }

    // Hitung jarak dari koordinat
    private function hitungJarak($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000; // meter
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) ** 2 +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) ** 2;

        return 2 * $earthRadius * atan2(sqrt($a), sqrt(1 - $a));
    }
}
