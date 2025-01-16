<?php

namespace App\Livewire;

use App\Mail\BookingStatusUpdated;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;


class BookingDetailsPage extends Component
{
    use WithPagination;

    public function render()
    {

        $bookingquery = Booking::with('hotel', 'room', 'roomtype', 'amenities', 'country', 'city');

        $bookingCount = $bookingquery->count();
        return view('livewire.booking-details-page', [
            'bookings' => $bookingquery->paginate(5),
            'bookingCount' => $bookingCount,
        ]);
    }
}