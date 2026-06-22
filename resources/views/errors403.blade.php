<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Dilarang</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gradient-to-r from-gray-200 to-blue-500">

    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="text-5xl font-bold text-red-600">403</div>
        <div class="text-2xl font-semibold text-gray-800 mt-4">Akses Ditolak</div>
        <div class="text-gray-800 mt-2">Maaf, fitur ini hanya tersedia untuk Administrator</div>
        <a href="{{ route('dashboard') }}" class="mt-6 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
            Kembali ke Dashboard
        </a>
    </div>
</body>
</html>