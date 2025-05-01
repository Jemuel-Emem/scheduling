<div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Rescheduled Appointments</h2>



    <table class="min-w-full bg-white table-auto border-separate border-spacing-0.5">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Original Schedule</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Rescheduled Date</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reschedules as $item)
                <tr class="hover:bg-gray-100 text-center">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->full_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $item->phone }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($item->date_schedule)->format('Y-m-d') }}
                        {{ \Carbon\Carbon::parse($item->time_schedule)->format('h:i A') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-blue-600 font-semibold">
                        {{ \Carbon\Carbon::parse($item->reschedule_date)->format('Y-m-d') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $item->purpose }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No rescheduled appointments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $reschedules->links() }}
    </div>
</div>
