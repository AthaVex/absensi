<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Absensi;
use App\Models\LokasiValid;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    // Menampilkan form absensi
    public function form()
    {
        return view('absen.form');
    }

    // Menyimpan data absensi
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'qr_code' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Cari anggota berdasarkan QR code
        $anggota = Anggota::where('qr_code', $request->qr_code)->first();

        if (!$anggota) {
            return back()->with('error', 'QR tidak valid');
        }

        $userLat = $request->latitude;
        $userLng = $request->longitude;

        // Ambil semua lokasi valid dari DB
        $lokasiValidList = LokasiValid::all();
        $lokasiCocok = false;

        // Cek apakah lokasi pengguna berada dalam radius yang diizinkan
        foreach ($lokasiValidList as $lokasi) {
            $jarak = $this->hitungJarak($userLat, $userLng, $lokasi->latitude, $lokasi->longitude);
            if ($jarak <= $lokasi->radius_meter) {
                $lokasiCocok = true;
                break;
            }
        }

        if (!$lokasiCocok) {
            return back()->with('error', 'Lokasi tidak valid. Anda di luar area absensi.');
        }

        // Tentukan status: "masuk" jika <= 09:05, "terlambat" jika lebih
        $waktuSekarang = Carbon::now();
        $batasTerlambat = Carbon::createFromTime(9, 5, 0);
        $status = $waktuSekarang->lessThanOrEqualTo($batasTerlambat) ? 'masuk' : 'terlambat';

        // Simpan data absensi ke database
        Absensi::create([
            'anggota_id' => $anggota->id,
            'tanggal' => $waktuSekarang->toDateString(),
            'waktu' => $waktuSekarang->toTimeString(),
            'latitude' => $userLat,
            'longitude' => $userLng,
            'status' => $status,
            'keterangan' => null,
            'scan_valid' => true,
            'qr_token' => null
        ]);

        return back()->with('success', 'Absensi berhasil');
    }

    // Fungsi menghitung jarak antara dua titik koordinat (hasil dalam meter)
    private function hitungJarak($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000; // meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    // Menampilkan rekap absensi untuk hari ini
    public function rekapHarian()
    {
        $tanggalHariIni = Carbon::now()->toDateString();

        $rekap = Absensi::with('anggota')
            ->where('tanggal', $tanggalHariIni)
            ->orderBy('waktu', 'asc')
            ->get();

        return view('absensi.rekap_harian', compact('rekap', 'tanggalHariIni'));
    }
}
