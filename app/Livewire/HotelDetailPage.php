<?php


namespace App\Livewire;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\TypeRoom;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;
use Guava\FilamentIconPicker\Forms\IconPicker;


use function Livewire\after;
#[Title('Hotel details page - Travel-Shaper')]

class HotelDetailPage extends Component
{
    public $hotel;
    public $roomtype;
    public $room;

    public $photo;

    public $chaine;

    public $slug;

    public $relatedHotels;

    public $checkInDate;
    public $checkOutDate;
    public $adults = 1;
    public $children = 0;
    public $infants = 0;

    public $maxAdults = 5;
    public $maxChildren = 3;
    public $maxInfants = 2;

    public $availableRooms = [];

    public $showRooms;
    public $currentImageIndex = 0;

    public $selectedRooms = [];



    public function mount($slug)
    {

        $this->hotel = Hotel::with(['photo', 'roomtype.room', 'roomtype', 'amenities', 'city', 'country', 'chaine', 'room'])
            ->where("slug", $slug)
            ->firstOrFail();

        $this->roomtype = $this->hotel->roomtype;
        $this->room = $this->hotel->room;
        $this->photo = $this->hotel->photo;
        $this->chaine = $this->hotel->chaine;

        $this->relatedHotels = Hotel::where('chaine_id', $this->hotel->chaine_id)
            ->where('id', '!=', $this->hotel->id)
            ->with(['photo', 'city', 'country'])
            ->take(6)
            ->get();
    }


    public function checkAvailability()
    {
        $this->validate([
            'checkInDate' => 'required|date|after_or_equal:today',
            'checkOutDate' => 'required|date|after:checkInDate',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
            'infants' => 'required|integer|min:0',
        ]);


        $totalGuests = $this->adults + $this->children + $this->infants;
        $this->availableRooms = TypeRoom::whereHas('room', function ($query) {
            $query->where('hotel_id', $this->hotel->id);
        })
            ->where('room_capacity', '>=', $totalGuests)
            ->orderBy('price', 'asc')
            ->get();

        $this->calculPrice();
        $this->checkInDate = Carbon::now()->format('Y-m-d');
    }


    public function calculPrice()
    {
        if ($this->checkInDate && $this->checkOutDate) {
            $checkIn = Carbon::parse($this->checkInDate);
            $checkOut = Carbon::parse($this->checkOutDate);
            $numberOfNights = $checkIn->diffInDays($checkOut);

            foreach ($this->availableRooms as $room) {
                $room->total_price = $room->price * $numberOfNights;
            }
        }
    }



    public function incrementAdults()
    {
        if ($this->adults < $this->maxAdults) {
            $this->adults++;
        }

    }

    public function decrementAdults()
    {
        if ($this->adults > 0) {
            $this->adults--;
        }
    }

    public function incrementChildren()
    {
        if ($this->children < $this->maxChildren) {
            $this->children++;
        }
    }

    public function decrementChildren()
    {
        if ($this->children > 0) {
            $this->children--;
        }
    }

    public function incrementInfants()
    {
        if ($this->infants < $this->maxInfants) {
            $this->infants++;
        }
    }

    public function decrementInfants()
    {
        if ($this->infants > 0) {
            $this->infants--;
        }
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

    public function getBadgeClassHotel($type)
    {
        return match ($type) {
            'Hotel' => 'bg-green-500',
            'Resort' => 'bg-blue-500',
            'Guest House' => 'bg-yellow-500',
            default => 'bg-gray-500',
        };
    }
    public function setCurrentImage($index)
    {


        $index += $this->photo->count() * 1000;
        $this->currentImageIndex = $index % $this->photo->count();


    }

    protected function getFormSchema(): array
    {
        return [
            IconPicker::make('icon'),
        ];
    }


    public function render()
    {
        return view('livewire.details-page', [
            'hotel' => $this->hotel,
            'photos' => $this->photo,
            'roomtype' => $this->roomtype,
            'room' => $this->room,
            'chaines' => $this->chaine,
            'currentImageIndex' => $this->currentImageIndex,
        ]);
    }
}