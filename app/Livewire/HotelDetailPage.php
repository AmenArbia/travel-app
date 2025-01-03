<?php


namespace App\Livewire;

use App\Models\Hotel;
use Livewire\Attributes\Title;
use Livewire\Component;



class HotelDetailPage extends Component
{
    public $hotel;
    public $roomtype;
    public $room;

    public $photo;

    public $chaine;

    public $slug;

    public $relatedHotels;

    public $roomAvailable = false;
    public $showModal = false;
    public $showRooms;

    public function mount($slug)
    {

        $this->hotel = Hotel::with(['photo', 'roomtype.room', 'roomtype', 'amenities', 'city', 'country', 'chaine'])
            ->where("slug->" . app()->getLocale(),  $slug)
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
        $this->relatedHotels->count();
    }



    public function toggleRoomAvailability()
    {
        $this->roomAvailable = !$this->roomAvailable;
        $this->showModal = !$this->roomAvailable ? true : false;
    }

    public function closeModal()
    {
        $this->showModal = true;
    }

    public function getBadgeClass($type)
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

    public function toggleRooms()
    {
        $this->showRooms = !$this->showRooms;
    }
    public function render()
    {
        return view('livewire.details-page', [
            'hotel' => $this->hotel,
            'photos' => $this->photo,
            'roomtype' => $this->roomtype,
            'room' => $this->room,
            'chaines' => $this->chaine,
        ]);
    }
}
