<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Ringkasan --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white shadow p-5 rounded-xl text-center">
                    <p class="text-sm text-gray-500">Total Anggota</p>
                    <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Anggota::count() }}</p>
                </div>
                <div class="bg-white shadow p-5 rounded-xl text-center">
                    <p class="text-sm text-gray-500">Absensi Hari Ini</p>
                    <p class="text-3xl font-bold text-green-600">
                        {{ \App\Models\Absensi::whereDate('created_at', today())->count() }}
                    </p>
                </div>
                <div class="bg-white shadow p-5 rounded-xl text-center">
                    <p class="text-sm text-gray-500">Lokasi Valid</p>
                    <p class="text-3xl font-bold text-purple-600">{{ \App\Models\LokasiValid::count() }}</p>
                </div>
            </div>

            {{-- Menu Navigasi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('anggota.index') }}" class="block bg-white rounded-xl p-6 shadow hover:bg-slate-100 transition">
                    <h2 class="text-lg font-semibold mb-2">👥 Kelola Anggota</h2>
                    <p class="text-gray-600 text-sm">Lihat dan edit data anggota.</p>
                </a>
                <a href="{{ route('anggota.qrAll') }}" class="block bg-white rounded-xl p-6 shadow hover:bg-slate-100 transition">
                    <h2 class="text-lg font-semibold mb-2">🧾 Cetak QR Semua Anggota</h2>
                    <p class="text-gray-600 text-sm">Tampilkan semua QR siap cetak.</p>
                </a>
                <a href="{{ route('absen.form') }}" class="block bg-white rounded-xl p-6 shadow hover:bg-slate-100 transition">
                    <h2 class="text-lg font-semibold mb-2">📲 Form Absensi</h2>
                    <p class="text-gray-600 text-sm">Scan QR & kirim lokasi.</p>
                </a>
                <a href="{{ route('absensi.manual.form') }}" class="block bg-white rounded-xl p-6 shadow hover:bg-slate-100 transition">
                    <h2 class="text-lg font-semibold mb-2">✍️ Input Absensi Manual</h2>
                    <p class="text-gray-600 text-sm">Untuk izin/sakit anggota.</p>
                </a>
            </div>

            {{-- Tombol Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-6 bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded shadow">
                    🔓 Logout
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
