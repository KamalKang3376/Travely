<?php

namespace App\Mail;

use App\Models\PackageBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PackageBookingStatusUpdate extends Mailable
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
            subject: 'Your Travely Booking Status Update'
        );
    }

    public function content(): \Illuminate\Mail\Mailables\Content
    {
        return new \Illuminate\Mail\Mailables\Content(
            markdown: 'emails.package-booking-status-update'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}