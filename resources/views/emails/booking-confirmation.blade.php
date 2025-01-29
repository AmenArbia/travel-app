<div>
    <h1>Thank you for your booking!</h1>
    <p>Dear {{ $booking->name }},</p>
    <p>Your booking at {{ $booking->hotel->name }} hotel has been successfully received.</p>
    <p><strong>Booking Details:</strong></p>
    <ul>
        <li>Check-in Date: {{ $booking->check_in_date }}</li>
        <li>Check-out Date: {{ $booking->check_out_date }}</li>
        <li>Room : {{ $booking->roomtype->name }}</li>
        <li>Room type : {{ $booking->room->type }}</li>
        <li> Guests : <ul>
                <li>Adult : {{ $booking->adults }}</li>
                <li>Children : {{ $booking->children }}</li>
                <li>Infants : {{ $booking->infants }}</li>
            </ul>
        </li>
        <li>Total Price: ${{ $booking->total_price }}</li>
        </li>
    </ul>
    <p>We look forward to welcoming you!</p>
    <span>Just wait for your booking to be approved </span>
</div>
