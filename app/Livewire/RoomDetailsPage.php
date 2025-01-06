<?php

namespace App\Livewire;

use App\Models\Amenities;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\TypeRoom;
use Livewire\Component;
use Livewire\Attributes\Lazy;


class RoomDetailsPage extends Component
{
    public $room;
    public $roomtype;

    public $hotel;

    public $id;
    public $amenity;

    public $currentSlide = 0;

    public function mount($id)
    {
        $this->room = Room::with(['roomtype', 'hotels'])->where('id', $id)->findOrFail($id);
        $this->hotel = Hotel::with(['photo', 'roomtype.room', 'roomtype.photos', 'roomtype', 'amenities', 'city', 'country', 'chaine'])->first();
        $this->roomtype = TypeRoom::with(['room'])->where('room_id', $id)->get();
        $this->amenity = Amenities::with(['room'])->where('room_id', $id)->get();
    }

    public function previousSlide()
    {
        $photos = $this->getAllPhotos();
        $this->currentSlide = ($this->currentSlide > 0) ? $this->currentSlide - 1 : count($photos) - 1;
    }

    public function nextSlide()
    {
        $photos = $this->getAllPhotos();
        $this->currentSlide = ($this->currentSlide < count($photos) - 1) ? $this->currentSlide + 1 : 0;
    }

    private function getAllPhotos()
    {
        $photos = [];
        foreach ($this->roomtype as $type) {
            if ($type->photos && count($type->photos) > 0) {
                $photos = array_merge($photos, $type->photos);
            }
        }
        return $photos;
    }

    public function render()
    {


        return view('livewire.room-details', [
            'rooms' => $this->room,
            'roomtype' => $this->roomtype,
            //'roomtype' => TypeRoom::where('room_id', $this->room->id)->get(),
            'hotel' => $this->hotel,
            'amenity' => $this->amenity
        ]);
    }
}
