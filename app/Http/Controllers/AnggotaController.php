<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Absensi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AnggotaController extends Controller
{
    // Tampilkan daftar semua anggota
    public function index()
    {
        $anggotas = Anggota::all();
        return view('anggota.index', compact('anggotas'));
    }

    // Tampilkan detail anggota + QR
    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }

    // Form tambah anggota
    public function create()
    {
        return view('anggota.create');
    }

    // Simpan anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_identitas' => 'required|string|max:100|unique:anggotas',
            'jenis_kelamin' => 'required|in:L,P'
        ]);

        $anggota = new Anggota();
        $anggota->nama = $request->nama;
        $anggota->nomor_identitas = $request->nomor_identitas;
        $anggota->jenis_kelamin = $request->jenis_kelamin;
        $anggota->qr_code = $request->nomor_identitas;
        $anggota->save();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    // Edit anggota
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    // Update anggota
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_identitas' => 'required|string|max:100|unique:anggotas,nomor_identitas,' . $id,
            'jenis_kelamin' => 'required|in:L,P'
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update([
            'nama' => $request->nama,
            'nomor_identitas' => $request->nomor_identitas,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    // Hapus anggota (opsional)
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }

    // Tampilkan semua QR anggota
    public function qrAll()
    {
        $anggotas = Anggota::all();
        return view('anggota.qr_all', compact('anggotas'));
    }

    // Tampilkan rekap absensi per anggota
    public function rekap($id)
    {
        $anggota = Anggota::findOrFail($id);
        $absensis = Absensi::where('anggota_id', $id)->orderBy('tanggal', 'desc')->get();

        return view('anggota.rekap', compact('anggota', 'absensis'));
    }
}
