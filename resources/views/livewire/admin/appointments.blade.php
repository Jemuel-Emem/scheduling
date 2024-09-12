<div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Book an Appointment</h2>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ session('message') }}</strong>
            </div>
        @endif

        <form wire:submit.prevent="{{ $editMode ? 'updateAppointment' : 'submitAppointment' }}" class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-4">

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                <input id="name" type="text" wire:model="name" placeholder="Enter your full name"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number</label>
                <input id="phone" type="tel" wire:model="phone" placeholder="Enter your phone number"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <div>
                <label for="age" class="block text-sm font-semibold text-gray-700">Age</label>
                <input id="age" type="number" wire:model="age" placeholder="Enter your age" min="1"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <div>
                <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                <input id="address" type="text" wire:model="address" placeholder="Enter your address"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <div>
                <label for="purpose" class="block text-sm font-semibold text-gray-700">Purpose of Appointment</label>
                <textarea id="purpose" wire:model="purpose" rows="3" placeholder="Enter purpose of appointment"
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm"></textarea>
            </div>


            <div>
                <label for="date" class="block text-sm font-semibold text-gray-700">Date Schedule</label>
                <input id="date" type="date" wire:model="date"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <div class="col-span-2">
                <label for="reschedule-option" class="block text-sm font-semibold text-gray-700">Reschedule Option</label>
                <select id="reschedule-option" wire:model="reschedule_option" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    <option value="none">None</option>
                    <option value="date">Date</option>
                </select>
            </div>


            <div id="reschedule-date-field" class="col-span-2 hidden">
                <label for="reschedule-date" class="block text-sm font-semibold text-gray-700">Date of Reschedule</label>
                <input id="reschedule-date" type="date" wire:model="reschedule_date"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('reschedule_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <div>
                <label for="time" class="block text-sm font-semibold text-gray-700">Time</label>
                <input id="time" type="time" wire:model="time"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <div>
                <label for="health-condition" class="block text-sm font-semibold text-gray-700">Health Condition</label>
                <select id="health-condition" wire:model="health_condition" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    <option value="">Select your health condition</option>
                    <option value="highblood">Highblood</option>
                    <option value="pregnant">Pregnant</option>
                    <option value="other">Other</option>
                </select>
            </div>


            <div>
                <label for="health-status" class="block text-sm font-semibold text-gray-700">Health Status</label>
                <select id="health-status" wire:model="health_status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    <option value="">Select your health status</option>
                    <option value="healthy">Healthy</option>
                    <option value="under-treatment">Under Treatment</option>
                    <option value="chronic-condition">Chronic Condition</option>
                </select>
            </div>


            <div>
                <label for="blood-pressure" class="block text-sm font-semibold text-gray-700">Blood Pressure</label>
                <input id="blood-pressure" type="text" wire:model="blood_pressure" placeholder="Enter your blood pressure"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>


            <div class="col-span-2">
                <button type="submit"
                        class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-200">
                    {{ $editMode ? 'Update Appointment' : 'Book Appointment' }}
                </button>
            </div>
        </form>

        <div class="mt-8">

            <div class="flex mb-4">
                <input type="text" wire:model="search" placeholder="Search appointments..." class="p-2 border rounded w-full">
                <button class="ml-2 bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg" wire:click="searchname">Search</button>
            </div>

            <!-- Table Section -->
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Phone</th>
                        <th class="py-2 px-4 border-b">Date</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    @foreach ($appointments as $appointment)
                        <tr class="hover:bg-gray-50 text-center">
                            <td class="py-2 px-4 border-b">{{ $appointment->full_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->phone }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->date_schedule }}</td>
                            <td class="py-2 px-4 border-b flex space-x-2 justify-center">
                                <button wire:click="editAppointment({{ $appointment->id }})" class="px-2 py-1 bg-blue-500 text-white rounded">Edit</button>
                                <button wire:click="deleteAppointment({{ $appointment->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>

    <script>
        document.getElementById('reschedule-option').addEventListener('change', function() {
            const rescheduleDateField = document.getElementById('reschedule-date-field');
            if (this.value === 'date') {
                rescheduleDateField.classList.remove('hidden');
            } else {
                rescheduleDateField.classList.add('hidden');
            }
        });
    </script>
</div>
