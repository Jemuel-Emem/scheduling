<div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Pregnancy Records Management</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search by Name or Mobile Number"
                   class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                   <button wire:click="sarch" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Search
                </button>
                </div>
        <button wire:click="openAddModal" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Add New Pregnancy Record
        </button>
    </div>

    <!-- Pregnancy Records Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white table-auto border-separate border-spacing-0.5">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Zone</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pregnancies as $pregnancy)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 text-sm text-center text-gray-900">{{ $pregnancy->name }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-500">{{ $pregnancy->zone }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-500">{{ \Carbon\Carbon::parse($pregnancy->estimated_due_date)->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-sm text-center flex space-x-2 justify-center">
                            <button wire:click="view({{ $pregnancy->id }})" class="text-green-600 hover:text-green-900">View</button>
                            <button wire:click="editPregnancy({{ $pregnancy->id }})" class="text-blue-600 hover:text-blue-900">Edit</button>
                            <button wire:click="deletePregnancy({{ $pregnancy->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pregnancies->links() }}
    </div>

    <!-- Add/Edit/View Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-semibold mb-4">
                        @if($viewMode)
                            View Pregnancy Record
                        @else
                            {{ $editMode ? 'Edit' : 'Add' }} Pregnancy Record
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
                        <div><strong>Name:</strong> {{ $currentRecord->name }}</div>
                        <div><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($currentRecord->date_of_birth)->format('Y-m-d') }}</div>
                        <div><strong>Age:</strong> {{ $currentRecord->age }}</div>
                        <div><strong>Family No:</strong> {{ $currentRecord->family_no }}</div>
                        <div><strong>Zone:</strong> {{ $currentRecord->zone }}</div>
                        <div><strong>Mobile Number:</strong> {{ $currentRecord->mobile_number }}</div>
                        <div><strong>Estimated Due Date:</strong> {{ \Carbon\Carbon::parse($currentRecord->estimated_due_date)->format('Y-m-d') }}</div>
                        <div><strong>Last Check-Up:</strong> {{ $currentRecord->last_checkup ? \Carbon\Carbon::parse($currentRecord->last_checkup)->format('Y-m-d') : 'N/A' }}</div>
                        <div><strong>Child's Name:</strong> {{ $currentRecord->child_name ?? 'N/A' }}</div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button wire:click="$set('showModal', false)"
                                class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Close
                        </button>
                    </div>
                @else
                    <!-- Add/Edit Mode -->
                    <form wire:submit.prevent="{{ $editMode ? 'updatePregnancy' : 'addPregnancyRecord' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
                                <input type="text" id="name" wire:model.defer="name"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth *</label>
                                <input type="date" id="date_of_birth" wire:model.defer="date_of_birth"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700">Age *</label>
                                <input type="number" id="age" wire:model.defer="age"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="family_no" class="block text-sm font-medium text-gray-700">Family No *</label>
                                <input type="number" id="family_no" wire:model.defer="family_no"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('family_no') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="zone" class="block text-sm font-medium text-gray-700">Zone *</label>
                                <input type="text" id="zone" wire:model.defer="zone"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('zone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number *</label>
                                <input type="text" id="mobile_number" wire:model.defer="mobile_number"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('mobile_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="estimated_due_date" class="block text-sm font-medium text-gray-700">Estimated Due Date *</label>
                                <input type="date" id="estimated_due_date" wire:model.defer="estimated_due_date"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('estimated_due_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="last_checkup" class="block text-sm font-medium text-gray-700">Last Check-Up</label>
                                <input type="date" id="last_checkup" wire:model.defer="last_checkup"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                                @error('last_checkup') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="child_name" class="block text-sm font-medium text-gray-700">Name of Child</label>
                                <input type="text" id="child_name" wire:model.defer="child_name"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                                @error('child_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <button type="button" wire:click="$set('showModal', false)"
                                    class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ $editMode ? 'Update' : 'Add' }} Pregnancy Record
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    @endif
</div>
