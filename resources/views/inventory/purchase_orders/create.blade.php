<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Tambah Purchase Order</h2>
                <a href="{{ route('purchase-order.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">Kembali</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('purchase-order.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium">SKU</label>
                                <input type="text" name="sku" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('sku') }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Nama Produk</label>
                                <input type="text" name="nama_produk" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('nama_produk') }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Stock</label>
                                <input type="number" name="stock" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('stock') }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Min</label>
                                <input type="number" name="min" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('min') }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Max</label>
                                <input type="number" name="max" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('max') }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Jumlah Beli</label>
                                <input type="number" name="jumlah_beli" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('jumlah_beli') }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Satuan</label>
                                <input type="text" name="satuan" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('satuan') }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Isi/Kardus</label>
                                <input type="number" name="isi_kardus" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('isi_kardus') }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Harga Satuan</label>
                                <input type="number" step="0.01" name="harga_satuan" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('harga_satuan') }}" required>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
