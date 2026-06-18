<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Produk') }}
    </h2>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter & Action -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                <div class="flex flex-wrap gap-3">
                    <!-- Dropdown Filter -->
                    <select class="border rounded-lg px-3 py-2 text-sm text-gray-700">
                        <option>Pilih Toko</option>
                        <option>Toko A</option>
                        <option>Toko B</option>
                    </select>

                    <select class="border rounded-lg px-3 py-2 text-sm text-gray-700">
                        <option>Pilih Departemen</option>
                        <option>Makanan</option>
                        <option>Minuman</option>
                        <option>Snack</option>
                    </select>

                    <select class="border rounded-lg px-3 py-2 text-sm text-gray-700">
                        <option>Pilih Kondisi</option>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                </div>

                <!-- Tombol & Search -->
                <div class="flex gap-3">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                        + Tambah Produk
                    </button>
                    <input type="text" placeholder="Cari produk..."
                        class="border rounded-lg px-3 py-2 text-sm text-gray-700 w-48">
                </div>
            </div>

            <!-- Tabel Produk -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">Barcode</th>
                                <th class="px-3 py-2 border">Nama Produk</th>
                                <th class="px-3 py-2 border">Satuan</th>
                                <th class="px-3 py-2 border">HPP</th>
                                <th class="px-3 py-2 border">Harga</th>
                                <th class="px-3 py-2 border">Margin</th>
                                <th class="px-3 py-2 border">Departemen</th>
                                <th class="px-3 py-2 border">Status</th>
                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $products = [
                                    ['barcode' => '123456789', 'nama' => 'Produk A', 'satuan' => 'pcs', 'hpp' => 10000, 'harga' => 15000, 'margin' => '50%', 'departemen' => 'Makanan', 'status' => 'Aktif'],
                                    ['barcode' => '987654321', 'nama' => 'Produk B', 'satuan' => 'botol', 'hpp' => 8000, 'harga' => 12000, 'margin' => '50%', 'departemen' => 'Minuman', 'status' => 'Aktif'],
                                ];
                            @endphp

                            @foreach ($products as $index => $product)
                                <tr>
                                    <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border">{{ $product['barcode'] }}</td>
                                    <td class="px-3 py-2 border">{{ $product['nama'] }}</td>
                                    <td class="px-3 py-2 border">{{ $product['satuan'] }}</td>
                                    <td class="px-3 py-2 border">Rp {{ number_format($product['hpp'], 0, ',', '.') }}</td>
                                    <td class="px-3 py-2 border">Rp {{ number_format($product['harga'], 0, ',', '.') }}</td>
                                    <td class="px-3 py-2 border">{{ $product['margin'] }}</td>
                                    <td class="px-3 py-2 border">{{ $product['departemen'] }}</td>
                                    <td class="px-3 py-2 border">{{ $product['status'] }}</td>
                                    <td class="px-3 py-2 border">
                                        <button class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</button>
                                        <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Hapus</button>
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
