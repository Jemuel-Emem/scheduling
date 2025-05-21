<div class="background-section">
    <div class="p-8 bg-opacity-75 border-gray-200 rounded-lg dark:border-gray-700">
        <main>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- <!-- Residents Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
                        <i class="ri-group-2-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-600">Number of Residents</h2>
                        <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $residentCount }}</p>
                    </div>
                </div> --}}

                <!-- Appointments Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
                        <i class="ri-calendar-check-fill text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-600"> Scheduled Appointments</h2>
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
<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="flex items-center space-x-4 mb-4">
        <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
            <i class="ri-heart-pulse-fill text-2xl"></i>
        </div>
        <div>
            <h2 class="text-lg font-bold text-blue-600">BP Monitoring</h2>
            <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $bpMonitoringCount }}</p>
        </div>
    </div>
    <div class="grid grid-cols-4 gap-2">
        <div class="bg-green-100 p-2 rounded-lg text-center">
            <p class="text-sm font-medium text-green-800">Normal</p>
            <p class="text-xl font-semibold">{{ $normalBpCount }}</p>
        </div>
        <div class="bg-yellow-100 p-2 rounded-lg text-center">
            <p class="text-sm font-medium text-yellow-800">Elevated</p>
            <p class="text-xl font-semibold">{{ $elevatedBpCount }}</p>
        </div>
        <div class="bg-red-100 p-2 rounded-lg text-center">
            <p class="text-sm font-medium text-red-800">High</p>
            <p class="text-xl font-semibold">{{ $highBpCount }}</p>
        </div>
        <div class="bg-blue-100 p-2 rounded-lg text-center">
            <p class="text-sm font-medium text-blue-800">Low</p>
            <p class="text-xl font-semibold">{{ $lowBpCount }}</p>
        </div>
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

<!-- Rescheduled Appointments Card -->
<div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-full text-white">
        <i class="ri-refresh-line text-2xl"></i>
    </div>
    <div>
        <h2 class="text-lg font-bold text-blue-600">Rescheduled Appointments</h2>
        <p class="text-3xl font-semibold mt-1 text-gray-800">{{ $rescheduleCount }}</p>
    </div>
</div>


            </div>
        </main>
    </div>


    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
        <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Manage Announcements</h2>

            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">{{ session('message') }}</strong>
                </div>
            @endif

            <!-- Add Announcement Form -->
            <form wire:submit.prevent="submitAnnouncement" class="grid grid-cols-1 gap-6 mb-8">
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700">Title</label>
                    <input id="title" type="text" wire:model="title" placeholder="Enter announcement title"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="details" class="block text-sm font-semibold text-gray-700">Details</label>
                    <textarea id="details" wire:model="details" rows="4" placeholder="Enter announcement details"
                              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm"></textarea>
                    @error('details') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-semibold text-gray-700">Date</label>
                    <input id="date" type="date" wire:model="date"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="time" class="block text-sm font-semibold text-gray-700">Time</label>
                    <input id="time" type="time" wire:model="time"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="target" class="block text-sm font-semibold text-gray-700">Send To</label>
                    <select id="target" wire:model="target"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                        <option value="residents">Residents</option>
                        <option value="o71months">0-71 Months Children</option>
                        <option value="bp_monitorings">Blood Pressure Monitorings</option>
                        <option value="pregnancies">Pregnant Women</option>
                        <option value="birthregistries">Birth Registries</option>
                    </select>
                    @error('target') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <button type="submit"
                            class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-200">
                        Add Announcement
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Title</th>
                            <th class="border border-gray-300 px-4 py-2">Details</th>
                            <th class="border border-gray-300 px-4 py-2">Date</th>
                            <th class="border border-gray-300 px-4 py-2">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $announcement)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $announcement->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $announcement->details }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $announcement->date }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $announcement->time }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-4">No announcements found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
