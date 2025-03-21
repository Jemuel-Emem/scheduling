<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ASMS</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 relative">
            <!-- Background Image with opacity -->
            <div class="absolute inset-0 bg-yellow-500 bg-opacity-25 z-0" style="background-image: url('{{ asset('images/brgy.jpg') }}'); background-size: cover; background-position: center; opacity: 0.25;"></div>

            <div class="relative z-10">
                <a href="/" wire:navigate>

                    <img src="{{ asset('images/logolegaspi.png') }}" alt="" class="w-20 h-20 fill-current text-gray-500">
                </a>
               <span class="ml-2 font-bold text-2xl text-blue-500 "> ASMS</span>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
