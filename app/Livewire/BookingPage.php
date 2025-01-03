<?php

namespace App\Livewire;

use App\Models\Amenities;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\TypeRoom;
use Livewire\Component;

class BookingPage extends Component
{
    public $name;
    public $email;
    public $phone;
    public $check_in_date;
    public $check_out_date;
    public $hotel_id;
    public $roomtype_id;
    public $price_per_night = 0;
    public $total_price = 0;

    public $hotels = [];
    public $roomTypes = [];
    public $hotelAmenities = [];
    public $selectedAmenities = [];
    public $amenityTotalPrice = 0;

    public $adults;
    public $children;
    public $infants;
    public $capacity;
    public $roomType;

    public function mount()
    {
        $this->hotels = Hotel::all();
        $this->check_in_date = date('Y-m-d');
        $this->check_out_date = date('Y-m-d', strtotime('+1 day'));
        $this->selectedAmenities = [];
    }

    public function loadRooms()
    {
        if ($this->hotel_id) {
            $this->roomTypes = TypeRoom::where('hotel_id', $this->hotel_id)->get();
        } else {
            $this->roomTypes = [];
        }
        $this->roomtype_id = null;
        $this->price_per_night = 0;
    }

    public function loadHotelDetails()
    {
        if ($this->hotel_id) {

            $hotel = Hotel::with([
                'amenities' => function ($query) {
                    $query->withPivot('is_free', 'price');
                }
            ])->find($this->hotel_id);

            // If a hotel is found, load its amenities
            $this->hotelAmenities = $hotel ? $hotel->amenities : [];
        } else {
            $this->hotelAmenities = [];
        }

        // Recalculate the total price with selected amenities
        $this->calculateTotalPrice();
    }
    public function loadRoomPrice()
    {
        if ($this->roomtype_id) {
            $this->roomType = TypeRoom::find($this->roomtype_id);
            if ($this->roomType) {
                $this->price_per_night = $this->roomType->price;
                $this->capacity = $this->roomType->capacity;
            } else {
                $this->price_per_night = 0;
                $this->capacity = null;
            }

            $this->calculateTotalPrice();
        }
    }

    public function calculateTotalPrice()
    {
        // Reset total price before recalculating
        $this->total_price = 0;
        $this->amenityTotalPrice = 0;

        // Calculate room price
        if ($this->check_in_date && $this->check_out_date && $this->price_per_night) {
            $checkInDate = new \DateTime($this->check_in_date);
            $checkOutDate = new \DateTime($this->check_out_date);
            $interval = $checkInDate->diff($checkOutDate);
            $nights = $interval->days;

            $this->total_price = $nights * $this->price_per_night + $this->amenityTotalPrice;
        }

        // Calculate amenities price
        foreach ($this->selectedAmenities as $amenityId) {
            $amenity = Amenities::find($amenityId);
            if ($amenity) {
                $this->amenityTotalPrice += $amenity->price;
            }
        }

        $this->total_price += $this->amenityTotalPrice;
    }

    public function updatedHotelId()
    {
        $this->loadRooms();
        $this->loadHotelDetails();
    }

    public function increment($type)
    {
        if ($type === 'capacity') {
            $this->capacity++;
        } elseif ($type === 'adults') {
            $this->adults++;
        } elseif ($type === 'children') {
            $this->children++;
        } elseif ($type === 'infants') {
            $this->infants++;
        }
    }

    public function decrement($type)
    {
        if ($type === 'capacity' && $this->capacity > 1) {
            $this->capacity--;
        } elseif ($type === 'adults' && $this->adults > 1) {
            $this->adults--;
        } elseif ($type === 'children' && $this->children > 0) {
            $this->children--;
        } elseif ($type === 'infants' && $this->infants > 0) {
            $this->infants--;
        }
    }
    public function submitBooking()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'hotel_id' => 'required|exists:hotels,id',
            'roomtype_id' => 'required|exists:type_rooms,id',
            'price_per_night' => 'required|numeric|min:0',
            'adults' => 'required|numeric|min:1',
            'children' => 'nullable|numeric|min:0',
            'infants' => 'nullable|numeric|min:0',
            'capacity' => 'required|numeric|min:1',
            'selectedAmenities' => 'array',
        ]);

        $booking = Booking::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
            'hotel_id' => $this->hotel_id,
            'roomtype_id' => $this->roomtype_id,
            'price_per_night' => $this->price_per_night,
            'total_price' => $this->total_price,
            'adults' => $this->adults,
            'children' => $this->children ?? 0,
            'infants' => $this->infants ?? 0,
            'capacity' => $this->capacity,
        ]);



        return redirect()->route('booking.details.');
    }

    public function render()
    {
        return view('livewire.booking-page', [
            'hotels' => $this->hotels,
            'roomTypes' => $this->roomTypes,
        ]);
    }
}