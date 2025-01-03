<?php

namespace App\Livewire;

use App\Models\Amenities;
use App\Models\Hotel;
use App\Models\TypeRoom;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Home Page - Travel-Shaper')]
class HomePage extends Component
{
    use WithPagination;

    public $selected_amenities = [];
    public $selected_status = [];
    public $selected_types = [];
    public $capacity = 500;

    public $slug;


    public function getBadgeClass($type)
    {
        return match ($type) {
            'Hotel' => 'bg-green-500',
            'Resort' => 'bg-blue-500',
            'Guest House' => 'bg-yellow-500',
            default => 'bg-gray-500',
        };
    }


    public function render()
    {
        $hotelQuery = Hotel::query();




        if (!empty($this->selected_types)) {
            $hotelQuery->whereIn('type_hotel', $this->selected_types);
        }

        if (!empty($this->selected_status)) {
            $hotelQuery->whereIn('status', $this->selected_status);
        }

        if (!empty($this->selected_amenities)) {
            $hotelQuery->whereHas('amenities', function ($query) {
                $query->whereIn('type', $this->selected_amenities);
            });
        }


        $hotelsCount = $hotelQuery->count();



        return view('livewire.home-page', [
            'hotels' => $hotelQuery->paginate(3),
            'amenities' => Amenities::all(),
            'roomtype' => TypeRoom::all(),
            'types' => Hotel::distinct()->pluck('type_hotel'),
            'statuses' => Hotel::distinct()->pluck('status'),
            'amenitiesTypes' => Amenities::distinct()->pluck('type'),
            'hotelsCount' => $hotelsCount,

        ]);
    }
}
