<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">QR Anggota</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded-lg text-center">
            <h3 class="text-lg font-semibold mb-4">Nama: {{ $anggota->nama }}</h3>
            <p class="text-gray-600 mb-4">Nomor Identitas: {{ $anggota->nomor_identitas }}</p>

            <div class="flex justify-center my-4">
                {!! QrCode::size(200)->generate($anggota->qr_code) !!}
            </div>

            <a href="{{ route('anggota.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">
                ← Kembali ke Daftar Anggota
            </a>
        </div>
    </div>
</x-app-layout>
