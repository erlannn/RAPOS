<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                <div class="flex gap-3">
                    <a href="{{ route('store.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-700 text-sm flex items-center">
                        + Tambah Store
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">KodeStore</th>
<th class="px-3 py-2 border">NamaStore</th>
<th class="px-3 py-2 border">TipeLokasi</th>
<th class="px-3 py-2 border">Alamat</th>
<th class="px-3 py-2 border">NoTelp</th>
<th class="px-3 py-2 border">StatusAktif</th>

                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($store as $index => $item)
                                <tr>
                                    <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border">{{ $item->KodeStore }}</td>
<td class="px-3 py-2 border">{{ $item->NamaStore }}</td>
<td class="px-3 py-2 border">{{ $item->TipeLokasi }}</td>
<td class="px-3 py-2 border">{{ $item->Alamat }}</td>
<td class="px-3 py-2 border">{{ $item->NoTelp }}</td>
                            <td class="px-3 py-2 border text-center">
                                @if($item->StatusAktif == 1)
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>
                                @endif
                            </td>

                                    <td class="px-3 py-2 border">
                                        <a href="{{ route('store.edit', $item->StoreID) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs inline-block">Edit</a>
                                        <form action="{{ route('store.destroy', $item->StoreID) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-xs">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>