<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Anggota</h2>
    </x-slot>

    <div class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">📋 Data Anggota</h3>
                    <a href="{{ route('anggota.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                        ➕ Tambah Anggota
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Nama</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">NIM/NIK</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Jenis Kelamin</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($anggotas as $anggota)
                                <tr>
                                    <td class="px-4 py-2">{{ $anggota->nama }}</td>
                                    <td class="px-4 py-2">{{ $anggota->nomor_identitas }}</td>
                                    <td class="px-4 py-2">{{ $anggota->jenis_kelamin }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('anggota.show', $anggota->id) }}"
                                           class="text-blue-600 hover:underline text-sm">Lihat QR</a>

                                        <a href="{{ route('anggota.edit', $anggota->id) }}"
                                           class="text-green-600 hover:underline text-sm">Edit</a>

                                        <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada data anggota.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
