<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Anggota</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('anggota.update', $anggota->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $anggota->nama) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Nomor Identitas</label>
                    <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas', $anggota->nomor_identitas) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                </div>

               <div class="mb-4">
    <label class="block text-gray-700">Jenis Kelamin</label>
    <select name="jenis_kelamin" class="w-full mt-1 p-2 border border-gray-300 rounded" required>
        <option value="L" {{ $anggota->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ $anggota->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>


                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
