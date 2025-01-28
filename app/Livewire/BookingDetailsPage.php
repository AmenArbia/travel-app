<?php

namespace App\Livewire;

<<<<<<< HEAD
use App\Mail\BookingStatusUpdated;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Booking details page - Travel-Shaper')]
=======
use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;

>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df

class BookingDetailsPage extends Component
{
    use WithPagination;
<<<<<<< HEAD
=======
    public $booking;
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df


    public function render()
    {

<<<<<<< HEAD
        $bookingquery = Booking::with('hotel', 'room', 'roomtype', 'roomtype.room', 'amenities', 'country', 'city');

        $bookingCount = $bookingquery->count();
        return view('livewire.booking-details-page', [
            'bookings' => $bookingquery->paginate(5),
            'bookingCount' => $bookingCount,
        ]);
    }
}
=======
        $bookingquery = Booking::with('hotel', 'room', 'roomtype', 'amenities', 'country', 'city');

        $bookingCount = $bookingquery->count();
        return view('livewire.booking-details-page', [
            'bookings' => $bookingquery->paginate(3),
            'bookingCount' => $bookingCount,
        ]);
    }
}
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
