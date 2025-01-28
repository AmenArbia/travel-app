<?php

namespace App\Livewire;

use App\Models\Amenities;
use App\Models\Hotel;
use App\Models\TypeRoom;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

<<<<<<< HEAD
#[Title('Home page - Travel-Shaper')]
=======
#[Title('Home Page - Travel-Shaper')]
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
class HomePage extends Component
{
    use WithPagination;

    public $selected_amenities = [];
    public $selected_status = [];
    public $selected_types = [];
<<<<<<< HEAD

    public $roomtype;
    public $hotel;




    public function getAmenityIconAndTranslation($type)
    {
        $icons = [
            'Internet' => 'fa-solid fa-wifi',
            'Kitchen' => 'fa-solid fa-kitchen-set',
            'Bedroom' => 'fa-solid fa-bed',
            'Living Area' => 'fa-solid fa-couch',
            'Media and Technology' => 'fa-brands fa-instagram',
        ];

        return [
            'translation' => __($type, [], 'amenities'),
            'icon' => $icons[$type] ?? 'fa-solid fa-circle-question',
        ];
    }

=======
    public $capacity = 500;

    public $slug;
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df


    public function getBadgeClass($type)
    {
        return match ($type) {
            'Hotel' => 'bg-green-500',
            'Resort' => 'bg-blue-500',
            'Guest House' => 'bg-yellow-500',
            default => 'bg-gray-500',
        };
    }


<<<<<<< HEAD


    public function render()
    {
        $hotelQuery = Hotel::query();
=======
    public function render()
    {
        $hotelQuery = Hotel::query();




>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
        if (!empty($this->selected_types)) {
            $hotelQuery->whereIn('type_hotel', $this->selected_types);
        }

        if (!empty($this->selected_status)) {
            $hotelQuery->whereIn('status', $this->selected_status);
        }

        if (!empty($this->selected_amenities)) {
            $hotelQuery->whereHas('amenities', function ($query) {
<<<<<<< HEAD
                $query->where('status', '=', 'Active');

                $languageKey = app()->getLocale() === 'ar' ? 'ar' : 'en';

                $query->whereIn(DB::raw("title->>'$languageKey'"), $this->selected_amenities);
            });
        }

=======
                $query->whereIn('type', $this->selected_amenities);
            });
        }


>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
        $hotelsCount = $hotelQuery->count();



        return view('livewire.home-page', [
            'hotels' => $hotelQuery->paginate(3),
<<<<<<< HEAD
            'amenities' => Amenities::where('status', 'Active')->get(),
            'roomtype' => TypeRoom::all(),
            'types' => Hotel::distinct()->pluck('type_hotel'),
            'statuses' => Hotel::distinct()->pluck('status'),
            'amenitiesTypes' => Amenities::where('status', 'Active')->get(),
=======
            'amenities' => Amenities::all(),
            'roomtype' => TypeRoom::all(),
            'types' => Hotel::distinct()->pluck('type_hotel'),
            'statuses' => Hotel::distinct()->pluck('status'),
            'amenitiesTypes' => Amenities::distinct()->pluck('type'),
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
            'hotelsCount' => $hotelsCount,

        ]);
    }
}
