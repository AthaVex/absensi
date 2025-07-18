    <x-app-layout> <x-slot name="header"> <h2 class="font-semibold text-xl text-gray-800 leading-tight"> 📊 Rekap Absensi </h2> </x-slot>
php-template
Salin
Edit
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Hari</th>
                        <th class="px-4 py-2">Jam</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Keterangan</th>
                        <th class="px-4 py-2">Terlambat?</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($absensis as $absen)
                        <tr>
                            <td class="px-4 py-2">{{ $absen->anggota->nama }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($absen->tanggal)->isoFormat('dddd') }}</td>
                            <td class="px-4 py-2">{{ $absen->waktu }}</td>
                            <td class="px-4 py-2 capitalize">{{ $absen->status }}</td>
                            <td class="px-4 py-2">{{ $absen->keterangan ?? '-' }}</td>
                            <td class="px-4 py-2">
                                @if ($absen->status === 'masuk')
                                    @php
                                        $waktuAbsensi = \Carbon\Carbon::parse($absen->waktu);
                                        $batasTerlambat = \Carbon\Carbon::createFromTime(8, 0, 0);
                                    @endphp
                                    @if ($waktuAbsensi->gt($batasTerlambat))
                                        <span class="text-red-600 font-semibold">Ya</span>
                                    @else
                                        <span class="text-green-600">Tidak</span>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>