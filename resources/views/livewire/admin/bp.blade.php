<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">BP Monitoring Form</h2>

    <!-- Show success message -->
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-2 gap-4">
            <!-- Resident Name -->
            <div>
                <label for="resident_name" class="block text-gray-700 font-medium mb-2">Resident Name</label>
                <input type="text" wire:model="resident_name" id="resident_name" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter resident name">
                @error('resident_name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Age -->
            <div>
                <label for="age" class="block text-gray-700 font-medium mb-2">Age</label>
                <input type="number" wire:model="age" id="age" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter age">
                @error('age') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- BP -->
            <div>
                <label for="bp" class="block text-gray-700 font-medium mb-2">Blood Pressure (BP)</label>
                <input type="text" wire:model="bp" id="bp" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="e.g. 120/80 mmHg">
                @error('bp') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- BP Level -->
            <div>
                <label for="level" class="block text-gray-700 font-medium mb-2">BP Level</label>
                <select wire:model="level" id="level" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="normal">Normal</option>
                    <option value="elevated">Elevated</option>
                    <option value="high">High</option>
                    <option value="low">Low</option>
                </select>
                @error('level') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-gray-700 font-medium mb-2">Date</label>
                <input type="date" wire:model="date" id="date" class="w-full p-2 border border-gray-300 rounded-lg">
                @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="text-end mt-6">
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600">
                {{ $bp_id ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>

    <hr class="my-6">

    <!-- BP Monitoring Records Table -->
    <h2 class="text-xl font-bold mb-4 text-center text-gray-800">BP Monitoring Records</h2>

    <table class="table-auto w-full bg-white rounded-lg shadow-md">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Resident Name</th>
                <th class="py-3 px-6 text-left">Age</th>
                <th class="py-3 px-6 text-left">BP</th>
                <th class="py-3 px-6 text-left">Level</th>
                <th class="py-3 px-6 text-left">Date</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($bp_monitorings as $bp_monitoring)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $bp_monitoring->resident_name }}</td>
                    <td class="py-3 px-6 text-left">{{ $bp_monitoring->age }}</td>
                    <td class="py-3 px-6 text-left">{{ $bp_monitoring->bp }}</td>
                    <td class="py-3 px-6 text-left">{{ ucfirst($bp_monitoring->level) }}</td>
                    <td class="py-3 px-6 text-left">{{ $bp_monitoring->date }}</td>
                    <td class="py-3 px-6 text-center">
                        <button wire:click="edit({{ $bp_monitoring->id }})" class="px-4 py-2 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600">Edit</button>
                        <button wire:click="delete({{ $bp_monitoring->id }})" class="px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
