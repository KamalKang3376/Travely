<x-mail::message>
# Thank You for Booking with Travely!

Hello {{ $booking->customer_name }},

Your package booking has been successfully submitted. We're excited to help you plan your journey!

<x-mail::panel>
**Booking Reference:** {{ $booking->booking_reference }}

**Package:** {{ $booking->package_name }}

**Destination:** {{ $booking->destination }}

**Travel Date:** {{ $booking->travel_date->format('d M, Y') }}

**Number of Travellers:** {{ $booking->travellers }}

**Price Per Person:** ₹{{ number_format($booking->price_per_person, 2) }}

**Total Amount:** ₹{{ number_format($booking->total_amount, 2) }}

**Booking Status:** {{ ucfirst($booking->status) }}
</x-mail::panel>

Our team will review your booking and update its status.

If you have any questions, please contact our support team.

Thanks,

**Travely Team**
Your Journey, Our Passion.
</x-mail::message>