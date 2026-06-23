<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Edit Purchase Order</h2>
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
                    <form action="{{ route('purchase-order.update', $purchaseOrder->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium">Produk</label>
                                <select name="ProdukID" id="ProdukID" class="mt-1 block w-full border-gray-300 rounded-md" required onchange="updateProdukInfo()">
                                    <option value="">Pilih Produk</option>
                                    @foreach($produks as $produk)
                                        <option value="{{ $produk->ProdukID }}" data-min="{{ $produk->MinStok }}" data-max="{{ $produk->MaxStok }}" data-satuan="{{ $produk->Satuan }}" {{ old('ProdukID', $purchaseOrder->ProdukID) == $produk->ProdukID ? 'selected' : '' }}>
                                            {{ $produk->SKU }} - {{ $produk->NamaProduk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-medium">Supplier</label>
                                <select name="SupplierID" id="SupplierID" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                    <option value="">Pilih Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->SupplierID }}" {{ old('SupplierID', $purchaseOrder->SupplierID) == $supplier->SupplierID ? 'selected' : '' }}>
                                            {{ $supplier->NamaSupplier }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-medium">Min Stok</label>
                                <input type="number" id="min" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block font-medium">Max Stok</label>
                                <input type="number" id="max" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block font-medium">Satuan</label>
                                <input type="text" id="satuan" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block font-medium">Jumlah Beli</label>
                                <input type="number" name="jumlah_beli" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('jumlah_beli', $purchaseOrder->JumlahBeli) }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Isi/Kardus</label>
                                <input type="number" name="isi_kardus" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('isi_kardus', $purchaseOrder->IsiKardus) }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Harga Satuan</label>
                                <input type="number" step="0.01" name="harga_satuan" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('harga_satuan', $purchaseOrder->HargaSatuan) }}" required>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function updateProdukInfo() {
            const select = document.getElementById('ProdukID');
            const selectedOption = select.options[select.selectedIndex];
            
            const minInput = document.getElementById('min');
            const maxInput = document.getElementById('max');
            const satuanInput = document.getElementById('satuan');
            
            if (selectedOption && selectedOption.value) {
                minInput.value = selectedOption.getAttribute('data-min');
                maxInput.value = selectedOption.getAttribute('data-max');
                satuanInput.value = selectedOption.getAttribute('data-satuan');
            } else {
                minInput.value = '';
                maxInput.value = '';
                satuanInput.value = '';
            }
        }

        // Initialize on load
        window.addEventListener('DOMContentLoaded', () => {
            updateProdukInfo();
        });
    </script>
</x-app-layout>
