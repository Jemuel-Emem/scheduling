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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>

    <style>
        [x-cloak] {
            display: none;
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

        .background-section {
            background-image: url('{{ asset('images/farm.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px;
            border-radius: 10px;
            height: 750px;
        }

        .bg-opacity-75 {
            background-color: rgba(255, 255, 255, 0.75);
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 90%;
            padding: 10px 0;
            text-align: center;
            background-color: #FFCC00; /* Dark Yellow */
        }

        @media print {
            body * {
                visibility: hidden;
            }
            .print-section, .print-section * {
                visibility: visible;
            }
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }

        @media print {
            .no-print {
                display: none;
            }

            .print-section {
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            input[type="text"] {
                border: none;
                padding: 0;
                margin: 0;
                background: none;
                color: #333;
                box-shadow: none;
                outline: none;
                font-size: 16px;
                display: block;
                width: auto;
            }

            input[type="text"]::before {
                content: attr(value);
                display: block;
            }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts
    @livewireStyles
</head>

<body class="font-sans antialiased relative">

    <x-notifications position="top-right" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full relative px-3 py-4 overflow-y-auto bg-primary-yellow"> <!-- Golden Yellow sidebar -->
            <ul class="space-y-2 font-medium">
                <a href="ds">
                    <div class="flex flex-col items-center h-full px-3 overflow-y-auto">
                        <div>
                            <img src="{{ asset('images/logolegaspi.png') }}" alt="Violation Photo" class="w-16 h-16 border-2 rounded-full">
                        </div>
                        <div class="text-center mt-2">
                            <label for="" class="font-black text-white text-xl">ASMS</label>
                        </div>
                    </div>
                </a>
                <li>
                    <a href="Admindashboard"
                        class="flex items-center p-2 text-white hover:text-light-yellow rounded-lg group hover:bg-dark-yellow hover:text-light-yellow">
                        <i class="ri-dashboard-fill"></i>
                        <span class="ms-3">DASHBOARD</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('med') }}"
                        class="flex items-center p-2 text-white hover:text-light-yellow rounded-lg group hover:bg-dark-yellow hover:text-light-yellow">
                        <i class="ri-refund-fill"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">MEDICINE</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        class="flex items-center p-2 text-white hover:text-light-yellow rounded-lg group hover:bg-dark-yellow hover:text-light-yellow">
                        <i class="ri-refund-fill"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">APPOINTMENTS</span>
                    </a>
                </li>

                <li>
                    <a href=""
                        class="flex items-center p-2 text-white hover:text-light-yellow rounded-lg group hover:bg-dark-yellow hover:text-light-yellow">
                        <i class="ri-calendar-todo-fill"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Schedule </span>
                    </a>
                </li>

                <li>
                    <a href=""
                        class="flex items-center p-2 text-white hover:text-light-yellow rounded-lg group hover:bg-dark-yellow hover:text-light-yellow">
                        <i class="ri-user-2-fill"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">USERS</span>
                    </a>
                </li>


            </ul>

            <div class="sidebar-footer">
                <a href="{{ route('log') }}" class="hover:text-light-yellow text-red-500 p-2 w-32 text-center">Logout</a>
            </div>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 background-section">
        <div class="p-4 bg-opacity-75 border-gray-200 rounded-lg dark:border-gray-700">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
