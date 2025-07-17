<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rekap Absensi: {{ $anggota->nama }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow rounded">
            @if($absensis->isEmpty())
                <p class="text-gray-500">Belum ada data absensi.</p>
            @else
                <table class="min-w-full table-auto text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600 font-semibold">
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Waktu</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Keterangan</th>
                            <th class="px-4 py-2">Lokasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($absensis as $absen)
                            <tr>
                                <td class="px-4 py-2">{{ $absen->tanggal }}</td>
                                <td class="px-4 py-2">{{ $absen->waktu }}</td>
                                <td class="px-4 py-2">{{ $absen->status }}</td>
                                <td class="px-4 py-2">{{ $absen->keterangan ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    <iframe
                                        width="200"
                                        height="150"
                                        frameborder="0"
                                        style="border:0"
                                        src="https://maps.google.com/maps?q={{ $absen->latitude }},{{ $absen->longitude }}&hl=es;z=16&output=embed">
                                    </iframe>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <div class="mt-4">
                <a href="{{ route('anggota.index') }}" class="text-blue-600 hover:underline">
                    ← Kembali ke daftar anggota
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
