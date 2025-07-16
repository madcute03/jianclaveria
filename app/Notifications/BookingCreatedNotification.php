<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingCreatedNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database']; // Only save to DB, no mail
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'title' => $this->booking->title,
            'booking_date' => $this->booking->booking_date->toDateTimeString(),
            'notes' => $this->booking->notes ?? 'None',
        ];
    }
}
