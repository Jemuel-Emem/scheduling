<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ASMS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Poppins:400,700&display=swap" rel="stylesheet" /> <!-- Changed to Poppins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>

    <style>
        [x-cloak] {
            display: none;
        }

        .background-farm {
            background-image: url('{{ asset('images/farm.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
        }

        /* Color Improvements */
        .bg-primary-yellow {
            background-color: #FFD700; /* Golden Yellow */
        }

        .bg-dark-yellow {
            background-color: #FFCC00; /* Dark Yellow */
        }

        .text-dark-yellow {
            color: #FFCC00; /* Dark Yellow */
        }

        .text-light-yellow {
            color: #FFD700; /* Golden Yellow */
        }

        .hover-bg-dark-yellow:hover {
            background-color: #FFB300; /* Slightly darker yellow for hover */
        }

        /* General Styling */
        .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #FFB300; /* Hover effect with darker yellow */
            color: white;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts
</head>

<body class="font-sans antialiased h-full bg-no-repeat bg-cover background-farm">
    <nav class="bg-dark-yellow border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logolegaspi.png') }}" alt="Violation Photo" class="w-16 h-16 border-2 rounded-full">
                <label for="" class="text-blue-800 text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: bold;">ASMS</label> <!-- Updated font and font-weight -->
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="" class="block py-2 px-3 text-white uppercase font-bold rounded md:bg-transparent md:p-0 dark:text-white nav-link" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('app') }}" class="block py-2 px-3 text-white uppercase font-bold rounded md:bg-transparent md:p-0 dark:text-white nav-link" aria-current="page">Appointment</a>
                    </li>
                    <li>
                        <a href="" class="block py-2 px-3 text-white uppercase font-bold rounded md:bg-transparent md:p-0 dark:text-white nav-link" aria-current="page">Status</a>
                    </li>
                    <li>
                        <a href="{{ route('log') }}" class="block py-2 px-3 text-red-500 uppercase font-bold bg-dark-yellow rounded md:bg-transparent md:p-0 hover-bg-dark-yellow" aria-current="page">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="border-gray-200 rounded-lg dark:border-gray-700 max-h-max">
        <main>
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>

</html>
