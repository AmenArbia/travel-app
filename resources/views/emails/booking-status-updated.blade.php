<div>
    <title>Booking Status Updated</title>


    <h1>Hello {{ $booking->name }},</h1>

    <p>Your booking status has been updated.</p>

    <p>
        <strong>Booking Details:</strong><br>
        Hotel: {{ $booking->hotel->name ?? 'N/A' }}<br>
        Room Type: {{ $booking->roomtype->name ?? 'N/A' }}<br>
        Check-in Date: {{ $booking->check_in_date }}<br>
        Check-out Date: {{ $booking->check_out_date }}<br>
        Total Price: {{ $booking->total_price }} TND<br>
        New Status: {{ ucfirst($booking->booking_status) }}
    </p>

    <p>Please check your booking list to view your updated booking details.</p>

    <p>Thank you for using our service!</p>

</div>
