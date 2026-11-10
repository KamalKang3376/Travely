
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Travely Booking Confirmation</title>
</head>
<body style="margin:0;padding:30px;background:#f5f6f5;font-family:Arial,sans-serif;color:#333;">

    <div style="max-width:600px;margin:auto;background:#fff;padding:30px;border-radius:12px;">

        <h1 style="color:#12332e;text-align:center;">Travely</h1>

        <h2 style="color:#12332e;">Booking Request Received!</h2>

        <p>Hello {{ $booking->customer_name }},</p>

        <p>Thank you for choosing Travely. We have received your hotel booking request.</p>

        <div style="background:#f8f7f3;padding:20px;border-radius:8px;">
            <h3>Booking Details</h3>

            <p><strong>Reference:</strong> {{ $booking->booking_reference }}</p>
            <p><strong>Hotel:</strong> {{ $booking->hotel->name }}</p>
            <p><strong>Check-in:</strong> {{ $booking->check_in->format('d M Y') }}</p>
            <p><strong>Check-out:</strong> {{ $booking->check_out->format('d M Y') }}</p>
            <p><strong>Guests:</strong> {{ $booking->guests }}</p>
            <p><strong>Rooms:</strong> {{ $booking->rooms }}</p>
            <p><strong>Total:</strong> ₹{{ number_format((float) $booking->total_price, 2) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
        </div>

        <p>Your booking is currently pending. The hotel reservation is not confirmed until its status is updated.</p>

        <p>Thank you,<br><strong>Team Travely</strong></p>

    </div>

</body>
</html>
