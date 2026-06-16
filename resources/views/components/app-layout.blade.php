<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100">
    <div x-data="{ sidebarOpen: true, masterDataOpen: {{ request()->routeIs('master-data.*') ? 'true' : 'false' }}, inventoryOpen: {{ request()->routeIs('inventory.*') ? 'true' : 'false' }} }" class="min-h-screen">
        <div id="app-shell" class="flex min-h-screen bg-slate-100">
            <aside
                id="app-sidebar"
                class="z-40 border-r border-slate-200 bg-blue-700 text-slate-100 transition-all duration-300"
                :class="sidebarOpen ? 'w-72' : 'w-20'">
                <div class="flex h-16 items-center border-b border-white/10 px-4" :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">
                    <x-application-logo class="h-10 w-10 text-white"/>
                    <div x-show="sidebarOpen" x-transition.opacity>
                        <div class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">RAPOS</div>
                        <div class="text-xs text-slate-400">Admin Panel</div>
                    </div>
                </div>

                <nav class="space-y-2 px-3 py-5 text-sm font-medium">
                    <a href="{{ route('dashboard') }}" class="flex items-center rounded-xl px-3 py-3 transition hover:bg-white/10 {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-slate-300' }}" :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-base">D</span>
                        <span x-show="sidebarOpen" x-transition.opacity>Dashboard</span>
                    </a>

                    <div>
                        <button type="button" @click="masterDataOpen = ! masterDataOpen" class="flex w-full items-center rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/10 {{ request()->routeIs('master-data.*') ? 'bg-white/10 text-white' : '' }}" :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                            <span class="flex items-center" :class="sidebarOpen ? 'gap-3' : 'justify-center'">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500/20 text-base text-emerald-300">M</span>
                                <span x-show="sidebarOpen" x-transition.opacity>Master Data</span>
                            </span>
                            <svg x-show="sidebarOpen" x-transition.opacity class="h-4 w-4 transition-transform" :class="masterDataOpen ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="sidebarOpen && masterDataOpen" x-transition class="mt-2 space-y-1 pl-4" style="display: none;">
                            <a href="{{ route('master-data.produk') }}" class="block rounded-lg px-4 py-2 text-slate-300 transition hover:bg-white/10 {{ request()->routeIs('master-data.produk') ? 'bg-white/10 text-white' : '' }}">Produk</a>
                            <a href="{{ route('master-data.supplier') }}" class="block rounded-lg px-4 py-2 text-slate-300 transition hover:bg-white/10 {{ request()->routeIs('master-data.supplier') ? 'bg-white/10 text-white' : '' }}">Supplier</a>
                        </div>
                    </div>

                    <div>
                        <button type="button" @click="inventoryOpen = ! inventoryOpen" class="flex w-full items-center rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/10 {{ request()->routeIs('inventory.*') ? 'bg-white/10 text-white' : '' }}" :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                            <span class="flex items-center" :class="sidebarOpen ? 'gap-3' : 'justify-center'">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-500/20 text-base text-amber-300">I</span>
                                <span x-show="sidebarOpen" x-transition.opacity>Inventory</span>
                            </span>
                            <svg x-show="sidebarOpen" x-transition.opacity class="h-4 w-4 transition-transform" :class="inventoryOpen ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="sidebarOpen && inventoryOpen" x-transition class="mt-2 space-y-1 pl-4" style="display: none;">
                            <a href="{{ route('inventory.stock') }}" class="block rounded-lg px-4 py-2 text-slate-300 transition hover:bg-white/10 {{ request()->routeIs('inventory.stock') ? 'bg-white/10 text-white' : '' }}">Stok Barang</a>
                            <a href="{{ route('inventory.incoming') }}" class="block rounded-lg px-4 py-2 text-slate-300 transition hover:bg-white/10 {{ request()->routeIs('inventory.incoming') ? 'bg-white/10 text-white' : '' }}">Barang Masuk</a>
                            <a href="{{ route('inventory.outgoing') }}" class="block rounded-lg px-4 py-2 text-slate-300 transition hover:bg-white/10 {{ request()->routeIs('inventory.outgoing') ? 'bg-white/10 text-white' : '' }}">Barang Keluar</a>
                        </div>
                    </div>
                </nav>
            </aside>

            <div id="app-main" class="flex min-h-screen flex-1 flex-col transition-all duration-300">
                <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
                    <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-3">
                            <button type="button" @click="sidebarOpen = ! sidebarOpen" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-slate-600 transition hover:bg-slate-100">
                                <span class="sr-only">Toggle sidebar</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M3 5.75A.75.75 0 0 1 3.75 5h12.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 5.75Zm0 4.25A.75.75 0 0 1 3.75 9h12.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 10Zm0 4.25a.75.75 0 0 1 .75-.75h12.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium">Sidebar</span>
                            </button>

                            
                        </div>

                        <details class="relative">
                            <summary class="flex cursor-pointer list-none items-center gap-3 rounded-xl border border-slate-200 bg-white px-3 py-2 text-left shadow-sm transition hover:bg-slate-50">
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-900 text-sm font-semibold text-white">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="hidden sm:block">
                                    <div class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
                                </div>
                                <svg class="h-4 w-4 text-slate-500 transition-transform group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z" clip-rule="evenodd" />
                                </svg>
                            </summary>

                            <div class="absolute right-0 mt-2 w-56 rounded-2xl border border-slate-200 bg-white p-2 shadow-xl">
                                <a href="{{ route('profile.edit') }}" class="block rounded-xl px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-100">Ganti Password</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full rounded-xl px-4 py-3 text-left text-sm text-red-600 transition hover:bg-red-50">Logout</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </header>

                <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
                    @isset($header)
                        <div class="mb-6 rounded-2xl bg-white px-6 py-4 shadow-sm ring-1 ring-slate-200">
                            {{ $header }}
                        </div>
                    @endisset

                    {{ $slot }}
                </main>
            </div>
        </div>

    </div>
</body>
</html>
