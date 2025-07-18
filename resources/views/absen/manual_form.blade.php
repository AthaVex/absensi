<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Input Manual Absensi (Izin / Sakit)
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('absensi.manual.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium">Nama Anggota</label>
                    <select name="anggota_id" class="w-full border border-gray-300 p-2 rounded">
                        @foreach ($anggotaList as $anggota)
                            <option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border border-gray-300 p-2 rounded" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Status</label>
                    <select name="status" class="w-full border border-gray-300 p-2 rounded">
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Keterangan (Opsional)</label>
                    <input type="text" name="keterangan" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan Absensi Manual
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
