<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Purchase Order</h2>
                <a href="{{ route('purchase-order.create') }}" class="bg-blue-500 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-600 text-sm">Tambah PO</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">SKU</th>
                                <th class="px-3 py-2 border">Nama Produk</th>
                                <th class="px-3 py-2 border">Stock</th>
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
                                    <td class="px-3 py-2 border">{{ $orders->firstItem() + $index }}</td>
                                    <td class="px-3 py-2 border">{{ $order->sku }}</td>
                                    <td class="px-3 py-2 border">{{ $order->nama_produk }}</td>
                                    <td class="px-3 py-2 border">{{ $order->stock }}</td>
                                    <td class="px-3 py-2 border">{{ $order->min }}</td>
                                    <td class="px-3 py-2 border">{{ $order->max }}</td>
                                    <td class="px-3 py-2 border">{{ $order->jumlah_beli }}</td>
                                    <td class="px-3 py-2 border">{{ $order->satuan }}</td>
                                    <td class="px-3 py-2 border">{{ $order->isi_kardus }}</td>
                                    <td class="px-3 py-2 border">{{ number_format($order->harga_satuan, 2) }}</td>
                                    <td class="px-3 py-2 border">{{ number_format($order->total_harga, 2) }}</td>
                                    <td class="px-3 py-2 border text-center">
                                        <a href="{{ route('purchase-order.edit', $order) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                        <form action="{{ route('purchase-order.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Hapus PO ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="12" class="px-3 py-2 border text-center">Tidak ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $orders->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Stock Barang</h2>
                <a href="{{ route('inventori.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">Kembali</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">ProdukID</th>
                                <th class="px-3 py-2 border">StoreID</th>
                                <th class="px-3 py-2 border">Stok&nbsp;Saat&nbsp;Ini</th>
                                <th class="px-3 py-2 border">Minimum&nbsp;Stok</th>
                                <th class="px-3 py-2 border">Harga&nbsp;Beli&nbsp;Terakhir</th>
                                <th class="px-3 py-2 border">Harga&nbsp;Jual</th>
                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-3 py-2 border">1</td>
                                <td class="px-3 py-2 border">P001</td>
                                <td class="px-3 py-2 border">S001</td>
                                <td class="px-3 py-2 border">150</td>
                                <td class="px-3 py-2 border">20</td>
                                <td class="px-3 py-2 border">50000</td>
                                <td class="px-3 py-2 border">75000</td>
                                <td class="px-3 py-2 border text-center">
                                    <a href="#" class="text-blue-600 hover:underline">Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 py-2 border">2</td>
                                <td class="px-3 py-2 border">P002</td>
                                <td class="px-3 py-2 border">S002</td>
                                <td class="px-3 py-2 border">80</td>
                                <td class="px-3 py-2 border">10</td>
                                <td class="px-3 py-2 border">30000</td>
                                <td class="px-3 py-2 border">45000</td>
                                <td class="px-3 py-2 border text-center">
                                    <a href="#" class="text-blue-600 hover:underline">Detail</a>
                                </td>
                            </tr>
                            <!-- Add more dummy rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>