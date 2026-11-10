
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Travely Booking Cancellation</title>
</head>
<body style="margin:0;padding:30px;background:#f5f6f5;font-family:Arial,sans-serif;color:#333;">

    <div style="max-width:600px;margin:auto;background:#fff;padding:30px;border-radius:12px;">

        <h1 style="color:#12332e;text-align:center;">Travely</h1>

        <h2 style="color:#b02a37;">Booking Cancelled</h2>

        <p>Hello {{ $booking->customer_name }},</p>

        <p>Your hotel booking has been cancelled successfully.</p>

        <div style="background:#f8f7f3;padding:20px;border-radius:8px;">
            <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
            <p><strong>Hotel:</strong> {{ $booking->hotel->name }}</p>
            <p><strong>Check-in:</strong> {{ $booking->check_in->format('d M Y') }}</p>
            <p><strong>Check-out:</strong> {{ $booking->check_out->format('d M Y') }}</p>
            <p><strong>Status:</strong> Cancelled</p>
        </div>

        <p>If you have questions about this booking, please contact our support team.</p>

        <p>Regards,<br><strong>Team Travely</strong></p>

    </div>

</body>
</html>
