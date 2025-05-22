<div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">All Residents</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search Resident..."
                   class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <button wire:click="sarch" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Search
            </button>
        </div>

        <button wire:click="openAddModal('o71month')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Add New O71 Month
        </button>

        <button wire:click="openAddModal('pregnancy')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Add New Pregnancy Record
        </button>

        <button wire:click="openAddModal('birthregistry')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Add New Birth Record
        </button>

        <button wire:click="openAddModal('bp_monitoring')" class="px-6 py-2 bg-green-500 text-white font-medium rounded-lg hover:bg-green-600">
            Add New BP Record
        </button>
    </div>

    <!-- Residents Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                     <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Number</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($residents as $record)
                    <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $record->id_number }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $record->full_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            @if($record->date_of_birth)
                                {{ \Carbon\Carbon::parse($record->date_of_birth)->format('M d, Y') }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $record->gender }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $record->phone_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $record->status }}</td>
                                               <td class="px-6 py-4 text-sm text-gray-500">{{ $record->type }}</td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="relative inline-block text-left mr-2">
        <div>
            <button type="button" wire:click="openTransferModal({{ $record->id }}, '{{ $record->type }}')"
                    class="text-purple-600 hover:text-purple-900"
                    id="category-menu-button-{{ $record->id }}"
                    aria-expanded="false"
                    aria-haspopup="true">
                Category
            </button>
        </div>
    </div>
                            <button wire:click="view({{ $record->id }}, '{{ $record->type }}')"
                                class="text-blue-600 hover:text-blue-900 mr-2">
                                View
                            </button>
                            <button wire:click="edit({{ $record->id }}, '{{ $record->type }}')"
                                    class="text-green-600 hover:text-green-900 mr-2">
                                Edit
                            </button>
                            <button wire:click="delete({{ $record->id }}, '{{ $record->type }}')"
                                    class="text-red-600 hover:text-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $residents->links() }}
    </div>

    <!-- Modal -->
    @if($showModal)
        @if($modalType === 'o71month')
            <!-- O71 Month Modal -->
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                             <div><strong>ID Number:</strong> {{ $currentRecord->id_number }}</div>
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
                        </div>
                    @else
                        <form wire:submit.prevent="save">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                      <div>
                                    <label for="id_number" class="block text-sm font-medium text-gray-700">ID Number *</label>
                                    <input type="text" id="id_number" wire:model.defer="id_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('id_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="name_of_child" class="block text-sm font-medium text-gray-700">Name of Child *</label>
                                    <input type="text" id="name_of_child" wire:model.defer="name_of_child" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('name_of_child') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="name_of_parent" class="block text-sm font-medium text-gray-700">Name of Parent *</label>
                                    <input type="text" id="name_of_parent" wire:model.defer="name_of_parent" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('name_of_parent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth *</label>
                                    <input type="date" id="date_of_birth" wire:model.defer="date_of_birth" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="age_in_month" class="block text-sm font-medium text-gray-700">Age in Months *</label>
                                    <input type="number" id="age_in_month" wire:model.defer="age_in_month" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('age_in_month') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
                                    <input type="number" step="0.01" id="weight" wire:model.defer="weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                                    @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="height" class="block text-sm font-medium text-gray-700">Height</label>
                                    <input type="number" step="0.01" id="height" wire:model.defer="height" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
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
                                    <label for="family_number" class="block text-sm font-medium text-gray-700">Family No *</label>
                                    <input type="number" id="family_number" wire:model.defer="family_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('family_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="zone" class="block text-sm font-medium text-gray-700">Zone *</label>
                                    <input type="text" id="zone" wire:model.defer="zone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('zone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number *</label>
                                    <input type="text" id="phone_number" wire:model.defer="phone_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                    <input type="text" id="status" wire:model.defer="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

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
                                    {{ $editMode ? 'Update' : 'Add' }} O71 Month
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

        @elseif($modalType === 'pregnancy')
            <!-- Pregnancy Modal -->
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
                             <div><strong>ID Number:</strong> {{ $currentRecord->id_number}}</div>
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
                        <form wire:submit.prevent="{{ $editMode ? 'updatePregnancy' : 'save' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                     <div>
                                    <label for="id_number1" class="block text-sm font-medium text-gray-700">ID Number *</label>
                                    <input type="text" id="id_number1" wire:model.defer="id_number1"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('id_number1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="pregnancy_name" class="block text-sm font-medium text-gray-700">Name *</label>
                                    <input type="text" id="pregnancy_name" wire:model.defer="pregnancy_name"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('pregnancy_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                    <label for="pregnancy_family_number" class="block text-sm font-medium text-gray-700">Family No *</label>
                                    <input type="number" id="pregnancy_family_number" wire:model.defer="pregnancy_family_number"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('pregnancy_family_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                    <input type="text" id="status" wire:model.defer="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

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
                                    {{ $editMode ? 'Update' : 'Add' }} Pregnancy Record
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

        @elseif($modalType === 'birthregistry')
            <!-- Birth Registry Modal -->
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
                             <div><strong>ID Number:</strong> {{ $currentRecord->id_number }}</div>
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
                        <form wire:submit.prevent="{{ $editMode ? 'update' : 'save' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                  <div>
                                    <label for="id_number2" class="block text-sm font-medium text-gray-700">Id Number*</label>
                                    <input type="text" id="id_number2" wire:model.defer="id_number2"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('id_number2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
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
                                    <label for="b_date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth *</label>
                                    <input type="date" id="b_date_of_birth" wire:model.defer="b_date_of_birth"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('b_date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="birthregistry_fam_number" class="block text-sm font-medium text-gray-700">Family No *</label>
                                    <input type="number" id="birthregistry_fam_number" wire:model.defer="birthregistry_fam_number"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('birthregistry_fam_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                    <input type="text" id="status" wire:model.defer="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

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
                                    {{ $editMode ? 'Update' : 'Save' }} Birth Record
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

        @elseif($modalType === 'bp_monitoring')
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
                          <div><strong>ID Number:</strong> {{ $currentRecord->id_number }}</div>
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
                    <form wire:submit.prevent="save">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                   <div>
                                <label for="id_number3" class="block text-gray-700 font-medium mb-2">ID Number*</label>
                                <input type="text" wire:model.defer="id_number3" id="id_number3"
                                       class="w-full p-2 border border-gray-300 rounded-lg" placeholder="">
                                @error('id_number3') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

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
                                <label for="b_date_of_birth" class="block text-gray-700 font-medium mb-2">Date of Birth</label>
                                <input type="date" wire:model.defer="b_date_of_birth" id="b_date_of_birth"
                                       class="w-full p-2 border border-gray-300 rounded-lg">
                                @error('b_date_of_birth') <span class="text-red-500">{{ $message }}</span> @enderror
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
        @endif
            </div>
        </div>

@endif



{{-- modal for category --}}

@if($showTransferModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <div class="flex justify-between items-start">
                <h3 class="text-xl font-semibold mb-4">Transfer Record</h3>
                <button wire:click="closeTransferModal" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mb-4">
                <p>Transfer <strong>{{ $transferRecordName }}</strong> to:</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                @foreach($availableTransferTypes as $type)
                    @if($type !== $transferCurrentType)
                        <button wire:click="transferTo('{{ $type }}')"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            {{ ucfirst($type) }}
                        </button>
                    @endif
                @endforeach
            </div>

            <div class="mt-6 flex justify-end">
                <button wire:click="closeTransferModal"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </button>
            </div>
        </div>
    </div>
@endif
</div>
