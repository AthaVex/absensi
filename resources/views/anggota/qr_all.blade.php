<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Semua QR Anggota</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($anggotas->isEmpty())
                <div class="bg-white p-6 rounded shadow text-center">
                    <p class="text-gray-500">Belum ada data anggota.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($anggotas as $anggota)
                        <div class="bg-white p-4 shadow rounded-lg text-center">
                            <div class="font-semibold text-gray-800">{{ $anggota->nama }}</div>
                            <div class="text-sm text-gray-500 mb-2">{{ $anggota->nomor_identitas }}</div>
                            <div class="flex justify-center">
                                {!! QrCode::size(150)->generate($anggota->qr_code) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('anggota.index') }}" class="text-blue-600 hover:underline">
                    ← Kembali ke daftar anggota
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
