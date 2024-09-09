<div class="min-h-screen bg-gray-100 flex items-center justify-center p-2">
    <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ $medicineToEdit ? 'Edit Medicine' : 'Add New Medicine' }}</h2>

        <!-- Show success message after action -->
        @if (session()->has('message'))
            <div class="mb-6 text-center text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <!-- Form starts here -->
        <form wire:submit.prevent="addOrUpdateMedicine" class="grid grid-cols-2 gap-6">

            <div>
                <label for="medicine_id" class="block text-sm font-semibold text-gray-700">Medicine ID</label>
                <input wire:model="medicine_id" id="medicine_id" type="text" placeholder="Enter medicine ID"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('medicine_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Medicine Name</label>
                <input wire:model="name" id="name" type="text" placeholder="Enter medicine name"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="type" class="block text-sm font-semibold text-gray-700">Type</label>
                <input wire:model="type" id="type" type="text" placeholder="Enter medicine type"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="stocks" class="block text-sm font-semibold text-gray-700">Stocks</label>
                <input wire:model="stocks" id="stocks" type="number" min="0" placeholder="Enter number of stocks"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('stocks') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-2">
                <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                <textarea wire:model="description" id="description" rows="3" placeholder="Enter medicine description"
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-2">
                <button type="submit"
                        class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-200">
                    {{ $medicineToEdit ? 'Update Medicine' : 'Add Medicine' }}
                </button>
            </div>
        </form>

        <h2 class="text-xl font-bold text-gray-800 mt-10 mb-4">Medicine List</h2>

        <!-- Responsive table container -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-4 text-left">Medicine ID</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Type</th>
                        <th class="py-3 px-4 text-left">Stocks</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($medicines as $medicine)
                        <tr class="hover:bg-gray-50 transition ease-in-out duration-150">
                            <td class="py-3 px-4 border-b">{{ $medicine->medicine_id }}</td>
                            <td class="py-3 px-4 border-b">{{ $medicine->name }}</td>
                            <td class="py-3 px-4 border-b">{{ $medicine->type }}</td>
                            <td class="py-3 px-4 border-b">{{ $medicine->stocks }}</td>
                            <td class="py-3 px-4 border-b text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button wire:click="editMedicine({{ $medicine->id }})"
                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-150">
                                        Edit
                                    </button>
                                    <button wire:click="deleteMedicine({{ $medicine->id }})"
                                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-150">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination links -->
        <div class="mt-4">
            {{ $medicines->links() }}
        </div>
    </div>
</div>
