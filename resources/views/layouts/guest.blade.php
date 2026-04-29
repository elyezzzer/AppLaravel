<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

       <title>InventoryPlus</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 pt-10 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/IconeInventoryPlusTransparent.png') }}"
                        alt=""
                        class="w-12 h-12 pb-4 object-contain">
                    <span class="text-3xl font-bold text-gray-800">
                        <span class="text-gray-900">Inventory</span><span class="text-[#1565ff]">Plus</span>
                    </span>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
