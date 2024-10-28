<div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">{{ $editMode ? 'Edit O71 Month' : 'Add O71 Month' }}</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $editMode ? 'updateO71month' : 'addO71month' }}">
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
                <label for="age_in_month" class="block text-sm font-medium text-gray-700">Age in Months</label>
                <input type="number" id="age_in_month" wire:model.defer="age_in_month" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('age_in_month') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
                <input type="number" step="0.01" id="weight" wire:model.defer="weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="height" class="block text-sm font-medium text-gray-700">Height</label>
                <input type="number" step="0.01" id="height" wire:model.defer="height" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('height') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="family_no" class="block text-sm font-medium text-gray-700">Family No</label>
                <input type="number" id="family_no" wire:model.defer="family_no" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('family_no') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="zone" class="block text-sm font-medium text-gray-700">Zone</label>
                <input type="text" id="zone" wire:model.defer="zone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('zone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ $editMode ? 'Update' : 'Add' }} O71 Month
            </button>
        </div>
    </form>

    <div class="mt-6">
      <div class="flex ">
        <input type="text" wire:model="search" placeholder="Search..." class="mb-4 p-2 border rounded-md shadow-sm w-full" />
        <button class="bg-green-500 hover:bg-green-800 rounded-lg ml-2 text-white p-2 h-10" wire:click="sarch">Search</button>
      </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name of Child</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name of Parent</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age in Months</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Height</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Family No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zone</th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $o71month->weight }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $o71month->height }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $o71month->family_no }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $o71month->zone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="edit({{ $o71month->id }})" class="text-blue-600 hover:text-blue-900">View</button>
                            <button wire:click="delete({{ $o71month->id }})" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $o71months->links() }}
        </div>
    </div>
</div>
