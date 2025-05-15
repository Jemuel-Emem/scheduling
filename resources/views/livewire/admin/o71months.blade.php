<div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">O71 Months Management</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search..."
                   class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">

                   <button wire:click="sarch" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Search
                </button>
                </div>
        <button wire:click="openAddModal" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Add New O71 Month
        </button>
    </div>

    <!-- O71 Months Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name of Child</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name of Parent</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age in Months</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($o71months as $o71month)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $o71month->name_of_child }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $o71month->name_of_parent }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $o71month->date_of_birth->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $o71month->age_in_month }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $o71month->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="view({{ $o71month->id }})" class="text-green-600 hover:text-green-900 mr-4">View</button>
                            <button wire:click="edit({{ $o71month->id }})" class="text-blue-600 hover:text-blue-900 mr-4">Edit</button>
                            <button wire:click="delete({{ $o71month->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $o71months->links() }}
    </div>

    <!-- Add/Edit/View Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 max-h-screen overflow-y-auto">
                <h3 class="text-xl font-semibold mb-4">
                    @if($viewMode)
                        View O71 Month
                    @else
                        {{ $editMode ? 'Edit' : 'Add' }} O71 Month
                    @endif
                </h3>

                @if($viewMode)
                    <!-- View Mode -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><strong>Name of Child:</strong> {{ $currentRecord->name_of_child }}</div>
                        <div><strong>Name of Parent:</strong> {{ $currentRecord->name_of_parent }}</div>
                        <div><strong>Date of Birth:</strong> {{ $currentRecord->date_of_birth->format('Y-m-d') }}</div>
                        <div><strong>Age in Months:</strong> {{ $currentRecord->age_in_month }}</div>
                        <div><strong>Weight:</strong> {{ $currentRecord->weight }}</div>
                        <div><strong>Height:</strong> {{ $currentRecord->height }}</div>
                        <div><strong>Family No:</strong> {{ $currentRecord->family_no }}</div>
                        <div><strong>Zone:</strong> {{ $currentRecord->zone }}</div>
                        <div><strong>Phone Number:</strong> {{ $currentRecord->phone_number }}</div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button wire:click="$set('showModal', false)"
                                class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Close
                        </button>
                @else
                    <!-- Add/Edit Mode -->
                    <form wire:submit.prevent="{{ $editMode ? 'updateO71month' : 'addO71month' }}">
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
                                <label for="age_in_month" class="block text-sm font-medium text-gray-700">Age in Months *</label>
                                <input type="number" id="age_in_month" wire:model.defer="age_in_month"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('age_in_month') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
                                <input type="number" step="0.01" id="weight" wire:model.defer="weight"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                                @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="height" class="block text-sm font-medium text-gray-700">Height</label>
                                <input type="number" step="0.01" id="height" wire:model.defer="height"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                                @error('height') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender *</label>
                                <select id="gender" wire:model.defer="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number *</label>
                                <input type="text" id="phone_number" wire:model.defer="phone_number"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                            @if(!$viewMode)
                                <button type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ $editMode ? 'Update' : 'Add' }} O71 Month
                                </button>
                            @endif
                        </div>
                    </form>
                @endif
            </div>
        </div>
    @endif
</div>
