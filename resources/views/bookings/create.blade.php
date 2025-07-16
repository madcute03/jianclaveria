<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
    body {
    background: linear-gradient(135deg, #0f172a, #1e3a8a, #9333ea);
    color: #e5e7eb;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.form-wrapper {
    max-width: 700px;
    margin: 3rem auto;
    background: rgba(255, 255, 255, 0.05);
    padding: 2rem;
    border-radius: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 30px rgba(147, 197, 253, 0.15);
}

.form-title {
    font-size: 2rem;
    font-weight: bold;
    color: #93c5fd;
    text-shadow: 0 0 12px rgba(147, 197, 253, 0.6);
    margin-bottom: 1.5rem;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: #dbeafe;
    font-weight: 600;
}

input[type="text"],
input[type="datetime-local"],
textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 0.5rem;
    color: #f9fafb;
    font-size: 1rem;
    transition: all 0.3s ease;
}

input:focus,
textarea:focus {
    outline: none;
    border-color: #60a5fa;
    box-shadow: 0 0 15px rgba(96, 165, 250, 0.6);
}

.submit-btn {
    background: linear-gradient(to right, red, orange, yellow, green, cyan, blue, violet);
    color: white;
    padding: 0.75rem 1.5rem;
    font-weight: bold;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    float: right;
    box-shadow: 0 0 20px rgba(255,255,255,0.3);
    transition: 0.3s ease;
}

.submit-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 0 25px rgba(255,255,255,0.6);
}

.flatpickr-calendar {
    background-color: #1e293b !important; /* Brighter dark blue */
    color: #f8fafc !important; /* Make all calendar text light */
    border-radius: 1rem;
    padding: 0.5rem;
    border: 2px solid;
    border-image: linear-gradient(to right, red, orange, yellow, green, cyan, blue, violet) 1;
    box-shadow: 0 0 20px rgba(255,255,255,0.1);
}

.flatpickr-months,
.flatpickr-weekdays,
.flatpickr-month,
.flatpickr-current-month,
.flatpickr-weekday {
    color: #f8fafc !important; /* Month name and weekdays */
    font-weight: 600;
}

.flatpickr-day {
    color: #f8fafc !important;
    font-weight: 500;
    border-radius: 6px;
}

.flatpickr-day:hover {
    background: rgba(59, 130, 246, 0.2) !important;
    color: white !important;
}

.flatpickr-day.selected,
.flatpickr-day.startRange,
.flatpickr-day.endRange {
    background: linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet) !important;
    color: white !important;
    font-weight: bold;
}

.flatpickr-time input,
.flatpickr-time {
    background-color: #0f172a;
    color: #f8fafc !important;
    border: none;
    border-radius: 6px;
}

.glow-box {
    background-color: #1f2937;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
}

.error-box {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid #ef4444;
    color: #f87171;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
}

</style>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-100 leading-tight">
            📅 Create Booking
        </h2>
    </x-slot>

    <div class="min-h-screen py-12 px-4">
        <div class="form-wrapper">
            <h1 class="form-title">📅 Create Booking</h1>

            @if ($errors->any())
                <div class="error-box">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title">Booking Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="e.g. Conference Room"
                    >
                </div>

                <!-- Booking Date & Time -->
                <div class="mb-6">
    <label for="booking_date">📅 Booking Date & Time</label>

    <!-- Hidden input to hold the value -->
    <input type="hidden" name="booking_date" id="booking_date">

    <!-- Calendar container (visible) -->
    <div id="calendarBox" class="rounded-2xl mt-4"></div>
</div>


                <!-- Notes -->
                <div class="mb-6">
                    <label for="notes">Notes (Optional)</label>
                    <textarea
                        name="notes"
                        id="notes"
                        rows="4"
                        placeholder="Add any extra notes..."
                    >{{ old('notes') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="submit-btn">➕ Submit Booking</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Popup Custom Datetime -->
    <div id="customDatetimeBox" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center hidden">
        <div class="bg-gray-900 text-white p-6 rounded-xl w-96 text-center relative glow-box">
            <button onclick="toggleCustomDatetime()" class="absolute top-2 right-3 text-white hover:text-red-400 text-xl font-bold">×</button>
            <h2 class="text-lg font-bold mb-4">Select Booking Date & Time</h2>
            <input
                type="datetime-local"
                id="customPicker"
                class="w-full p-2 rounded bg-gray-800 text-white border border-white focus:ring-2 focus:ring-blue-500"
            >
            <button onclick="applyCustomDatetime()" class="submit-btn mt-4 w-full">✅ Use This Date</button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    flatpickr("#calendarBox", {
        inline: true,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        defaultDate: new Date(),
        time_24hr: false, // Optional: set to true for 24hr format
        minuteIncrement: 1, // ✅ Allows minute-by-minute selection
        onChange: function(selectedDates, dateStr, instance) {
            document.getElementById("booking_date").value = dateStr;
        }
    });
</script>
</x-app-layout>
