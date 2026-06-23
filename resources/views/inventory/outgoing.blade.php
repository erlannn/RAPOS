<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Barang Keluar</h2>
                <a href="{{ route('inventori.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">Kembali</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('inventory.outgoing.process') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 max-w-lg mb-4">
                            <div>
                                <label class="block font-medium">Pilih Stok dari Toko Pusat</label>
                                <select name="InventoriID" id="InventoriID" class="mt-1 block w-full border-gray-300 rounded-md" required onchange="updateMaxQty()">
                                    <option value="">-- Pilih Stok --</option>
                                    @foreach($inventoris as $inv)
                                        <option value="{{ $inv->InventoriID }}" data-stok="{{ $inv->StokSaatIni }}">
                                            {{ $inv->produk->SKU ?? '' }} - {{ $inv->produk->NamaProduk ?? '' }} (Sisa: {{ $inv->StokSaatIni }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-medium">Pindah Ke Store (Tujuan)</label>
                                <select name="TujuanStoreID" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                    <option value="">-- Pilih Store Tujuan --</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->StoreID }}">{{ $store->NamaStore }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-medium">Jumlah Keluar</label>
                                <input type="number" name="qty" id="qty" class="mt-1 block w-full border-gray-300 rounded-md" min="1" required>
                                <p class="text-sm text-gray-500 mt-1" id="max-qty-info"></p>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Proses Barang Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function updateMaxQty() {
            const select = document.getElementById('InventoriID');
            const qtyInput = document.getElementById('qty');
            const maxInfo = document.getElementById('max-qty-info');
            
            const selectedOption = select.options[select.selectedIndex];
            
            if (selectedOption.value) {
                const maxStok = selectedOption.getAttribute('data-stok');
                qtyInput.max = maxStok;
                maxInfo.innerText = `Maksimal stok yang bisa dipindah: ${maxStok}`;
            } else {
                qtyInput.max = '';
                maxInfo.innerText = '';
            }
        }
    </script>
</x-app-layout>