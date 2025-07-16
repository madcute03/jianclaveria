<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\NotificationController;
use App\Models\Booking;
use App\Models\User;

Route::get('/', function () {
    return redirect('/login');
});

// ✅ Dashboard route
Route::get('/dashboard', function () {
    $totalBookings = Booking::where('user_id', auth()->id())->count();
    $totalUsers = User::count(); // Added: count all registered users
    return view('dashboard', compact('totalBookings', 'totalUsers'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/delete/{id}', [NotificationController::class, 'delete'])->name('notifications.delete');
    Route::post('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');
});

// Authentication routes (login, register, forgot password, etc.)
require __DIR__.'/auth.php';
