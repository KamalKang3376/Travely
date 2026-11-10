<x-mail::message>
# Your Booking Status Has Been Updated

Hello {{ $booking->customer_name }},

There is an update regarding your Travely package booking.

<x-mail::panel>
**Booking Reference:** {{ $booking->booking_reference }}

**Package:** {{ $booking->package_name }}

**Destination:** {{ $booking->destination }}

**Travel Date:** {{ $booking->travel_date->format('d M, Y') }}

**Travellers:** {{ $booking->travellers }}

**Total Amount:** ₹{{ number_format($booking->total_amount, 2) }}

**Current Status:** {{ ucfirst($booking->status) }}
</x-mail::panel>

@if($booking->status === 'confirmed')
Great news! Your package booking has been confirmed. We look forward to helping you enjoy your trip!
@elseif($booking->status === 'cancelled')
Your package booking has been cancelled. If you have questions, please contact our support team.
@else
Your booking status is now pending.
@endif

Thanks,

**Travely Team**
Your Journey, Our Passion.
</x-mail::message>