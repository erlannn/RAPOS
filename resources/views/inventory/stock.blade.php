<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Stock Barang</h2>
                <a href="{{ route('inventori.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">Kembali</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="{ activeTab: 'total' }">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                        <button @click="activeTab = 'total'" :class="{'border-blue-500 text-blue-600': activeTab === 'total', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'total'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Total Stok
                        </button>
                        <button @click="activeTab = 'masuk'" :class="{'border-blue-500 text-blue-600': activeTab === 'masuk', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'masuk'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Barang Masuk
                        </button>
                        <button @click="activeTab = 'keluar'" :class="{'border-blue-500 text-blue-600': activeTab === 'keluar', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'keluar'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Barang Keluar
                        </button>
                    </nav>
                </div>

                <div class="p-6">
                    <!-- Tab: Total Stok -->
                    <div x-show="activeTab === 'total'">
                        <form action="{{ route('inventory.stock') }}" method="GET" class="mb-4">
                            <div class="flex items-center gap-2">
                                <label for="store_id" class="text-sm font-medium text-gray-700">Filter Store:</label>
                                <select name="store_id" id="store_id" class="border-gray-300 rounded-md text-sm py-1" onchange="this.form.submit()">
                                    <option value="">Semua Toko</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->StoreID }}" {{ request('store_id') == $store->StoreID ? 'selected' : '' }}>{{ $store->NamaStore }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-3 py-2 border">No</th>
                                    @if(!$isAllStores)
                                        <th class="px-3 py-2 border">Store</th>
                                    @endif
                                    <th class="px-3 py-2 border">SKU</th>
                                    <th class="px-3 py-2 border">Nama Produk</th>
                                    <th class="px-3 py-2 border">Stok Saat Ini</th>
                                    <th class="px-3 py-2 border">Minimum Stok</th>
                                    @if(!$isAllStores)
                                        <th class="px-3 py-2 border">Harga Beli</th>
                                        <th class="px-3 py-2 border">Harga Jual</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($inventoris as $inv)
                                <tr>
                                    <td class="px-3 py-2 border text-center">{{ $loop->iteration }}</td>
                                    @if(!$isAllStores)
                                        <td class="px-3 py-2 border">{{ $inv->store->NamaStore ?? 'N/A' }}</td>
                                    @endif
                                    <td class="px-3 py-2 border">{{ $inv->produk->SKU ?? 'N/A' }}</td>
                                    <td class="px-3 py-2 border">{{ $inv->produk->NamaProduk ?? 'N/A' }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $inv->StokSaatIni }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $inv->MinimumStok }}</td>
                                    @if(!$isAllStores)
                                        <td class="px-3 py-2 border text-right">{{ number_format($inv->HargaBeliTerakhir, 2) }}</td>
                                        <td class="px-3 py-2 border text-right">{{ number_format($inv->HargaJual, 2) }}</td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{ $isAllStores ? '5' : '8' }}" class="px-3 py-4 border text-center text-gray-500">Tidak ada data stok</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab: Barang Masuk -->
                    <div x-show="activeTab === 'masuk'" x-cloak>
                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-3 py-2 border">No</th>
                                    <th class="px-3 py-2 border">Tanggal</th>
                                    <th class="px-3 py-2 border">Store</th>
                                    <th class="px-3 py-2 border">Produk</th>
                                    <th class="px-3 py-2 border">Keterangan</th>
                                    <th class="px-3 py-2 border">Qty Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barangMasuk as $bm)
                                <tr>
                                    <td class="px-3 py-2 border text-center">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2 border text-center">{{ \Carbon\Carbon::parse($bm->Tanggal)->format('d-m-Y') }}</td>
                                    <td class="px-3 py-2 border">{{ $bm->store->NamaStore ?? 'N/A' }}</td>
                                    <td class="px-3 py-2 border">{{ $bm->produk->NamaProduk ?? 'N/A' }}</td>
                                    <td class="px-3 py-2 border">{{ $bm->Keterangan }}</td>
                                    <td class="px-3 py-2 border text-center text-green-600 font-bold">+{{ $bm->Qty }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="px-3 py-4 border text-center text-gray-500">Tidak ada data barang masuk</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab: Barang Keluar -->
                    <div x-show="activeTab === 'keluar'" x-cloak>
                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-3 py-2 border">No</th>
                                    <th class="px-3 py-2 border">Tanggal</th>
                                    <th class="px-3 py-2 border">Store</th>
                                    <th class="px-3 py-2 border">Produk</th>
                                    <th class="px-3 py-2 border">Keterangan</th>
                                    <th class="px-3 py-2 border">Qty Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barangKeluar as $bk)
                                <tr>
                                    <td class="px-3 py-2 border text-center">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2 border text-center">{{ \Carbon\Carbon::parse($bk->Tanggal)->format('d-m-Y') }}</td>
                                    <td class="px-3 py-2 border">{{ $bk->store->NamaStore ?? 'N/A' }}</td>
                                    <td class="px-3 py-2 border">{{ $bk->produk->NamaProduk ?? 'N/A' }}</td>
                                    <td class="px-3 py-2 border">{{ $bk->Keterangan }}</td>
                                    <td class="px-3 py-2 border text-center text-red-600 font-bold">{{ $bk->Qty }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="px-3 py-4 border text-center text-gray-500">Tidak ada data barang keluar</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>