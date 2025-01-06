<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;


class BookingDetailsPage extends Component
{
    use WithPagination;
    public $booking;


    public function render()
    {

        $bookingquery = Booking::with('hotel', 'room', 'roomtype', 'amenities', 'country', 'city');

        $bookingCount = $bookingquery->count();
        return view('livewire.booking-details-page', [
            'bookings' => $bookingquery->paginate(3),
            'bookingCount' => $bookingCount,
        ]);
    }
}