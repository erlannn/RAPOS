<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header / Title -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Edit Supplier</h2>
                <a href="{{ route('master-data.supplier') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">
                    Kembali
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nama Supplier -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Supplier</label>
                                <input type="text" name="nama" value="Supplier A" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Nama Supplier">
                            </div>
                            
                            <!-- Kontak -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kontak</label>
                                <input type="text" name="kontak" value="081234567890" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Nomor Telepon/WhatsApp">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="supplier.a@email.com" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Alamat Email">
                            </div>

                            <!-- Bank -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bank</label>
                                <input type="text" name="bank" value="BCA" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Nama Bank (misal: BCA, Mandiri)">
                            </div>

                            <!-- No Rekening -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No Rekening</label>
                                <input type="text" name="no_rekening" value="1234567890" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Nomor Rekening">
                            </div>

                            <!-- Atas Nama -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Atas Nama Rekening</label>
                                <input type="text" name="atas_nama" value="PT Supplier A Sejahtera" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Atas Nama Rekening">
                            </div>

                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <textarea name="alamat" rows="3" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan Alamat Lengkap">Jl. Merdeka No. 12, Jakarta</textarea>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <a href="{{ route('master-data.supplier') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">
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
