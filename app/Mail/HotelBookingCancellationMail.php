<?php

namespace App\Mail;

use App\Models\HotelBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HotelBookingCancellationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public HotelBooking $booking)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Travely Booking Has Been Cancelled',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.hotel-booking-cancellation',
        );
    }
}
