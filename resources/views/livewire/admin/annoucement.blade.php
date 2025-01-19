<div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Manage Announcements</h2>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">{{ session('message') }}</strong>
            </div>
        @endif

        <!-- Add Announcement Form -->
        <form wire:submit.prevent="submitAnnouncement" class="grid grid-cols-1 gap-6 mb-8">
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700">Title</label>
                <input id="title" type="text" wire:model="title" placeholder="Enter announcement title"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="details" class="block text-sm font-semibold text-gray-700">Details</label>
                <textarea id="details" wire:model="details" rows="4" placeholder="Enter announcement details"
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm"></textarea>
                @error('details') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-semibold text-gray-700">Date</label>
                <input id="date" type="date" wire:model="date"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="time" class="block text-sm font-semibold text-gray-700">Time</label>
                <input id="time" type="time" wire:model="time"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit"
                        class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-200">
                    Add Announcement
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Title</th>
                        <th class="border border-gray-300 px-4 py-2">Details</th>
                        <th class="border border-gray-300 px-4 py-2">Date</th>
                        <th class="border border-gray-300 px-4 py-2">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($announcements as $announcement)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $announcement->title }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $announcement->details }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $announcement->date }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $announcement->time }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-4">No announcements found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
