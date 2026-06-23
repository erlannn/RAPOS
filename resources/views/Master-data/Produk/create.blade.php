<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Tambah Produk Baru</h2>
                <a href="{{ route('produk.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('produk.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-data="{ 
                            departemen: '', 
                            kategori: '',
                            kategoris: {{ Js::from($kategoris) }},
                            subkategoris: {{ Js::from($subkategoris) }},
                            get filteredKategoris() {
                                return this.kategoris.filter(k => k.DepartemenID == this.departemen);
                            },
                            get filteredSubKategoris() {
                                return this.subkategoris.filter(sk => sk.KategoriID == this.kategori);
                            }
                        }">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Brand</label>
                                <select name="BrandID" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="">-- Pilih Brand --</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->BrandID }}">{{ $brand->NamaBrand }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Departemen</label>
                                <select x-model="departemen" @change="kategori = ''" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="">-- Pilih Departemen --</option>
                                    @foreach($departemens as $dept)
                                        <option value="{{ $dept->DepartemenID }}">{{ $dept->Nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select name="KategoriID" x-model="kategori" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="">-- Pilih Kategori --</option>
                                    <template x-for="k in filteredKategoris" :key="k.KategoriID">
                                        <option :value="k.KategoriID" x-text="k.Nama"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Sub Kategori</label>
                                <select name="SubKategoriID" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="">-- Pilih Sub Kategori --</option>
                                    <template x-for="sk in filteredSubKategoris" :key="sk.SubKategoriID">
                                        <option :value="sk.SubKategoriID" x-text="sk.Nama"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">SKU</label>
                                <input type="text" name="SKU" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan SKU">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Barcode</label>
                                <input type="text" name="Barcode" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Barcode">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NamaProduk</label>
                                <input type="text" name="NamaProduk" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan NamaProduk">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Satuan</label>
                                <input type="text" name="Satuan" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Satuan">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Min Stok</label>
                                <input type="number" name="MinStok" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Min Stok" value="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Max Stok</label>
                                <input type="number" name="MaxStok" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Max Stok" value="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <input type="text" name="Deskripsi" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Deskripsi">
                            </div>
                            <div class="flex items-center mt-6">
                                <input type="hidden" name="StatusAktif" value="0">
                                <input type="checkbox" name="StatusAktif" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label class="ml-2 block text-sm text-gray-900">
                                    Status Aktif
                                </label>
                            </div>

                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <a href="{{ route('produk.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 text-sm">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>