<div class="background-section">
    <div class="p-8 bg-opacity-75 border-gray-200 rounded-lg dark:border-gray-700">
        <main>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-dark-yellow p-3 rounded-full text-white">
                        <i class="ri-group-2-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-dark-yellow">Number of Residents</h2>
                        <p class="text-3xl font-semibold mt-1 text-blue-500">{{ $residentCount }}</p>
                    </div>
                </div>


                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-dark-yellow p-3 rounded-full text-white">
                        <i class="ri-refund-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-dark-yellow">Appointments</h2>
                        <p class="text-3xl font-semibold mt-1 text-blue-500">{{ $appointmentCount }}</p>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
