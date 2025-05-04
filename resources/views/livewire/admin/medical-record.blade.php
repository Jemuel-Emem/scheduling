<div>
    @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded">{{ session('success') }}</div>
@endif


    <div class="mb-3">
        <label>Select Category</label>
        <select wire:model="selectedCategory" class="border rounded px-2 py-1">
            <option value="">-- Select Category --</option>
            <option value="residents">Residents</option>
            <option value="o71months">0–71 Months</option>
            <option value="pregnancy">Pregnancy</option>
            <option value="birthregistry">Birth Registry</option>
            <option value="bpmonitoring">BP Monitoring</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Enter Name</label>
        <input type="text" wire:model="searchName" class="border rounded px-2 py-1">
        <button wire:click="fetchByName" class="bg-blue-500 text-white px-2 py-1 rounded">Fetch</button>
    </div>

    @if($full_name)
        <div class="mb-3">
            <p><strong>Name:</strong> {{ $full_name }}</p>
            <p><strong>Age:</strong> {{ $age }}</p>
            <p><strong>Gender:</strong> {{ $gender }}</p>
        </div>

        <div>
            <label>Diagnosis</label>
            <input type="text" wire:model="diagnosis" class="w-full border rounded mb-2">
            <label>Symptoms</label>
            <input type="text" wire:model="symptoms" class="w-full border rounded mb-2">
            <label>Prescriptions</label>
            <input type="text" wire:model="prescriptions" class="w-full border rounded mb-2">

            <button wire:click="save" class="bg-green-500 text-white px-4 py-2 rounded">Save Record</button>
        </div>
    @endif

    <div>
        @if($records && count($records) > 0)
        <table class="w-full border mt-6 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-1">Name</th>
                    <th class="border p-1">Category</th>
                    <th class="border p-1">Age</th>
                    <th class="border p-1">Gender</th>
                    <th class="border p-1">Diagnosis</th>
                    <th class="border p-1">Symptoms</th>
                    <th class="border p-1">Prescriptions</th>
                    <th class="border p-1">Date</th>

                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td class="border p-1 text-center">{{ $record->full_name }}</td>
                        <td class="border p-1 text-center">{{ ucfirst($record->category) }}</td>
                        <td class="border p-1 text-center">{{ $record->age }}</td>
                        <td class="border p-1 text-center">{{ $record->gender }}</td>
                        <td class="border p-1 text-center">{{ $record->diagnosis }}</td>
                        <td class="border p-1 text-center">{{ $record->symptoms }}</td>
                        <td class="border p-1 text-center">{{ $record->prescriptions }}</td>
                        <td class="border p-1 text-center">{{ $record->created_at->format('M d, Y') }}</td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600 mt-4">No medical records found.</p>
    @endif


    </div>



</div>
