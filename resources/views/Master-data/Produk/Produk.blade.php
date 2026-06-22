<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter & Action -->
            <form x-data="{
                departemenId: '{{ $departemen_id ?? '' }}',
                subKategoriId: '{{ $subkategori_id ?? '' }}',
                subKategoris: {{ Js::from($subkategoris) }},
                get filteredSubKategoris() {
                    if (!this.departemenId) return [];
                    return this.subKategoris.filter(sk => sk.kategori && sk.kategori.DepartemenID == this.departemenId);
                }
            }" x-ref="filterForm" method="GET" action="{{ route('produk.index') }}" class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                <div class="flex flex-wrap gap-3">
                    <!-- Dropdown Filter -->
                    <select name="toko_id" @change="$refs.filterForm.submit()" class="border rounded-lg px-3 py-2 text-sm text-gray-700">
                        <option value="">Pilih Toko</option>
                        @foreach($stores as $store)
                            <option value="{{ $store->StoreID }}" {{ ($toko_id ?? '') == $store->StoreID ? 'selected' : '' }}>{{ $store->NamaStore }}</option>
                        @endforeach
                    </select>

                    <select name="departemen_id" x-model="departemenId" @change="subKategoriId = ''; $nextTick(() => $refs.filterForm.submit())" class="border rounded-lg px-3 py-2 text-sm text-gray-700">
                        <option value="">Pilih Departemen</option>
                        @foreach($departemens as $dept)
                            <option value="{{ $dept->DepartemenID }}">{{ $dept->Nama }}</option>
                        @endforeach
                    </select>

                    <select name="subkategori_id" x-model="subKategoriId" @change="$nextTick(() => $refs.filterForm.submit())" class="border rounded-lg px-3 py-2 text-sm text-gray-700">
                        <option value="">Pilih Sub kategori</option>
                        <template x-for="sk in filteredSubKategoris" :key="sk.SubKategoriID">
                            <option :value="sk.SubKategoriID" x-text="sk.Nama"></option>
                        </template>
                    </select>

                    @if(!empty($toko_id) || !empty($departemen_id) || !empty($subkategori_id) || !empty($search))
                        <a href="{{ route('produk.index') }}" class="bg-gray-100 text-gray-600 px-3 py-2 rounded-lg hover:bg-gray-200 text-sm flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>

                <!-- Tombol & Search -->
                <div class="flex gap-3">
                    <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-700 text-sm flex items-center">
                        + Tambah Produk
                    </a>
                    <div class="relative flex items-center">
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari produk..."
                            class="border rounded-lg pl-3 pr-8 py-2 text-sm text-gray-700 w-48">
                        @if(!empty($search))
                            <button type="button" onclick="window.location.href='{{ route('produk.index', request()->except('search')) }}'" class="absolute right-2.5 text-gray-400 hover:text-gray-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </form>

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
                                @php
                                    $inventory = $product->inventori->first();
                                    $hpp = $inventory ? $inventory->HargaBeliTerakhir : 0;
                                    $harga = $inventory ? $inventory->HargaJual : 0;
                                    $margin = $harga > 0 ? (($harga - $hpp) / $harga) * 100 : 0;
                                    $departemenNama = $product->kategori->departemen->Nama ?? '-';
                                @endphp
                                <tr>
                                    <td class="px-3 py-2 border text-center">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border">{{ $product->Barcode }}</td>
                                    <td class="px-3 py-2 border">{{ $product->NamaProduk }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $product->Satuan }}</td>
                                    <td class="px-3 py-2 border text-right">{{ $hpp > 0 ? 'Rp ' . number_format($hpp, 0, ',', '.') : '-' }}</td>
                                    <td class="px-3 py-2 border text-right">{{ $harga > 0 ? 'Rp ' . number_format($harga, 0, ',', '.') : '-' }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $harga > 0 ? number_format($margin, 2, ',', '.') . '%' : '-' }}</td>
                                    <td class="px-3 py-2 border">{{ $departemenNama }}</td>
                                    <td class="px-3 py-2 border text-center">
                                        @if($product->StatusAktif == 1)
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        @else
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 border text-center">
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
