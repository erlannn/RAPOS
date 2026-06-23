<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Barang Masuk</h2>
                <a href="{{ route('inventori.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">Kembali</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">PO ID</th>
                                <th class="px-3 py-2 border">Produk</th>
                                <th class="px-3 py-2 border">Supplier</th>
                                <th class="px-3 py-2 border">Jumlah Beli</th>
                                <th class="px-3 py-2 border">Aksi Terima</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingPOs as $po)
                            <tr>
                                <td class="px-3 py-2 border text-center">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2 border text-center">PO-{{ str_pad($po->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-3 py-2 border">{{ $po->produk->NamaProduk ?? 'N/A' }}</td>
                                <td class="px-3 py-2 border">{{ $po->supplier->NamaSupplier ?? 'N/A' }}</td>
                                <td class="px-3 py-2 border text-center">{{ $po->JumlahBeli }}</td>
                                <td class="px-3 py-2 border text-center">
                                    <form action="{{ route('inventory.incoming.receive', $po->id) }}" method="POST" class="inline-flex gap-2 items-center">
                                        @csrf
                                        <input type="number" name="jumlah_diterima" value="{{ $po->JumlahBeli }}" min="1" max="{{ $po->JumlahBeli }}" class="border-gray-300 rounded-md w-20 text-sm" required>
                                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600">Terima</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-3 py-4 border text-center text-gray-500">Tidak ada PO yang tertunda</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>