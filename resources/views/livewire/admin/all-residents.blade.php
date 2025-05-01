<div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Add Resident</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="addResident">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                <input type="text" id="surname" wire:model.defer="surname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"  required/>
                @error('surname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" id="first_name" wire:model.defer="first_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" id="middle_name" wire:model.defer="middle_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                @error('middle_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" id="phone_number" wire:model.defer="phone_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" id="date_of_birth" wire:model.defer="date_of_birth" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                <input type="number" id="age" wire:model.defer="age" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required />
                @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="gender" wire:model.defer="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth</label>
                <input type="text" id="place_of_birth" wire:model.defer="place_of_birth" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                @error('place_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="relationship_with_family_head" class="block text-sm font-medium text-gray-700">Relationship with Family Head</label>
                <input type="text" id="relationship_with_family_head" wire:model.defer="relationship_with_family_head" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                @error('relationship_with_family_head') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status</label>
                <select id="civil_status" wire:model.defer="civil_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    <option value="">Select Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                </select>
                @error('civil_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
                <input type="text" id="occupation" wire:model.defer="occupation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                @error('occupation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="religion" class="block text-sm font-medium text-gray-700">Religion</label>
                <input type="text" id="religion" wire:model.defer="religion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus focus sm"  required/> @error('religion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror </div>
                <div>
                    <label for="citizenship" class="block text-sm font-medium text-gray-700">Citizenship</label>
                    <input type="text" id="citizenship" wire:model.defer="citizenship" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"  required/>
                    @error('citizenship') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="family_number" class="block text-sm font-medium text-gray-700">Family Number</label>
                    <input type="number" id="family_number" wire:model.defer="family_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                    @error('family_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="zone_or_purok" class="block text-sm font-medium text-gray-700">Zone or Purok</label>
                    <input type="text" id="zone_or_purok" wire:model.defer="zone_or_purok" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required/>
                    @error('zone_or_purok') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6">
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ $editMode ? 'Update Resident' : 'Add Resident' }}
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-8">
            <div class="flex items-center mb-4">
                <input type="text" wire:model.debounce.300ms="search" placeholder="Search Resident..." class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">

                <button class="bg-green-500 hover:bg-green-800 rounded-lg ml-2 text-white p-2" wire:click="sarch">Search</button>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Surname</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Middle Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($residents as $resident)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $resident->surname }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $resident->first_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $resident->middle_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $resident->date_of_birth->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <button wire:click="edit({{ $resident->id }})" class="text-indigo-600 hover:text-indigo-900">View</button>
                                <button wire:click="delete({{ $resident->id }})" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $residents->links() }}
            </div>
        </div>
    </div>
