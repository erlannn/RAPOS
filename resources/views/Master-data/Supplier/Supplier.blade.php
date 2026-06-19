<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter & Action -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                <div class="flex flex-wrap gap-3">
                    <h2 class="text-xl font-semibold text-gray-800">Daftar Supplier</h2>
                </div>

                <!-- Tombol & Search -->
                <div class="flex gap-3">
                    <a href="{{ route('master-data.supplier.tambah') }}" class="bg-blue-600 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-700 text-sm flex items-center">
                        + Tambah Supplier
                    </a>
                    <input type="text" placeholder="Cari supplier..."
                        class="border rounded-lg px-3 py-2 text-sm text-gray-700 w-48">
                </div>
            </div>

            <!-- Tabel Supplier -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">Nama Supplier</th>
                                <th class="px-3 py-2 border">Alamat</th>
                                <th class="px-3 py-2 border">Kontak</th>
                                <th class="px-3 py-2 border">Email</th>
                                <th class="px-3 py-2 border">No Rekening</th>
                                <th class="px-3 py-2 border">Bank</th>
                                <th class="px-3 py-2 border">Atas Nama</th>
                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $suppliers = [
                                    [
                                        'nama' => 'Supplier A',
                                        'alamat' => 'Jl. Merdeka No. 12, Jakarta',
                                        'kontak' => '081234567890',
                                        'email' => 'supplier.a@email.com',
                                        'no_rekening' => '1234567890',
                                        'bank' => 'BCA',
                                        'atas_nama' => 'PT Supplier A Sejahtera'
                                    ],
                                    [
                                        'nama' => 'Supplier B',
                                        'alamat' => 'Jl. Mawar No. 45, Bandung',
                                        'kontak' => '087654321098',
                                        'email' => 'supplier.b@email.com',
                                        'no_rekening' => '0987654321',
                                        'bank' => 'Mandiri',
                                        'atas_nama' => 'CV Supplier B Jaya'
                                    ]
                                ];
                            @endphp

                            @foreach ($suppliers as $index => $supplier)
                                <tr>
                                    <td class="px-3 py-2 border text-center">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border font-medium text-gray-900">{{ $supplier['nama'] }}</td>
                                    <td class="px-3 py-2 border">{{ $supplier['alamat'] }}</td>
                                    <td class="px-3 py-2 border">{{ $supplier['kontak'] }}</td>
                                    <td class="px-3 py-2 border">{{ $supplier['email'] }}</td>
                                    <td class="px-3 py-2 border">{{ $supplier['no_rekening'] }}</td>
                                    <td class="px-3 py-2 border">{{ $supplier['bank'] }}</td>
                                    <td class="px-3 py-2 border">{{ $supplier['atas_nama'] }}</td>
                                    <td class="px-3 py-2 border text-center">
                                        <a href="{{ route('master-data.supplier.edit') }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs inline-block">Edit</a>
                                        <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-xs">Hapus</button>
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
