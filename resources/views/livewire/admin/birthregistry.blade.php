<div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Birth Registry Management</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search by Name"
                   class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                   <button wire:click="sarch" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Search
                </button>

                </div>
        <button wire:click="openAddModal" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Add New Birth Record
        </button>
    </div>

    <!-- Birth Registry Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-2 px-4 border-b">Name of Child</th>
                    <th class="py-2 px-4 border-b">Name of Parent</th>
                    <th class="py-2 px-4 border-b">Date of Birth</th>
                    <th class="py-2 px-4 border-b">Family No.</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($birthregistries as $record)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b text-center">{{ $record->name_of_child }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $record->name_of_parent }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $record->date_of_birth }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $record->family_no }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <button wire:click="view({{ $record->id }})" class="text-green-600 hover:text-green-900 mr-4">View</button>
                            <button wire:click="edit({{ $record->id }})" class="text-blue-600 hover:text-blue-900 mr-4">Edit</button>
                            <button wire:click="delete({{ $record->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $birthregistries->links() }}
    </div>

    <!-- Add/Edit/View Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-semibold mb-4">
                        @if($viewMode)
                            View Birth Record
                        @else
                            {{ $editMode ? 'Edit' : 'Add' }} Birth Record
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
                        <div><strong>Name of Child:</strong> {{ $currentRecord->name_of_child }}</div>
                        <div><strong>Name of Parent:</strong> {{ $currentRecord->name_of_parent }}</div>
                        <div><strong>Date of Birth:</strong> {{ $currentRecord->date_of_birth }}</div>
                        <div><strong>Family No:</strong> {{ $currentRecord->family_no }}</div>
                        <div><strong>Zone:</strong> {{ $currentRecord->zone }}</div>
                        <div><strong>Gender:</strong> {{ $currentRecord->gender }}</div>
                        <div><strong>Birth Weight:</strong> {{ $currentRecord->birth_weight }} kg</div>
                        <div><strong>Place of Birth:</strong> {{ $currentRecord->place_of_birth }}</div>
                        <div><strong>Registration Status:</strong> {{ $currentRecord->is_registered ? 'Registered' : 'Not Registered' }}</div>
                        <div><strong>Phone Number:</strong> {{ $currentRecord->phone_number }}</div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button wire:click="$set('showModal', false)"
                                class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Close
                        </button>
                    </div>
                @else
                    <!-- Add/Edit Mode -->
                    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name_of_child" class="block text-sm font-medium text-gray-700">Name of Child *</label>
                                <input type="text" id="name_of_child" wire:model.defer="name_of_child"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('name_of_child') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="name_of_parent" class="block text-sm font-medium text-gray-700">Name of Parent *</label>
                                <input type="text" id="name_of_parent" wire:model.defer="name_of_parent"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('name_of_parent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth *</label>
                                <input type="date" id="date_of_birth" wire:model.defer="date_of_birth"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender *</label>
                                <select id="gender" wire:model.defer="gender"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="birth_weight" class="block text-sm font-medium text-gray-700">Birth Weight (kg) *</label>
                                <input type="number" step="0.01" id="birth_weight" wire:model.defer="birth_weight"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('birth_weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth *</label>
                                <input type="text" id="place_of_birth" wire:model.defer="place_of_birth"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('place_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="is_registered" class="block text-sm font-medium text-gray-700">Registration Status *</label>
                                <select id="is_registered" wire:model.defer="is_registered"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Registered</option>
                                    <option value="0">Not Registered</option>
                                </select>
                                @error('is_registered') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number *</label>
                                <input type="text" id="phone_number" wire:model.defer="phone_number"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <button type="button" wire:click="$set('showModal', false)"
                                    class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ $editMode ? 'Update' : 'Save' }} Birth Record
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    @endif
</div>
