<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Barang Keluar</h2>
                <a href="{{ route('inventori.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">Kembali</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">InventoriID</th>
                                <th class="px-3 py-2 border">Jenis Transaksi</th>
                                <th class="px-3 py-2 border">Jumlah</th>
                                <th class="px-3 py-2 border">Tanggal</th>
                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
    <td class="px-3 py-2 border">1</td>
    <td class="px-3 py-2 border">INV003</td>
    <td class="px-3 py-2 border">Keluar</td>
    <td class="px-3 py-2 border">20</td>
    <td class="px-3 py-2 border">2023-02-01</td>
    <td class="px-3 py-2 border text-center">
        <a href="#" class="text-blue-600 hover:underline">Detail</a>
    </td>
</tr>
<tr>
    <td class="px-3 py-2 border">2</td>
    <td class="px-3 py-2 border">INV004</td>
    <td class="px-3 py-2 border">Keluar</td>
    <td class="px-3 py-2 border">15</td>
    <td class="px-3 py-2 border">2023-02-03</td>
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