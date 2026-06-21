<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Edit MutasiStok</h2>
                <a href="{{ route('mutasistok.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('mutasistok.update', $mutasistok->MutasiID) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <input type="text" name="Tanggal" value="{{ $mutasistok->Tanggal }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Tanggal">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ProdukID</label>
                                <input type="text" name="ProdukID" value="{{ $mutasistok->ProdukID }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan ProdukID">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">StoreID</label>
                                <input type="text" name="StoreID" value="{{ $mutasistok->StoreID }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan StoreID">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">JenisMutasi</label>
                                <input type="text" name="JenisMutasi" value="{{ $mutasistok->JenisMutasi }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan JenisMutasi">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ReferensiTabel</label>
                                <input type="text" name="ReferensiTabel" value="{{ $mutasistok->ReferensiTabel }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan ReferensiTabel">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ReferensiID</label>
                                <input type="text" name="ReferensiID" value="{{ $mutasistok->ReferensiID }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan ReferensiID">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Qty</label>
                                <input type="text" name="Qty" value="{{ $mutasistok->Qty }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Qty">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">SaldoSebelum</label>
                                <input type="text" name="SaldoSebelum" value="{{ $mutasistok->SaldoSebelum }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan SaldoSebelum">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">SaldoSesudah</label>
                                <input type="text" name="SaldoSesudah" value="{{ $mutasistok->SaldoSesudah }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan SaldoSesudah">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <input type="text" name="Keterangan" value="{{ $mutasistok->Keterangan }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Keterangan">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">UserID</label>
                                <input type="text" name="UserID" value="{{ $mutasistok->UserID }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan UserID">
                            </div>

                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <a href="{{ route('mutasistok.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">
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