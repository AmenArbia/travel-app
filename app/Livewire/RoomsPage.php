<?php

namespace App\Livewire;

use App\Models\Amenities;
use App\Models\Room;
use App\Models\TypeRoom;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Rooms Page - Travel-Shaper')]

class RoomsPage extends Component
{
    use WithPagination;

    public $selected_amenities = [];
    public $selected_status = [];
    public $selected_types = [];
    public $capacity = 500;
    public $room;
    public $photo;

    public $minPrice = 0;
    public $maxPrice = 10000;
    public $step = 50;
    public $selectedMinPrice;
    public $selectedMaxPrice;

    public function mount()
    {
        $this->room = TypeRoom::with(['hotel', 'room'])->firstOrFail();
        $this->photo = $this->room->photos;
        $this->selectedMinPrice = $this->minPrice;
        $this->selectedMaxPrice = $this->maxPrice;
    }

    public function applyPriceFilter()
    {
        $this->minPrice = $this->selectedMinPrice;
        $this->maxPrice = $this->selectedMaxPrice;
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


    public function render()
    {
        $roomQuery = Room::query();

        if (!empty($this->selected_types)) {
            $roomQuery->whereIn('type', $this->selected_types);
        }
        if (!empty($this->selectedMinPrice)) {
            $roomQuery->whereHas('roomtype', function ($query) {
                $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
            });
        }
        $roomsCount = $roomQuery->count();



        return view('livewire.rooms-page', [
            'rooms' => $roomQuery->paginate(4),
            'amenities' => Amenities::all(),
            'roomtype' => TypeRoom::all(),
            'photos' => $this->photo,
            'types' => Room::distinct()->pluck('type'),
            'roomsCount' => $roomsCount,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
        ]);
    }
}