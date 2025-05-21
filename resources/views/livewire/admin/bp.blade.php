<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">BP Monitoring Management</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search by Name or Phone"
                   class="block w-full p-2 border border-gray-300 rounded-lg">
                   <button wire:click="sarch" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Search
                </button>
                </div>
        {{-- <button wire:click="openAddModal" class="px-6 py-2 bg-green-500 text-white font-medium rounded-lg hover:bg-green-600">
            Add New BP Record
        </button> --}}
    </div>

    <!-- BP Monitoring Records Table -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Resident Name</th>
                    <th class="py-3 px-6 text-left">Age</th>
                    <th class="py-3 px-6 text-left">Gender </th>
                    <th class="py-3 px-6 text-left">Date Of Birth </th>
                    <th class="py-3 px-6 text-left">BP</th>
                    <th class="py-3 px-6 text-left">Level</th>
                    <th class="py-3 px-6 text-left">Date</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    {{-- <th class="py-3 px-6 text-center">Actions</th> --}}
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($bp_monitorings as $bp_monitoring)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{ $bp_monitoring->resident_name }}</td>
                        <td class="py-3 px-6 text-left">{{ $bp_monitoring->age }}</td>
                        <td class="py-3 px-6 text-left">{{ $bp_monitoring->gender }}</td>
                        <td class="py-3 px-6 text-left">{{ $bp_monitoring->date_of_birth }}</td>
                        <td class="py-3 px-6 text-left">{{ $bp_monitoring->bp }}</td>
                        <td class="py-3 px-6 text-left">{{ ucfirst($bp_monitoring->level) }}</td>
                        <td class="py-3 px-6 text-left">{{ $bp_monitoring->date }}</td>
                        <td class="py-3 px-6 text-left">{{ $bp_monitoring->status}}</td>
                        {{-- <td class="py-3 px-6 text-center">
                            <button wire:click="view({{ $bp_monitoring->id }})" class="text-green-600 hover:text-green-900 mr-4">View</button>
                            <button wire:click="edit({{ $bp_monitoring->id }})" class="text-blue-600 hover:text-blue-900 mr-4">Edit</button>
                            <button wire:click="delete({{ $bp_monitoring->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $bp_monitorings->links() }}
    </div>

    <!-- Add/Edit/View Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-semibold mb-4">
                        @if($viewMode)
                            View BP Record
                        @else
                            {{ $editMode ? 'Edit' : 'Add' }} BP Record
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
                        <div><strong>Resident Name:</strong> {{ $currentRecord->resident_name }}</div>
                        <div><strong>Age:</strong> {{ $currentRecord->age }}</div>
                        <div><strong>Phone Number:</strong> {{ $currentRecord->phone_number }}</div>
                        <div><strong>Blood Pressure:</strong> {{ $currentRecord->bp }}</div>
                        <div><strong>BP Level:</strong> {{ ucfirst($currentRecord->level) }}</div>
                        <div><strong>Date:</strong> {{ $currentRecord->date }}</div>
                        <div><strong>Gender:</strong> {{ ucfirst($currentRecord->gender) }}</div>
<div><strong>Date of Birth:</strong> {{ $currentRecord->date_of_birth }}</div>

                    </div>

                    <div class="mt-6 flex justify-end">
                        <button wire:click="$set('showModal', false)"
                                class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Close
                        </button>
                    </div>
                @else
                    <!-- Add/Edit Mode -->
                    <form wire:submit.prevent="submit">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="resident_name" class="block text-gray-700 font-medium mb-2">Resident Name *</label>
                                <input type="text" wire:model.defer="resident_name" id="resident_name"
                                       class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter resident name">
                                @error('resident_name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="age" class="block text-gray-700 font-medium mb-2">Age *</label>
                                <input type="number" wire:model.defer="age" id="age"
                                       class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter age">
                                @error('age') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                                <select wire:model.defer="gender" id="gender" class="w-full p-2 border border-gray-300 rounded-lg">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="dob" class="block text-gray-700 font-medium mb-2">Date of Birth</label>
                                <input type="date" wire:model.defer="dob" id="dob"
                                       class="w-full p-2 border border-gray-300 rounded-lg">
                                @error('dob') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="phone_number" class="block text-gray-700 font-medium mb-2">Phone Number *</label>
                                <input type="text" wire:model.defer="phone_number" id="phone_number"
                                       class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter phone number">
                                @error('phone_number') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="bp" class="block text-gray-700 font-medium mb-2">Blood Pressure (BP) *</label>
                                <input type="text" wire:model.defer="bp" id="bp"
                                       class="w-full p-2 border border-gray-300 rounded-lg" placeholder="e.g. 120/80 mmHg">
                                @error('bp') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="level" class="block text-gray-700 font-medium mb-2">BP Level *</label>
                                <select wire:model.defer="level" id="level"
                                        class="w-full p-2 border border-gray-300 rounded-lg">
                                    <option value="">Select Level</option>
                                    <option value="normal">Normal</option>
                                    <option value="elevated">Elevated</option>
                                    <option value="high">High</option>
                                    <option value="low">Low</option>
                                </select>
                                @error('level') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="date" class="block text-gray-700 font-medium mb-2">Date *</label>
                                <input type="date" wire:model.defer="date" id="date"
                                       class="w-full p-2 border border-gray-300 rounded-lg">
                                @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                <input type="text" id="status" wire:model.defer="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Add this to your form grid, after the status field -->
        <div class="col-span-2">
            <div class="flex items-center">
                <input type="checkbox" id="is_desease" wire:model.defer="is_desease" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_desease" class="ml-2 block text-sm text-gray-700">
                    Deceased
                </label>
            </div>
            @error('is_desease') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <button type="button" wire:click="$set('showModal', false)"
                                    class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ $editMode ? 'Update' : 'Save' }} BP Record
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    @endif
</div>
