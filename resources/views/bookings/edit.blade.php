<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            ✨ Edit Booking
        </h2>
    </x-slot>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @push('styles')
    <style>
    .form-container {
        background: rgba(15, 23, 42, 0.85);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 0 25px rgba(0, 123, 255, 0.3);
        max-width: 700px;
        margin: 2rem auto;
        color: #e0f2fe;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #93c5fd;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #3b82f6;
        background-color: #0f172a;
        color: #e0f2fe;
        box-shadow: 0 0 6px rgba(59, 130, 246, 0.3);
        margin-bottom: 1.5rem;
        box-sizing: border-box;
    }

    input:focus,
    textarea:focus {
        outline: none;
        box-shadow: 0 0 12px rgba(59, 130, 246, 0.7);
        border-color: #60a5fa;
    }

    .calendar-wrapper {
        width: 100%;
        margin-bottom: 1.5rem;
    }

    #calendarBox {
        width: 100%;
        background-color: #1e293b;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
        border: 1px solid #3b82f6;
        box-sizing: border-box;
    }

    .submit-button {
        background: linear-gradient(to right, #0ea5e9, #6366f1);
        color: white;
        padding: 12px 28px;
        border: none;
        border-radius: 40px;
        font-weight: 600;
        box-shadow: 0 0 14px rgba(14, 165, 233, 0.6);
        cursor: pointer;
        transition: 0.3s ease;
    }

    .submit-button:hover {
        transform: scale(1.05);
        box-shadow: 0 0 24px rgba(99, 102, 241, 0.8);
    }

    .back-link {
        font-size: 0.9rem;
        color: #93c5fd;
        text-decoration: underline;
        transition: 0.3s;
    }

    .back-link:hover {
        color: #e0f2fe;
    }

    /* ✅ Flatpickr custom glowing theme */
    .flatpickr-calendar {
        background-color: #1e293b !important;
        color: #e0f2fe !important;
        border: 1px solid #3b82f6;
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }

    .flatpickr-months,
    .flatpickr-weekdays,
    .flatpickr-month,
    .flatpickr-current-month,
    .flatpickr-weekday,
    .flatpickr-time,
    .flatpickr-time input {
        color: #e0f2fe !important;
        font-weight: 500;
        text-shadow: 0 0 5px rgba(147, 197, 253, 0.8);
    }

    .flatpickr-day {
        color: #e0f2fe !important;
        text-shadow: 0 0 6px rgba(224, 242, 254, 0.8);
    }

    .flatpickr-day.today {
        background: #2563eb !important;
        color: #fff !important;
        box-shadow: 0 0 8px rgba(37, 99, 235, 0.8);
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
        background: linear-gradient(to right, #0ea5e9, #6366f1) !important;
        color: white !important;
        font-weight: bold;
        box-shadow: 0 0 12px rgba(99, 102, 241, 0.9);
    }

    .flatpickr-day:hover {
        background-color: rgba(59, 130, 246, 0.5) !important;
        color: white !important;
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.7);
    }
    /* Date and Time Inputs (glow effect) */
input[type="date"],
input[type="time"],
.flatpickr-input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #3b82f6;
    background-color: #0f172a;
    color: #e0f2fe;
    font-size: 14px;
    box-shadow: 0 0 6px rgba(59, 130, 246, 0.3);
    margin-bottom: 1.5rem;
    box-sizing: border-box;
    transition: 0.3s ease;
}

/* On focus: stronger glow */
input[type="date"]:focus,
input[type="time"]:focus,
.flatpickr-input:focus {
    outline: none;
    border-color: #60a5fa;
    box-shadow: 0 0 12px rgba(59, 130, 246, 0.7);
}

/* Placeholder glow text color */
input::placeholder {
    color: #93c5fd;
    text-shadow: 0 0 3px rgba(147, 197, 253, 0.6);
</style>


    <div class="form-container">
        @if ($errors->any())
            <div class="bg-red-600 text-white p-4 mb-4 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $booking->title) }}" required>
            </div>

            <div>
                <label for="calendarBox">Booking Date & Time</label>
                <div class="calendar-wrapper">
                    <div id="calendarBox"></div>
                </div>
                <input type="hidden" name="booking_date" id="booking_date"
                       value="{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d H:i')) }}">
            </div>

            <div>
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" rows="4">{{ old('notes', $booking->notes) }}</textarea>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('bookings.index') }}" class="back-link">← Back to list</a>
                <button type="submit" class="submit-button">Update Booking</button>
            </div>
        </form>
    </div>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#calendarBox", {
            inline: true,
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            defaultDate: "{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d H:i')) }}",
            time_24hr: false,
            minuteIncrement: 1,
            onChange: function(selectedDates, dateStr, instance) {
                document.getElementById("booking_date").value = dateStr;
            }
        });
    </script>
</x-app-layout>
