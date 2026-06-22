<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Stock Barang</h2>
                <a href="{{ route('inventori.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">ProdukID</th>
                                <th class="px-3 py-2 border">StoreID</th>
                                <th class="px-3 py-2 border">Stok Saat Ini</th>
                                <th class="px-3 py-2 border">Minimum Stok</th>
                                <th class="px-3 py-2 border">Harga Beli Terakhir</th>
                                <th class="px-3 py-2 border">Harga Jual</th>
                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventori as $index => $item)
                                <tr>
                                    <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border">{{ $item->ProdukID }}</td>
                                    <td class="px-3 py-2 border">{{ $item->StoreID }}</td>
                                    <td class="px-3 py-2 border">{{ $item->StokSaatIni }}</td>
                                    <td class="px-3 py-2 border">{{ $item->MinimumStok }}</td>
                                    <td class="px-3 py-2 border">{{ $item->HargaBeliTerakhir }}</td>
                                    <td class="px-3 py-2 border">{{ $item->HargaJual }}</td>
                                    <td class="px-3 py-2 border text-center">
                                        <a href="{{ route('inventori.edit', $item->InventoriID) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs inline-block">Edit</a>
                                        <form action="{{ route('inventori.destroy', $item->InventoriID) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?');">
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
