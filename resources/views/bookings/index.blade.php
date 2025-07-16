<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">🌟 My Glowing Bookings</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-8 px-4">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($bookings->isEmpty())
            <div class="no-bookings">
                <p>You have no bookings yet. Click below to get started!</p>
            </div>
        @else
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y g:i A') }}</td>
                                <td>{{ $booking->notes ?? '-' }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('bookings.edit', $booking) }}" class="edit-btn">Edit</a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="new-booking">
            <a href="{{ route('bookings.create') }}">+ New Booking</a>
        </div>
    </div>

    {{-- Styles for glowing theme --}}
    <style>
        .page-header {
            font-size: 2rem;
            font-weight: 700;
            color: #cce4ff;
            text-shadow: 0 0 10px rgba(0, 123, 255, 0.7);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .alert-success {
            background: linear-gradient(to right, #00bfff, #1e40af);
            color: white;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 0 15px rgba(0, 191, 255, 0.6);
            font-weight: bold;
            text-align: center;
        }

        .no-bookings {
            background: #1e2a3a;
            border: 1px solid #3b82f6;
            padding: 2rem;
            border-radius: 1rem;
            text-align: center;
            color: #99ccee;
            font-size: 1.1rem;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.4);
        }

        .table-container {
            overflow-x: auto;
            background-color: #0d1117;
            border-radius: 1rem;
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.3);
            border: 2px solid transparent;
            border-image: linear-gradient(to right, #0ea5e9, #6366f1) 1;
            padding: 1rem;
            margin-top: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #e0e0e0;
            font-size: 0.95rem;
        }

        thead {
            background: linear-gradient(to right, #3b82f6, #9333ea);
            color: white;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        th, td {
            padding: 1rem;
            border-top: 1px solid #334155;
            text-align: left;
        }

        tr:hover {
            background-color: #1c2431;
            box-shadow: 0 0 10px rgba(0, 191, 255, 0.2);
        }

        .action-buttons a,
        .action-buttons button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
            margin-right: 0.5rem;
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
        }

        .edit-btn {
            background: linear-gradient(to right, #facc15, #f97316);
            color: black;
            box-shadow: 0 0 10px rgba(250, 204, 21, 0.5);
        }

        .edit-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(250, 204, 21, 0.8);
        }

        .delete-btn {
            background: linear-gradient(to right, #dc2626, #ef4444);
            box-shadow: 0 0 10px rgba(220, 38, 38, 0.5);
        }

        .delete-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(220, 38, 38, 0.8);
        }

        .new-booking {
            margin-top: 2.5rem;
            text-align: center;
        }

        .new-booking a {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            color: white;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 0.75rem;
            text-decoration: none;
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .new-booking a:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(139, 92, 246, 0.6);
        }
    </style>
</x-app-layout>
