<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Edit Store</h2>
                <a href="{{ route('store.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('store.update', $store->StoreID) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">KodeStore</label>
                                <input type="text" name="KodeStore" value="{{ $store->KodeStore }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan KodeStore">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NamaStore</label>
                                <input type="text" name="NamaStore" value="{{ $store->NamaStore }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan NamaStore">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">TipeLokasi</label>
                                <input type="text" name="TipeLokasi" value="{{ $store->TipeLokasi }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan TipeLokasi">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input type="text" name="Alamat" value="{{ $store->Alamat }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Alamat">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NoTelp</label>
                                <input type="text" name="NoTelp" value="{{ $store->NoTelp }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan NoTelp">
                            </div>
                            <div class="flex items-center mt-6">
                                <input type="hidden" name="StatusAktif" value="0">
                                <input type="checkbox" name="StatusAktif" value="1" {{ $store->StatusAktif == 1 ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label class="ml-2 block text-sm text-gray-900">
                                    Status Aktif
                                </label>
                            </div>

                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <a href="{{ route('store.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">
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