<?php

namespace App\Livewire;

use App\Mail\BookingConfirmationMail;
use App\Mail\BookingStatusUpdated;
use App\Models\Amenities;
use App\Models\Booking;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\TypeRoom;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

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
    public $selectedRoom = [];
    public $roomOptions = [];
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
    public $roomPrice;
    public $roomtype_id;
    public $roomtype_Id;
    public $capacitys;
    public $price;
    public $countries;
    public $cities;
    public $street;
    public $successMessage = '';



    public function mount()
    {

        $this->room = TypeRoom::where("id", $this->id)->with('hotel', 'room', 'hotel.amenities', 'hotel.roomtype', 'room.roomtype', 'hotel.country', 'hotel.city')->first();
        $this->countries = Country::all();
        $this->cities = City::where('country_id', $this->room->hotel->country_id)->get();
        $this->roomtype = $this->room->roomtype;
        $this->hotel = $this->room->hotel;
        $this->amenities = $this->room->hotel->amenities;
        $this->checkInDate = request()->query('checkInDate');
        $this->checkOutDate = request()->query('checkOutDate');
        $this->adults = request()->query('adults');
        $this->children = request()->query('children');
        $this->infants = request()->query('infants');
        $this->country = $this->room->hotel->country->name ?? '';
        $this->city = $this->room->hotel->city->name ?? '';
        $this->roomId = $this->roomId ?? $this->room->id;
        $this->hotelId = $this->hotelId ?? $this->hotel->id;


        $this->typeroom = Room::where('id', $this->id)->first();
        $this->address = $this->street . "," . $this->city . ", " . $this->country;
        $this->roomtype_Id = $this->typeroom->id;
        $this->capacitys = $this->room->room_capacity ?? '1';
        $this->price = $this->room->price;

        $this->calculPrice();

        //dd($this->room, $this->hotel, $this->amenities, $this->checkInDate, $this->checkOutDate , $this->typeroom);


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



        if ($booking->hotel || $booking->room) {
            session()->flash('success', 'A confirmation email has been sent to your email address.');
            Mail::to($this->email)->send(new BookingConfirmationMail($booking));
            sleep(3);
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

    public function calculPrice()
    {
        if ($this->checkInDate && $this->checkOutDate) {
            $checkIn = Carbon::parse($this->checkInDate);
            $checkOut = Carbon::parse($this->checkOutDate);
            $numberOfNights = $checkIn->diffInDays($checkOut);
            $this->roomPrice = $this->room->price * $numberOfNights;

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
        $this->address = "{$this->street}, {$this->city}, {$this->country}";
    }





    public function render()
    {
        return view('livewire.booking-page', [
            'room' => $this->room,
            'roomtypes' => $this->roomtype,
            'hotel' => $this->hotel,
            'amenity' => $this->amenities,
            'typeroom' => $this->typeroom,

        ]);
    }
}
