<div class="background-section">
    <div class="p-8 bg-opacity-75 border-gray-200 rounded-lg dark:border-gray-700">
        <main>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Residents Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
                        <i class="ri-group-2-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-600">Number of Residents</h2>
                        <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $residentCount }}</p>
                    </div>
                </div>

                <!-- Appointments Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
                        <i class="ri-calendar-check-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-600">Appointments</h2>
                        <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $appointmentCount }}</p>
                    </div>
                </div>

                <!-- Birth Registry Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
                        <i class="ri-file-list-2-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-600">Birth Registry</h2>
                        <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $birthRegistryCount }}</p>
                    </div>
                </div>

                <!-- BP Monitoring Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
                        <i class="ri-heart-pulse-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-600">BP Monitoring</h2>
                        <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $bpMonitoringCount }}</p>
                    </div>
                </div>

                <!-- 0-71 Months Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
                        <i class="ri-bear-smile-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-600">0-71 Months</h2>
                        <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $o71MonthsCount }}</p>
                    </div>
                </div>

                <!-- Pregnancy Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
                        <i class="	ri-heart-pulse-fill"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-600">Pregnancy</h2>
                        <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $pregnancyCount }}</p>
                    </div>
                </div>

                <!-- Medicine Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
                        <i class="ri-medicine-bottle-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-600">Medicines</h2>
                        <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $medicineCount }}</p>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
