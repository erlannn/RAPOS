<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                <div class="flex gap-3">
                    <a href="{{ route('mutasistok.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-700 text-sm flex items-center">
                        + Tambah MutasiStok
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">Tanggal</th>
<th class="px-3 py-2 border">ProdukID</th>
<th class="px-3 py-2 border">StoreID</th>
<th class="px-3 py-2 border">JenisMutasi</th>
<th class="px-3 py-2 border">ReferensiTabel</th>
<th class="px-3 py-2 border">ReferensiID</th>
<th class="px-3 py-2 border">Qty</th>
<th class="px-3 py-2 border">SaldoSebelum</th>
<th class="px-3 py-2 border">SaldoSesudah</th>
<th class="px-3 py-2 border">Keterangan</th>
<th class="px-3 py-2 border">UserID</th>

                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mutasistok as $index => $item)
                                <tr>
                                    <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border">{{ $item->Tanggal }}</td>
<td class="px-3 py-2 border">{{ $item->ProdukID }}</td>
<td class="px-3 py-2 border">{{ $item->StoreID }}</td>
<td class="px-3 py-2 border">{{ $item->JenisMutasi }}</td>
<td class="px-3 py-2 border">{{ $item->ReferensiTabel }}</td>
<td class="px-3 py-2 border">{{ $item->ReferensiID }}</td>
<td class="px-3 py-2 border">{{ $item->Qty }}</td>
<td class="px-3 py-2 border">{{ $item->SaldoSebelum }}</td>
<td class="px-3 py-2 border">{{ $item->SaldoSesudah }}</td>
<td class="px-3 py-2 border">{{ $item->Keterangan }}</td>
<td class="px-3 py-2 border">{{ $item->UserID }}</td>

                                    <td class="px-3 py-2 border">
                                        <a href="{{ route('mutasistok.edit', $item->MutasiID) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs inline-block">Edit</a>
                                        <form action="{{ route('mutasistok.destroy', $item->MutasiID) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?');">
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