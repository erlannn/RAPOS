<x-app-layout>

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
                    <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-700 text-sm flex items-center">
                        + Tambah Produk
                    </a>
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
                            @foreach ($produk as $index => $product)
                                <tr>
                                    <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border">{{ $product->Barcode }}</td>
                                    <td class="px-3 py-2 border">{{ $product->NamaProduk }}</td>
                                    <td class="px-3 py-2 border">{{ $product->Satuan }}</td>
                                    <td class="px-3 py-2 border">{{ $product->Deskripsi ?? '-' }}</td>
                                    <td class="px-3 py-2 border">-</td>
                                    <td class="px-3 py-2 border">-</td>
                                    <td class="px-3 py-2 border">-</td>
                                    <td class="px-3 py-2 border">
                                        @if($product->StatusAktif == 1)
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        @else
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 border">
                                        <a href="{{ route('produk.edit', $product->ProdukID) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs inline-block">Edit</a>
                                        <form action="{{ route('produk.destroy', $product->ProdukID) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?');">
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
