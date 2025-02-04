<?php

namespace App\Livewire;

use App\Mail\BookingStatusUpdated;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Booking details page - Travel-Shaper')]

class BookingDetailsPage extends Component
{
    use WithPagination;


    public function render()
    {

        $bookingquery = Booking::with('hotel', 'room', 'roomtype', 'roomtype.room', 'amenities', 'country', 'city')->orderBy('created_at', 'desc');

        $bookingCount = $bookingquery->count();
        return view('livewire.booking-details-page', [
            'bookings' => $bookingquery->paginate(5),
            'bookingCount' => $bookingCount,
        ]);
    }
}
