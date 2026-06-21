<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Edit Inventori</h2>
                <a href="{{ route('inventori.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('inventori.update', $inventori->InventoriID) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ProdukID</label>
                                <input type="text" name="ProdukID" value="{{ $inventori->ProdukID }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan ProdukID">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">StoreID</label>
                                <input type="text" name="StoreID" value="{{ $inventori->StoreID }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan StoreID">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">StokSaatIni</label>
                                <input type="text" name="StokSaatIni" value="{{ $inventori->StokSaatIni }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan StokSaatIni">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">MinimumStok</label>
                                <input type="text" name="MinimumStok" value="{{ $inventori->MinimumStok }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan MinimumStok">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">HargaBeliTerakhir</label>
                                <input type="text" name="HargaBeliTerakhir" value="{{ $inventori->HargaBeliTerakhir }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan HargaBeliTerakhir">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">HargaJual</label>
                                <input type="text" name="HargaJual" value="{{ $inventori->HargaJual }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan HargaJual">
                            </div>

                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <a href="{{ route('inventori.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 text-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>