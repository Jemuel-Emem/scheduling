<div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Birth Registry Record Form</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name_of_child" class="block text-sm font-medium text-gray-700">Name of Child</label>
                <input type="text" id="name_of_child" wire:model.defer="name_of_child" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('name_of_child') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="name_of_parent" class="block text-sm font-medium text-gray-700">Name of Parent</label>
                <input type="text" id="name_of_parent" wire:model.defer="name_of_parent" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('name_of_parent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" id="date_of_birth" wire:model.defer="date_of_birth" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="family_no" class="block text-sm font-medium text-gray-700">Family No.</label>
                <input type="text" id="family_no" wire:model.defer="family_no" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('family_no') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="zone" class="block text-sm font-medium text-gray-700">Zone</label>
                <input type="text" id="zone" wire:model.defer="zone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('zone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="gender" wire:model.defer="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="birth_weight" class="block text-sm font-medium text-gray-700">Birth Weight (kg)</label>
                <input type="number" id="birth_weight" wire:model.defer="birth_weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('birth_weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth</label>
                <input type="text" id="place_of_birth" wire:model.defer="place_of_birth" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('place_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="is_registered" class="block text-sm font-medium text-gray-700">Registered</label>
                <select id="is_registered" wire:model.defer="is_registered" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Select Status</option>
                    <option value="1">Registered</option>
                    <option value="0">Not Registered</option>
                </select>
                @error('is_registered') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-4 flex items-center justify-between">
            <button type="submit" class="w-64 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                {{ $editMode ? 'Update' : 'Save' }}
            </button>
        </div>
    </form>

    <div class="mt-6">
        <h3 class="text-lg font-semibold mb-4">Birth Registry Records</h3>
        <div class="flex items-center mb-4">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search by Name " class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">

            <button class="bg-green-500 hover:bg-green-800 rounded-lg ml-2 text-white p-2" wire:click="sarch">Search</button>
        </div>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50 ">
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
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $record->name_of_child }}</td>
                        <td class="py-2 px-4 border-b">{{ $record->name_of_parent }}</td>
                        <td class="py-2 px-4 border-b">{{ $record->date_of_birth }}</td>
                        <td class="py-2 px-4 border-b">{{ $record->family_no }}</td>
                        <td class="py-2 px-4 border-b">
                            <button wire:click="edit({{ $record->id }})" class="text-blue-500 hover:text-blue-700">Edit</button>
                            <button wire:click="delete({{ $record->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $birthregistries->links() }}
    </div>
</div>
