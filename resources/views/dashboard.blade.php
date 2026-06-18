<x-app-layout>
    @php
        $summaryCards = [
            [
                'title' => 'Penjualan',
                'value' => 'Rp 128,4 JT',
                'note' => 'Data dummy',
                'description' => 'Total omzet periode berjalan',
                'gradient' => 'from-rose-500 to-pink-500',
                'icon' => '<path d="M4 19h16M6 17V9m4 8V5m4 12v-6m4 6V7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />',
            ],
            [
                'title' => 'Transaksi',
                'value' => '1.284',
                'note' => 'Data dummy',
                'description' => 'Order yang diproses sukses',
                'gradient' => 'from-sky-500 to-cyan-500',
                'icon' => '<path d="M7 7h10M7 11h10M7 15h6M5 3.75h14a1.25 1.25 0 0 1 1.25 1.25v12.5A1.25 1.25 0 0 1 19 18.75H5A1.25 1.25 0 0 1 3.75 17.5V5A1.25 1.25 0 0 1 5 3.75Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />',
            ],
            [
                'title' => 'Margin',
                'value' => '31,6%',
                'note' => 'Data dummy',
                'description' => 'Rasio keuntungan bersih',
                'gradient' => 'from-emerald-500 to-lime-500',
                'icon' => '<path d="M12 3v18M7 7.5c0-1.933 2.239-3.5 5-3.5s5 1.567 5 3.5S14.761 11 12 11s-5 1.567-5 3.5S9.239 18 12 18s5-1.567 5-3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />',
            ],
            [
                'title' => 'Inventory',
                'value' => '4.912',
                'note' => 'Data dummy',
                'description' => 'Stok aktif yang terpantau',
                'gradient' => 'from-amber-500 to-orange-500',
                'icon' => '<path d="M4.75 7.5 12 3.75l7.25 3.75M4.75 7.5 12 11.25M4.75 7.5v8.75L12 20m0-8.75V20m0-8.75 7.25-3.75M19.25 7.5v8.75L12 20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />',
            ],
        ];
    @endphp

    <div class="space-y-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-slate-900">Dashboard</h2>
                    <p class="mt-1 text-sm text-slate-500">Ringkasan sederhana untuk penjualan, transaksi, margin, dan inventory.</p>
                </div>
                <div class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">Data saat ini masih dummy</div>
            </div>
        </section>

        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($summaryCards as $card)
                <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="h-1 bg-gradient-to-r {{ $card['gradient'] }}"></div>
                    <div class="flex items-start justify-between gap-4 p-5">
                        <div>
                            <div class="text-sm font-medium text-slate-500">{{ $card['title'] }}</div>
                            <div class="mt-2 text-2xl font-semibold text-slate-900">{{ $card['value'] }}</div>
                            <div class="mt-1 text-sm text-slate-500">{{ $card['description'] }}</div>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br {{ $card['gradient'] }} text-white shadow-sm">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                {!! $card['icon'] !!}
                            </svg>
                        </div>
                    </div>
                    <div class="border-t border-slate-100 px-5 py-3 text-xs font-medium text-slate-500">
                        {{ $card['note'] }}
                    </div>
                </article>
            @endforeach
        </section>

        <section class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-sm text-slate-500">
            Area ini sudah disiapkan untuk data real dari database. Nanti controller bisa mengirim variabel yang sama, lalu isi dummy di atas tinggal diganti tanpa mengubah struktur kartu.
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm mt-6">
            <h2 class="text-xl font-semibold text-slate-900 mb-4">Analisis Penjualan</h2>
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                <!-- Penjualan Per Jam -->
                <div class="bg-slate-50 rounded-xl p-4">
                    <canvas id="salesPerHourChart"></canvas>
                </div>

                <!-- Penjualan Per Kategori -->
                <div class="bg-slate-50 rounded-xl p-4">
                    <canvas id="salesPerCategoryChart"></canvas>
                </div>

                <!-- Penjualan Per Kasir -->
                <div class="bg-slate-50 rounded-xl p-4">
                    <canvas id="salesPerCashierChart"></canvas>
                </div>

                <!-- Top 10 Produk Paling Laku -->
                <div class="bg-slate-50 rounded-xl p-4 sm:col-span-2 xl:col-span-1">
                    <canvas id="topProductsChart"></canvas>
                </div>

                <!-- Top 10 Produk Kurang Laku -->
                <div class="bg-slate-50 rounded-xl p-4 sm:col-span-2 xl:col-span-1">
                    <canvas id="leastProductsChart"></canvas>
                </div>
            </div>
        </section>

    </div>

</x-app-layout>
