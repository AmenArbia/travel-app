<div>
    @include('livewire.partials.navbar')
    @vite('resources/css/hotel-details.css')

    <title>{{ $title ?? 'Travel-App' }}</title>
    <div>
        <section id="tour_details_main" class="py-5">
            <div class="container " style="max-width: 1388px;">
                <div class="row">
                    @if ($hotel->roomtype->isNotEmpty() || count($hotel->amenities) !== 0 || count($hotel->photo) !== 0)
                        <div class="col-md-4 ">

                            <div class="card shadow-xl mb-4 rounded-xl">


                                <div class="card-body" id="card-body">
                                    @if ($hotel->roomtype->isNotEmpty())
                                        <div class="card-title border-b border-violet-600  pb-2">
                                            <h3 class="font-bold text-lg">{{ __('lang.Price starts from :') }}</h3>
                                        </div>
                                        <div class="d-flex align-items-center py-3">
                                            <h3 class="pl-2 text-xl font-bold text-dark">
                                                {{ $roomtype->min('price') }} {{ __('lang.TND') }}
                                                <sub class="font-weight-bold text-violet-500">
                                                    {{ __('lang./Per night') }}</sub>
                                            </h3>
                                        </div>
                                    @endif
                                    @if (count($hotel->amenities) !== 0)

                                        <div class="border-top border-bottom py-3 d-flex justify-content-between">
                                            @foreach ($hotel->amenities as $amenity)
                                                <div class="d-flex align-items-center">
                                                    <div class="pr-2">
                                                        @svg($amenity->icon ?? 'heroicon-o-cog', ['class' => 'w-10 h-10 text-black p-2'])
                                                    </div>
                                                    <div>
                                                        <p class="text-base font-weight-medium">
                                                            @if ($amenity->type === 'Internet')
                                                                {{ __('lang.Internet') }}
                                                            @elseif ($amenity->type === 'Kitchen')
                                                                {{ __('lang.Kitchen') }}
                                                            @elseif ($amenity->type === 'Bedroom')
                                                                {{ __('lang.Bedroom') }}
                                                            @elseif ($amenity->type === 'Living Area')
                                                                {{ __('lang.Living Area') }}
                                                            @elseif ($amenity->type === 'Media and Technology')
                                                                {{ __('lang.Media and Technology') }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($hotel->photo) !== 0)

                                        <div class="mt-3">

                                            <div class="mb-4">
                                                <img src="{{ asset('storage/' . $hotel->photo[$currentImageIndex]->photos) }}"
                                                    class="img-fluid w-full   h-56 rounded-xl"
                                                    alt="{{ $hotel->name }}">
                                            </div>
                                            <div class="row">
                                                @foreach ($hotel->photo as $index => $photo)
                                                    <div class="col-2 mb-2">
                                                        <img src="{{ asset('storage/' . $photo->photos) }}"
                                                            alt="{{ $hotel->name }}"
                                                            class="img-fluid rounded-lg w-20 h-20 object-cover cursor-pointer"
                                                            wire:click="setCurrentImage({{ $index }})">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <button
                                                    class="bg-violet-500 hover:bg-yellow-500 rounded-2xl btn text-white cursor-pointer outline-none  py-1 px-4  overflow-hidden whitespace-nowrap  z-0 border-none  leading-6   align-middle select-none transform transition duration-300 hover:scale-105 hover:shadow-lg focus:ring-2  focus:outline-none active:scale-95  font-bold"
                                                    wire:click="setCurrentImage({{ $currentImageIndex - 1 }})">
                                                    <i class="fas fa-chevron-left"></i> {{ __('lang.Previous') }}
                                                </button>
                                                <button
                                                    class="btn bg-violet-500 hover:bg-yellow-500 rounded-2xl btn  text-white cursor-pointer outline-none  py-1 px-4  overflow-hidden whitespace-nowrap  z-0 border-none  leading-6   align-middle select-none transform transition duration-300 hover:scale-105 hover:shadow-lg focus:ring-2  focus:outline-none active:scale-95  font-bold"
                                                    wire:click="setCurrentImage({{ $currentImageIndex + 1 }})">
                                                    {{ __('lang.Next') }} <i class="fas fa-chevron-right"></i>
                                                </button>
                                            </div>

                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>
                    @endif

                    <div
                        class="col-md-{{ $hotel->roomtype->isNotEmpty() || count($hotel->amenities) !== 0 || count($hotel->photo) !== 0 ? '8' : '12' }}  ">
                        <div class="card shadow-xl rounded-xl mb-4">
                            <div class="card-body">
                                @if ($hotel)
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 class="text-3xl font-bold">{{ __('lang.Hotel Name') }} :
                                            {{ $hotel->name }}</h2>
                                        <h5 class="text-base">
                                            <i class="fas fa-map-marker-alt px-2"></i>
                                            {{ $hotel->city->name }}, {{ $hotel->country->name }}
                                        </h5>
                                    </div>
                                    <div class="d-flex align-items-center mt-2">
                                        <h4 class="text-xl font-bold">
                                            {{ __('lang.Type :') }}
                                            <span
                                                class="badge  py-0.4  {{ $this->getBadgeClassHotel($hotel->type_hotel) }}">
                                                @if ($hotel->type_hotel === 'Hotel')
                                                    {{ __('lang.Hotel') }}
                                                @elseif ($hotel->type_hotel === 'Resort')
                                                    {{ __('lang.Resort') }}
                                                @elseif ($hotel->type_hotel === 'Guest House')
                                                    {{ __('lang.Guest House') }}
                                                @endif
                                            </span>
                                        </h4>
                                        <div class="ml-auto">
                                            @for ($i = 1; $i <= $hotel->rating; $i++)
                                                <i class="fas fa-star text-warning"></i>
                                            @endfor
                                            @if ($hotel->rating < 5)
                                                @for ($i = $hotel->rating + 1; $i <= 5; $i++)
                                                    <i class="far fa-star text-secondary"></i>
                                                @endfor
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <h5 class="font-bold border-b border-violet-600 pb-2 pt-2">
                                            {{ __('lang.Description') }}:
                                        </h5>
                                        <p class="mt-3">{{ $hotel->description }}</p>
                                    </div>
                                @else
                                    <p class="text-danger">{{ __('lang.Hotel not found.') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="card shadow-xl rounded-xl">
                            <div class="card-body">
                                <h3 class="font-bold border-b text-lg border-violet-600 pb-2">
                                    {{ __('lang.Select your room') }}
                                </h3>
                                <div class="mt-3">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label
                                                        class="text-sm text-slate-500 font-normal pb-2">{{ __('lang.Check In date') }}</label>
                                                    <input type="date"
                                                        class="form-control bg-violet-200 text-gray-400 hover:text-gray-700 hover:font-semibold"
                                                        wire:model.defer="checkInDate" wire:change="calculPrice">
                                                    @error('checkInDate')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label
                                                        class="text-sm text-slate-500 font-normal pb-2">{{ __('lang.Check Out date') }}</label>
                                                    <input type="date"
                                                        class="form-control bg-violet-200 text-gray-400 hover:text-gray-700 hover:font-semibold"
                                                        wire:model.defer="checkOutDate" wire:change="calculPrice">
                                                    @error('checkOutDate')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2 ml-2 ">
                                                <div class="form-group">
                                                    <label
                                                        class="text-sm text-slate-500 font-normal pb-2">{{ __('lang.Guests') }}</label>
                                                    <div class="dropdown ">
                                                        <button class="btn btn-light dropdown-toggle " type="button"
                                                            id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ __('lang.N° Guests :') }}
                                                            {{ $adults + $infants + $children }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown_passenger_info dropdown-menu-right "
                                                            aria-labelledby="dropdownMenuButton1">

                                                            <div class="traveller-calculate-persons shadow-md">

                                                                <div class="passengers ">

                                                                    <div class="passengers-types ">
                                                                        <!-- Adults -->
                                                                        <div
                                                                            class="passengers-type flex align-items-center pt-2 pr-4 pb-2 pl-4 justify-between border-b-2">
                                                                            <div class="text align-items-center flex">
                                                                                <span
                                                                                    class="count mr-5 w-6 inline-block text-xl font-semibold">{{ $adults }}</span>
                                                                                <div class="type-label">
                                                                                    <p class="text-sm text-slate-600">
                                                                                        {{ __('lang.Adults') }}
                                                                                    </p>
                                                                                    <span
                                                                                        class="text-xs text-slate-500">{{ __('lang.12+ yrs') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="button-set flex space-x-1">
                                                                                <button type="button"
                                                                                    wire:model="adults"
                                                                                    wire:click="incrementAdults"
                                                                                    class="text-xs text-slate-black border w-5 h-5 flex items-center justify-center"
                                                                                    {{ $adults >= $maxAdults ? 'disabled' : '' }}>
                                                                                    <i
                                                                                        class="fas fa-plus font-black"></i>
                                                                                </button>
                                                                                <button type="button"
                                                                                    wire:model="adults"
                                                                                    wire:click="decrementAdults"
                                                                                    class="text-xs text-slate-black border w-5 h-5 flex items-center justify-center"
                                                                                    {{ $adults <= 0 ? 'disabled' : '' }}>
                                                                                    <i
                                                                                        class="fas fa-minus font-black"></i>
                                                                                </button>
                                                                            </div>

                                                                        </div>
                                                                        <!-- Children -->
                                                                        <div
                                                                            class="passengers-type flex align-items-center pt-2 pr-4 pb-2 pl-4 justify-between border-b-2">
                                                                            <div class="text align-items-center flex">
                                                                                <span
                                                                                    class="count mr-5 w-6 inline-block text-xl font-semibold">{{ $children }}</span>
                                                                                <div class="type-label">
                                                                                    <p class="text-sm text-slate-600">
                                                                                        {{ __('lang.Children') }}
                                                                                    </p>
                                                                                    <span
                                                                                        class="text-xs text-slate-500">{{ __('lang.Less than 12 and +2 yrs') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="button-set flex space-x-1">
                                                                                <button type="button"
                                                                                    wire:model="children"
                                                                                    wire:click="incrementChildren"
                                                                                    class="text-xs text-slate-black border w-5 h-5 flex items-center justify-center"
                                                                                    {{ $children >= $maxChildren ? 'disabled' : '' }}>
                                                                                    <i
                                                                                        class="fas fa-plus font-black"></i>
                                                                                </button>
                                                                                <button type="button"
                                                                                    wire:model="children"
                                                                                    wire:click="decrementChildren"
                                                                                    class="text-xs text-slate-black border w-5 h-5 flex items-center justify-center"
                                                                                    {{ $children <= 0 ? 'disabled' : '' }}>
                                                                                    <i
                                                                                        class="fas fa-minus font-black"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Infants -->
                                                                        <div
                                                                            class="passengers-type flex align-items-center pt-2 pr-4 pb-2 pl-4 justify-between border-b-2">
                                                                            <div class="text align-items-center flex">
                                                                                <span
                                                                                    class="count mr-5 w-6 inline-block text-xl font-semibold">{{ $infants }}</span>
                                                                                <div class="type-label">
                                                                                    <p class="text-sm text-slate-600">
                                                                                        {{ __('lang.Infants') }}
                                                                                    </p>
                                                                                    <span
                                                                                        class="text-xs text-slate-500">{{ __('lang.Less than 2 yrs') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="button-set flex space-x-1">
                                                                                <button type="button"
                                                                                    wire:model="infants"
                                                                                    wire:click="incrementInfants"
                                                                                    class="text-xs text-slate-black border w-5 h-5 flex items-center justify-center"
                                                                                    {{ $infants >= $maxInfants ? 'disabled' : '' }}>
                                                                                    <i
                                                                                        class="fas fa-plus font-black"></i>
                                                                                </button>
                                                                                <button type="button"
                                                                                    wire:model="infants"
                                                                                    wire:click="decrementInfants"
                                                                                    class="text-xs text-slate-black border w-5 h-5 flex items-center justify-center"
                                                                                    {{ $infants <= 0 ? 'disabled' : '' }}>
                                                                                    <i
                                                                                        class="fas fa-minus font-black"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right  col-md-7 mt-4">
                                                <button
                                                    class="btn cursor-pointer   hover:text-white bg-violet-100 shadow-none overflow-hidden whitespace-nowrap relative z-0 border-none inline-block  leading-6 text-center no-underline hover:bg-yellow-500 align-middle select-none rounded-md transform transition duration-300  hover:scale-105 hover:shadow-lg  focus:outline-none active:scale-95"
                                                    type="button" wire:click="checkAvailability">
                                                    {{ __('lang.Check availability') }}
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="mt-4">
                                    @if ($availableRooms && $availableRooms->isNotEmpty())
                                        <form wire:submit>
                                            @foreach ($availableRooms as $room)
                                                <div
                                                    class="d-flex justify-content-between align-items-center mb-3 p-3 border-bottom">

                                                    <div class="flex-grow-1 mx-3">
                                                        <h4 class="text-base">{{ $room->name }}
                                                            ({{ number_format($room->room_capacity) }}
                                                            {{ __('lang.Pax') }})
                                                            <span
                                                                class="badge ml-2  rounded-lg bg-green-500 text-white font-bold ">{{ __('lang.Available') }}</span>
                                                        </h4>

                                                        <p class="text-sm text-muted">
                                                            {{ Str::limit($room->description, 100, '...') }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <h3 class="text-base font-bold text-black">
                                                            {{ $room->total_price }} {{ __('lang.TND') }}
                                                            <sub class="text-red-500">

                                                            </sub>

                                                        </h3>
                                                        <a href="{{ route('booking.' . app()->getLocale(), [
                                                            'id' => $room->id,
                                                            'checkInDate' => $checkInDate,
                                                            'checkOutDate' => $checkOutDate,
                                                            'adults' => $adults,
                                                            'children' => $children,
                                                            'infants' => $infants,
                                                        ]) }}"
                                                            class="btn mt-3 hover:bg-yellow-500 hover:font-bold font-medium text-white rounded-full
                                    bg-violet-600 no-underline transform transition duration-300 hover:scale-105 hover:shadow-lg ">
                                                            {{ __('lang.Book Now') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </form>
                                    @elseif ($availableRooms && $availableRooms->isEmpty())
                                        <p class="text-danger font-bold text-center">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ __('lang.No rooms available.') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Related Hotels -->
                    <div class="py-5 text-center">
                        <h2 class="text-4xl font-bold border-b border-violet-500 pb-2 d-inline-block">
                            {{ __('lang.Related Hotels') }}
                        </h2>
                        <div class="row mt-4 ">
                            @forelse ($relatedHotels as $relatedHotel)
                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-lg">
                                        <img src="{{ asset('storage/' . $relatedHotel->image_cover) }}"
                                            alt="{{ $relatedHotel->name }}"
                                            class="card-img-top object-cover w-full h-40"
                                            style="transition: transform 0.3s ease-in-out 0.1s, opacity 0.3s ease-in-out;">
                                        <div class="card-body">
                                            <h3 class="card-title font-weight-bold">{{ $relatedHotel->name }}</h3>
                                            <p class="card-text text-muted">
                                                {{ Str::limit($relatedHotel->description, 30, '...') }}</p>
                                            <span
                                                class="badge mt-2 {{ $this->getBadgeClassHotel($relatedHotel->type_hotel) }}">
                                                @if ($relatedHotel->type_hotel === 'Hotel')
                                                    {{ __('lang.Hotel') }}
                                                @elseif ($relatedHotel->type_hotel === 'Resort')
                                                    {{ __('lang.Resort') }}
                                                @elseif ($relatedHotel->type_hotel === 'Guest House')
                                                    {{ __('lang.Guest House') }}
                                                @endif
                                            </span>
                                            <div>
                                                <a href="{{ route('details.slug.' . app()->getLocale(), $relatedHotel->slug) }}"
                                                    class="btn mt-3 hover:bg-yellow-500 hover:font-bold font-medium text-white rounded-3xl px-3 py-1
                                    bg-violet-600 no-underline transform transition duration-300 hover:scale-105 hover:shadow-lg">{{ __('lang.View Details') }}</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">{{ __('lang.No related hotels found.') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
