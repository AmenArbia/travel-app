<?php

namespace App\Livewire;

<<<<<<< HEAD
use App\Mail\BookingConfirmationMail;
use App\Mail\BookingStatusUpdated;
use App\Models\Amenities;
use App\Models\Booking;
use App\Models\City;
use App\Models\Country;

use App\Models\TypeRoom;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Booking page - Travel-Shaper')]

class BookingPage extends Component
{


    public $id;
    public $hotel;
    public $room;
    public $roomtype;
    public $typeroom;
    public $amenities;

    public $checkInDate;
    public $checkOutDate;
    public $total_price;
    public $adults;
    public $children;
    public $infants;
    public $email;
    public $phone;
    public $name;
    public $address;
    public $country;
    public $city;
    public $roomId;

    public $hotelId;

    public $booking;

    public $roomtype_id;
    public $roomtype_Id;
    public $capacitys;
    public $price;
    public $countries;
    public $cities;
    public $street;

    public $selectedAmenities = [];
    public $roomPrice = 0;



    public function mount($id)
    {
        $this->id = $id;

        $this->room = TypeRoom::with('hotel', 'hotel.room', 'hotel.amenities', 'hotel.roomtype', 'hotel.country', 'hotel.city')
            ->findOrFail($this->id);

        $this->countries = Country::all();
        $this->cities = City::all();

        $this->roomtype = $this->room;
        $this->hotel = $this->room->hotel;
        $this->amenities = $this->room->hotel->amenities;
        $this->checkInDate = request()->query('checkInDate');
        $this->checkOutDate = request()->query('checkOutDate');
        $this->adults = request()->query('adults');
        $this->children = request()->query('children');
        $this->infants = request()->query('infants');
        $this->country = $this->room->hotel->country->name;
        $this->city = $this->room->hotel->city->name;

        $this->roomId = $this->room->room->id ?? null;
        $this->hotelId = $this->hotel->id;

        $this->typeroom = $this->room;
        $this->address = $this->street . "," . $this->city . ", " . $this->country;
        $this->roomtype_Id = $this->room->id;
        $this->capacitys = $this->room->room_capacity ?? '1';
        $this->price = $this->room->price;

        $this->calculPrice();
    }
    public function submit()
    {


        $this->validate([
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date|after:checkInDate',
            'adults' => 'required|numeric|min:1',
            'children' => 'required|numeric|min:0',
            'infants' => 'required|numeric|min:0',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:8',
            'name' => 'required|string|max:255',
            'roomId' => 'required|exists:rooms,id',
            'roomtype_Id' => 'required',
            'hotelId' => 'required|exists:hotels,id',
            'country' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'capacitys' => 'required|numeric|min:1',
            'price' => 'required',
            'street' => 'string'
        ]);


        $countryId = Country::where('name', $this->country)->value('id');
        $cityId = City::where('name', $this->city)->value('id');

        $booking = Booking::create([
            'check_in_date' => $this->checkInDate,
            'check_out_date' => $this->checkOutDate,
            'adults' => $this->adults,
            'children' => $this->children,
            'infants' => $this->infants,
            'email' => $this->email,
            'phone' => $this->phone,
            'name' => $this->name,
            'address' => json_encode(['street' => $this->street, 'city' => $this->city, 'country' => $this->country]),
            'country_id' => $countryId,
            'city_id' => $cityId,
            'room_id' => $this->roomId,
            'roomtype_id' => $this->roomtype_Id,
            'total_price' => $this->roomPrice,
            'hotel_id' => $this->hotelId,
            'capacity' => $this->capacitys,
            'price_per_night' => $this->price,
            'street' => $this->street,
        ]);
        if (!empty($this->selectedAmenities)) {
            foreach ($this->selectedAmenities as $amenityId) {
                $amenity = Amenities::find($amenityId);
                if ($amenity) {
                    $price = $amenity->hotels->firstWhere('id', $this->hotelId)->pivot->price ?? 0.00;

                    $booking->amenities()->attach($amenityId, [
                        'price' => $price,
                    ]);
                }
            }
        }



        if ($booking->hotel || $booking->room) {
            session()->flash('success', 'A confirmation email has been sent to your email address.');
            Mail::to($this->email)->send(new BookingConfirmationMail($booking));
            return redirect()->route('booking.waiting-conformation.' . app()->getLocale());

        }
        // return $this->redirect(route("booking.details." . app()->getLocale()));

    }


    public function updateStatus($bookingId, $status)
    {
        $booking = Booking::find($bookingId);
        $booking->booking_status = $status;
        $booking->save();
        Mail::to($booking->email)->send(new BookingStatusUpdated($booking));
        session()->flash('message', 'Booking status updated and email sent to the user.');

    }


    protected function getFormSchema(): array
    {
        return [
            IconPicker::make('icon'),
        ];
    }

    public function getBadgeClassRoom($type)
    {
        return match ($type) {
            'Standard ' => 'bg-green-500',
            'Deluxe ' => 'bg-blue-500',
            'Suite ' => 'bg-yellow-500',
            default => 'bg-gray-500',
        };
    }

    public function updatedSelectedAmenities()
    {
        $this->calculPrice();
    }

    public function calculPrice()
    {
        if ($this->checkInDate && $this->checkOutDate) {
            $checkIn = Carbon::parse($this->checkInDate);
            $checkOut = Carbon::parse($this->checkOutDate);
            $numberOfNights = $checkIn->diffInDays($checkOut);

            $basePrice = $this->room->price * $numberOfNights;

            $totalAmenitiesPrice = 0;

            $this->amenities = Amenities::whereHas('hotels', function ($query) {
                $query->where('hotels.id', $this->hotelId);
            })->with([
                        'hotels' => function ($query) {
                            $query->where('hotels.id', $this->hotelId)
                                ->withPivot('is_free', 'price');
                        }
                    ])->get()->filter(function ($amenity) {
                        return !$amenity->hotels->first()->pivot->is_free;
                    });

            foreach ($this->selectedAmenities as $amenityId) {
                $amenity = $this->amenities->find($amenityId);
                if ($amenity) {
                    foreach ($amenity->hotels as $hotel) {
                        if ($hotel->id == $this->hotelId && !$hotel->pivot->is_free) {
                            $totalAmenitiesPrice += $hotel->pivot->price;
                        }
                    }
                }
            }

            $this->roomPrice = $basePrice + $totalAmenitiesPrice;
        }
    }
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['street', 'city', 'country'])) {
            $this->updateAddress();
        }
    }


    public function updateAddress()
    {
        $countryName = Country::find($this->country)->name ?? '';
        $cityName = City::find($this->city)->name ?? '';
        $this->address = "{$this->street}, {$cityName}, {$countryName}";
    }


    public function render()
    {
        return view('livewire.booking-page', [
            'room' => $this->room,
            'roomtypes' => $this->roomtype,
            'hotel' => $this->hotel,
            'amenity' => $this->amenities,
            'typeroom' => $this->typeroom,

=======
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
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
        ]);
    }
}