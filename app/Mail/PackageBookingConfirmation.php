<?php

namespace App\Mail;

use App\Models\PackageBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PackageBookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public PackageBooking $booking;

    public function __construct(PackageBooking $booking)
    {
        $this->booking = $booking;
    }

    public function envelope(): \Illuminate\Mail\Mailables\Envelope
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'Your Travely Package Booking Confirmation'
        );
    }

    public function content(): \Illuminate\Mail\Mailables\Content
    {
        return new \Illuminate\Mail\Mailables\Content(
            markdown: 'emails.package-booking-confirmation'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}