<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-r from-gray-200 to-blue-500">
        {{-- <div class="col-span-2 flex items-center justify-center">
            <p class="text-2xl font-bold text-gray-800">RAPOS</p>
        </div> --}}

        <div class="grid grid-cols-4 gap-2 min-h-screen flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
            {{-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> --}}
            <div class="col-span-1"></div>

            <div class="col-span-1 items-center justify-center">
                <h1 class="text-5xl font-extrabold text-blue-800">Login now!</h1>
                <p class=" py-4 pe-4 text-1xl font-semibold text-gray-800 text-justify">Silahkan masukkan kredensial Anda untuk masuk ke dalam sistem.</p>
            </div>
            
            <div class="col-span-2 w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
