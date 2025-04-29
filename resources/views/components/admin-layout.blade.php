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

        /* Color Improvements - Blue Gradient Theme */
        .bg-primary-blue {
            background: linear-gradient(to right, #3b82f6, #60a5fa); /* Light to lighter blue */
        }

        .bg-dark-blue {
            background: linear-gradient(to right, #2563eb, #1d4ed8); /* Darker blue */
        }

        .text-dark-blue {
            color: #1d4ed8; /* Dark Blue */
        }

        .text-light-blue {
            color: #60a5fa; /* Light Blue */
        }

        .hover-bg-dark-blue:hover {
            background: linear-gradient(to right, #1e40af, #1d4ed8); /* Even darker on hover */
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
        <div class="h-full relative px-3 py-4 overflow-y-auto bg-primary-blue">
            <!-- Golden Yellow sidebar -->
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
                    <a href="{{ route('admin-dashboard') }}"
                        class="flex items-center p-2 text-white hover:text-light-yellow rounded-lg group hover:bg-dark-yellow hover:text-light-yellow">
                        <i class="ri-dashboard-fill text-blue-500"></i>
                        <span class="ml-10 ms-3">Dashboard</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('admin.annoucement') }}"
                        class="flex items-center p-2 text-white hover:text-light-yellow rounded-lg group hover:bg-dark-yellow hover:text-light-yellow">
                        <i class="ri-megaphone-fill text-blue-500"></i>
                        <span class="ml-10 ms-3 ">Announcements</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('apps') }}"
                        class="flex items-center p-2 text-white hover:text-light-yellow rounded-lg group hover:bg-dark-yellow hover:text-light-yellow">
                        <i class="ri-team-fill text-blue-500"></i>
                        <span class="ml-10 ms-3 ">Appointment</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('med') }}"
                        class="flex items-center p-2  hover:text-light-yellow rounded-lg group hover:bg-dark-yellow hover:text-light-yellow">
                        <i class="ri-medicine-bottle-fill text-blue-500"></i>
                        <span class="ml-10 ms-3 text-white ">Medicines</span>
                    </a>
                </li>


                <li>
                    <!-- Dropdown Trigger Button -->
                    <button type="button"
                        class="flex items-center p-2 w-full text-white hover:text-light-yellow rounded-lg group hover:bg-dark-yellow"
                        aria-controls="residentsDropdown" data-collapse-toggle="residentsDropdown">
                        <i class="ri-calendar-todo-fill text-blue-500"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Residents</span>
                        <!-- Arrow Indicator -->
                        <svg class="w-5 h-5 ms-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <ul id="residentsDropdown" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('res') }}"
                                class="flex items-center w-full p-2 text-white rounded-lg pl-9 group hover:bg-dark-yellow hover:text-light-yellow">
                                All Residents
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('months') }}"
                                class="flex items-center w-full p-2 text-white rounded-lg pl-9 group hover:bg-dark-yellow hover:text-light-yellow">
                                0-71 months
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.pregnancy') }}"
                                class="flex items-center w-full p-2 text-white rounded-lg pl-9 group hover:bg-dark-yellow hover:text-light-yellow">
                                Pregnancy
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.birthregistry') }}"
                                class="flex items-center w-full p-2 text-white rounded-lg pl-9 group hover:bg-dark-yellow hover:text-light-yellow">
                               Birth Registry Records
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('bps') }}"
                                class="flex items-center w-full p-2 text-white rounded-lg pl-9 group hover:bg-dark-yellow hover:text-light-yellow">
                                BP Monitoring
                            </a>
                        </li>
                    </ul>
                </li>





            </ul>

            <div class="sidebar-footer">
                <a href="{{ route('log') }}"
                   class="flex items-center justify-center gap-2 p-2 w-32 mx-auto text-white bg-red-500 rounded-md hover:bg-red-600 transition-colors duration-300">
                    <i class="ri-logout-box-r-line text-xl"></i>
                    <span>Logout</span>
                </a>
            </div>

        </div>
    </aside>

    <div class="p-4 sm:ml-64  m-h-screen rounded-lg">
        <div class="p-4  border-gray-200 rounded-lg ">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
