<div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Book an Appointment</h2>


        <form class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-4">

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                <input id="name" type="text" placeholder="Enter your full name"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>


            <div>
                <label for="age" class="block text-sm font-semibold text-gray-700">Age</label>
                <input id="age" type="number" placeholder="Enter your age" min="1"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>


            <div>
                <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                <input id="address" type="text" placeholder="Enter your address"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>


            <div>
                <label for="purpose" class="block text-sm font-semibold text-gray-700">Purpose of Appointment</label>
                <textarea id="purpose" rows="3" placeholder="Enter purpose of appointment"
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm"></textarea>
            </div>

            <!-- Date Schedule Field -->
            <div>
                <label for="date" class="block text-sm font-semibold text-gray-700">Date Schedule</label>
                <input id="date" type="date"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>

            <!-- Time Field -->
            <div>
                <label for="time" class="block text-sm font-semibold text-gray-700">Time</label>
                <input id="time" type="time"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>

            <!-- Health Condition Field -->
            <div>
                <label for="health-condition" class="block text-sm font-semibold text-gray-700">Health Condition</label>
                <select id="health-condition" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    <option value="">Select your health condition</option>
                    <option value="highblood">Highblood</option>
                    <option value="pregnant">Pregnant</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Health Status Field -->
            <div>
                <label for="health-status" class="block text-sm font-semibold text-gray-700">Health Status</label>
                <select id="health-status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
                    <option value="">Select your health status</option>
                    <option value="healthy">Healthy</option>
                    <option value="under-treatment">Under Treatment</option>
                    <option value="chronic-condition">Chronic Condition</option>
                </select>
            </div>

            <!-- Blood Pressure Field -->
            <div>
                <label for="blood-pressure" class="block text-sm font-semibold text-gray-700">Blood Pressure</label>
                <input id="blood-pressure" type="text" placeholder="Enter your blood pressure"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm">
            </div>

            <!-- Submit Button -->
            <div class="col-span-2">
                <button type="submit"
                        class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-200">
                    Book Appointment
                </button>
            </div>
        </form>
    </div>
</div>
