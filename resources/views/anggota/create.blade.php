<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Anggota</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
            <form action="{{ route('anggota.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Nomor Identitas (NIM/NIK)</label>
                    <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
