{{-- <div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Book an Appointment</h2>


        <form class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-4">

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                <input id="name" type="text" placeholder="Enter your full name"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>


            <div>
                <label for="age" class="block text-sm font-semibold text-gray-700">Age</label>
                <input id="age" type="number" placeholder="Enter your age" min="1"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>


            <div>
                <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                <input id="address" type="text" placeholder="Enter your address"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>


            <div>
                <label for="purpose" class="block text-sm font-semibold text-gray-700">Purpose of Appointment</label>
                <textarea id="purpose" rows="3" placeholder="Enter purpose of appointment"
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm"></textarea>
            </div>

            <!-- Date Schedule Field -->
            <div>
                <label for="date" class="block text-sm font-semibold text-gray-700">Date Schedule</label>
                <input id="date" type="date"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>

            <!-- Time Field -->
            <div>
                <label for="time" class="block text-sm font-semibold text-gray-700">Time</label>
                <input id="time" type="time"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>

            <!-- Health Condition Field -->
            <div>
                <label for="health-condition" class="block text-sm font-semibold text-gray-700">Health Condition</label>
                <select id="health-condition" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    <option value="">Select your health condition</option>
                    <option value="highblood">Highblood</option>
                    <option value="pregnant">Pregnant</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Health Status Field -->
            <div>
                <label for="health-status" class="block text-sm font-semibold text-gray-700">Health Status</label>
                <select id="health-status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    <option value="">Select your health status</option>
                    <option value="healthy">Healthy</option>
                    <option value="under-treatment">Under Treatment</option>
                    <option value="chronic-condition">Chronic Condition</option>
                </select>
            </div>

            <!-- Blood Pressure Field -->
            <div>
                <label for="blood-pressure" class="block text-sm font-semibold text-gray-700">Blood Pressure</label>
                <input id="blood-pressure" type="text" placeholder="Enter your blood pressure"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>

            <!-- Submit Button -->
            <div class="col-span-2">
                <button type="submit"
                        class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-200">
                    Submit Appointment
                </button>
            </div>
        </form>
    </div>
</div> --}}
<div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Appointments Management</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search appointments..."
                   class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <button wire:click="search" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Search
            </button>
        </div>
        <button wire:click="openAddModal" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow-sm hover:bg-green-600">
            Add New Appointment
        </button>
    </div>

    <!-- Appointments Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Phone</th>
                    <th class="py-2 px-4 border-b">Date Schedule</th>
                    <th class="py-2 px-4 border-b">Time Schedule</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($appointments as $appointment)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b text-center">{{ $appointment->full_name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $appointment->phone }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            {{ $appointment->reschedule_date ?: $appointment->date_schedule }}
                        </td>
                        <td class="py-2 px-4 border-b text-center">{{ $appointment->time_schedule }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <button wire:click="view({{ $appointment->id }})" class="text-green-600 hover:text-green-900 mr-4">View</button>
                            <button wire:click="editAppointment({{ $appointment->id }})" class="text-blue-600 hover:text-blue-900 mr-4">Edit</button>
                            <button wire:click="deleteAppointment({{ $appointment->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $appointments->links() }}
    </div>

    <!-- Add/Edit/View Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-semibold mb-4">
                        @if($viewMode)
                            View Appointment
                        @else
                            {{ $editMode ? 'Edit' : 'Add' }} Appointment
                        @endif
                    </h3>
                    <button wire:click="$set('showModal', false)" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if($viewMode)
                    <!-- View Mode -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><strong>Full Name:</strong> {{ $currentRecord->full_name }}</div>
                        <div><strong>Phone:</strong> {{ $currentRecord->phone }}</div>
                        <div><strong>Age:</strong> {{ $currentRecord->age }}</div>
                        <div><strong>Address:</strong> {{ $currentRecord->address }}</div>
                        <div><strong>Purpose:</strong> {{ $currentRecord->purpose ?? 'N/A' }}</div>
                        <div><strong>Original Date:</strong> {{ $currentRecord->date_schedule }}</div>
                        @if($currentRecord->reschedule_date)
                            <div><strong>Rescheduled Date:</strong> {{ $currentRecord->reschedule_date }}</div>
                        @endif
                        <div><strong>Time:</strong> {{ $currentRecord->time_schedule }}</div>
                        <div><strong>Health Condition:</strong> {{ $currentRecord->health_condition ?? 'N/A' }}</div>
                        <div><strong>Health Status:</strong> {{ $currentRecord->health_status ?? 'N/A' }}</div>
                        <div><strong>Blood Pressure:</strong> {{ $currentRecord->blood_pressure ?? 'N/A' }}</div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button wire:click="$set('showModal', false)"
                                class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Close
                        </button>
                    </div>
                @else
                    <!-- Add/Edit Mode -->
                    <form wire:submit.prevent="{{ $editMode ? 'updateAppointment' : 'submitAppointment' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                             <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                                <input type="text" id="name" wire:model.debounce.500ms="name" wire:keydown.debounce.500ms="checkExistingAppointment"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                             </div>
                                <!-- Show previous appointment info if available -->
                                @if($existingAppointment)
                                    <div class="mt-2 p-2 bg-blue-50 rounded-md text-sm">
                                        <p class="font-medium">Previous appointment found:</p>
                                        <p>Phone: {{ $existingAppointment->phone }}</p>
                                        <p>Age: {{ $existingAppointment->age }}</p>
                                        <p>Address: {{ $existingAppointment->address }}</p>
                                        <button type="button" wire:click="useExistingInfo" class="mt-1 text-blue-600 hover:text-blue-800 text-sm">
                                            Use this information
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number *</label>
                                <input type="tel" id="phone" wire:model.defer="phone"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700">Age *</label>
                                <input type="number" id="age" wire:model.defer="age" min="1"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
                                <input type="text" id="address" wire:model.defer="address"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose of Appointment</label>
                                <textarea id="purpose" wire:model.defer="purpose" rows="2"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                            </div>

                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Date Schedule *</label>
                                <input type="date" id="date" wire:model.defer="date"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="time" class="block text-sm font-medium text-gray-700">Time *</label>
                                <input type="time" id="time" wire:model.defer="time"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="reschedule_option" class="block text-sm font-medium text-gray-700">Reschedule Option</label>
                                <select id="reschedule_option" wire:model.defer="reschedule_option"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="none">None</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>

                            @if($reschedule_option === 'date')
                                <div>
                                    <label for="reschedule_date" class="block text-sm font-medium text-gray-700">Reschedule Date *</label>
                                    <input type="date" id="reschedule_date" wire:model.defer="reschedule_date"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    @error('reschedule_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            @endif

                            <div>
                                <label for="health_condition" class="block text-sm font-medium text-gray-700">Health Condition</label>
                                <select id="health_condition" wire:model.defer="health_condition"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Select health condition</option>
                                    <option value="highblood">Highblood</option>
                                    <option value="pregnant">Pregnant</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div>
                                <label for="health_status" class="block text-sm font-medium text-gray-700">Health Status</label>
                                <select id="health_status" wire:model.defer="health_status"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Select health status</option>
                                    <option value="healthy">Healthy</option>
                                    <option value="under-treatment">Under Treatment</option>
                                    <option value="chronic-condition">Chronic Condition</option>
                                </select>
                            </div>

                            <div>
                                <label for="blood_pressure" class="block text-sm font-medium text-gray-700">Blood Pressure</label>
                                <input type="text" id="blood_pressure" wire:model.defer="blood_pressure"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <button type="button" wire:click="$set('showModal', false)"
                                    class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ $editMode ? 'Update' : 'Save' }} Appointment
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    @endif
</div>
