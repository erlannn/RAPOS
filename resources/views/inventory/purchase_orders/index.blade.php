<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto ">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Purchase Order</h2>
                <a href="{{ route('purchase-order.create') }}" class="bg-blue-500 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-600 text-sm">Tambah PO</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    <table class="min-w-full border border-gray-200 text-xs">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">PO ID</th>
                                <th class="px-3 py-2 border">Status</th>
                                <th class="px-3 py-2 border">SKU</th>
                                <th class="px-3 py-2 border">Nama Produk</th>
                                <th class="px-3 py-2 border">Supplier</th>
                                <th class="px-3 py-2 border">Min</th>
                                <th class="px-3 py-2 border">Max</th>
                                <th class="px-3 py-2 border">Jumlah Beli</th>
                                <th class="px-3 py-2 border">Satuan</th>
                                <th class="px-3 py-2 border">Isi/Kardus</th>
                                <th class="px-3 py-2 border">Harga Satuan</th>
                                <th class="px-3 py-2 border">Total Harga</th>
                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $index => $order)
                                <tr>
                                    <td class="px-3 py-2 border text-center">{{ $orders->firstItem() + $index }}</td>
                                    <td class="px-3 py-2 border text-center">PO-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-3 py-2 border text-center">
                                        @if($order->Status == 'Pending')
                                            <span class="bg-yellow-200 text-yellow-800 py-1 px-2 rounded text-xs">{{ $order->Status }}</span>
                                        @else
                                            <span class="bg-green-200 text-green-800 py-1 px-2 rounded text-xs">{{ $order->Status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 border">{{ $order->produk->SKU ?? '-' }}</td>
                                    <td class="px-3 py-2 border">{{ $order->produk->NamaProduk ?? '-' }}</td>
                                    <td class="px-3 py-2 border">{{ $order->supplier->NamaSupplier ?? '-' }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $order->produk->MinStok ?? '-' }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $order->produk->MaxStok ?? '-' }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $order->JumlahBeli }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $order->produk->Satuan ?? '-' }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $order->IsiKardus }}</td>
                                    <td class="px-3 py-2 border text-right">{{ number_format($order->HargaSatuan, 2) }}</td>
                                    <td class="px-3 py-2 border text-right">{{ number_format($order->TotalHarga, 2) }}</td>
                                    <td class="px-3 py-2 border text-center">
                                        @if($order->Status == 'Pending')
                                            <a href="{{ route('purchase-order.edit', $order) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                            <form action="{{ route('purchase-order.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Hapus PO ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-xs">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="14" class="px-3 py-2 border text-center">Tidak ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $orders->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
