<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BookingCreatedNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use AuthorizesRequests;

    /**
     * Show all bookings (web + API).
     */
    public function index(Request $request)
    {
        $bookings = $request->user()->bookings()->latest()->get();

        if ($request->wantsJson()) {
            return response()->json($bookings);
        }

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show booking creation form (web).
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a new booking (web + API).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $booking = $request->user()->bookings()->create($data);

        // Try sending notification to user (email or database)
        try {
            $request->user()->notify(new BookingCreatedNotification($booking));
        } catch (\Exception $e) {
            \Log::error('Notification failed: ' . $e->getMessage());
            // Optional: You can also flash a message to the session if needed
            // session()->flash('warning', 'Booking saved, but notification failed to send.');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Booking created successfully!',
                'booking' => $booking,
            ], 201);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    /**
     * Show form for editing (web).
     */
    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update a booking (web + API).
     */
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $booking->update($data);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Booking updated successfully!',
                'booking' => $booking,
            ]);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    /**
     * Delete a booking (web + API).
     */
    public function destroy(Request $request, Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Booking deleted successfully.']);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }

    /**
     * Show one booking (API only).
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return response()->json($booking);
    }
}
