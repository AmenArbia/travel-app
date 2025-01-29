<div>
    @include('livewire.partials.navbar')
    @vite('resources/css/hotel-details.css')

    <title>{{ $title ?? 'Travel-App' }}</title>
    <div>
        <section id="tour_details_main" class="section_padding">
            <div class="container">
                <div class="row">
                    <div class="w-96 max-h-60">
                        @if ($hotel)
                            <div
                                class="tour_details_right_boxed w-3/4 bg-white shadow-2xl relative left-2/4 bottom-12 rounded-lg pt-6 pr-5 pb-9 pl-5">
                                <div class="tour_details_right_box_heading">
                                    <h3 class="font-semibold text-lg border-b-2 border-violet-600 pb-2 inline-block">
                                        {{ __('lang.Price starts from :') }}</h3>
                                </div>

                                <div class="tour_package_bar_price flex align-items-center pt-4 pb-10">
                                    <h3 class="pl-2 text-xl font-semibold text-slate-700 ">
                                        {{ $roomtype->min('price') }} {{ __('lang.TND') }}
                                        <sub class="font-bold text-violet-400"> {{ __('lang./Per night') }}</sub>
                                    </h3>
                                </div>
                                <div
                                    class="tour_details_top_bottom mt-3 border-t-2 border-gray-200 pt-5 border-b pb-3 flex justify-between relative bottom-5 mr-2 ml-2">
                                    @foreach ($hotel->amenities as $amenity)
                                        <div class="toru_details_top_bottom_item">
                                            <div class="tour_details_top_bottom_icon text-3xl pr-2">
                                                @svg($amenity->icon ?? 'heroicon-o-cog', ['class' => 'w-10 h-10 text-black p-2'])

                                            </div>
                                            <div class="tour_details_top_bottom_text">
                                                <p class="text-base  font-medium">
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

                                <div class="tour_details_img_wrapper mt-2 block ">
                                    <!-- Main Image -->
                                    @if (count($hotel->photo) !== 0)


                                        <div class="main-image mb-4 ">
                                            <img src="{{ asset('storage/' . $hotel->photo[$currentImageIndex]->photos[0]) }}"
                                                class="w-full h-56 object-cover rounded-xl" alt="{{ $hotel->name }}">
                                        </div>

                                        <!-- Related Images (Thumbnails) -->
                                        <div class="related-images grid  gap-1 grid-cols-5">
                                            @foreach ($hotel->photo as $index => $photo)
                                                <div class="image-item " style="">
                                                    <img src="{{ asset('storage/' . $photo->photos[0]) }}"
                                                        alt="{{ $hotel->name }}"
                                                        class=" rounded-xl w-20 h-20 object-cover cursor-pointer "
                                                        wire:click="setCurrentImage({{ $index }})">
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Navigation Buttons (Previous/Next) -->
                                        <div class="flex justify-between mt-4">
                                            <button
                                                class="text-black p-2 rounded-full text-lg transform transition duration-200 hover:scale-95 hover:shadow-lg  hover:bg-yellow-500 hover:text-white hover:font-bold   focus:outline-none active:scale-95"
                                                wire:click="setCurrentImage({{ $currentImageIndex - 1 }})"><i
                                                    class="fa-solid fa-chevron-left  font-bold pl-1 relative top-0.5"
                                                    style="color: #8b65fa;"></i>
                                                {{ __('lang.Previous') }}
                                            </button>
                                            <button
                                                class="text-black p-2 rounded-full text-lg transform transition duration-200 hover:scale-95 hover:shadow-lg  hover:bg-yellow-500 hover:text-white hover:font-bold   focus:outline-none active:scale-95"
                                                wire:click="setCurrentImage({{ $currentImageIndex + 1 }})">
                                                {{ __('lang.Next') }}<i
                                                    class="fa-solid fa-chevron-right left-1 font-bold pl-1 relative top-0.5 "
                                                    style="color: #8b65fa;  "></i>

                                            </button>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>


                    <div class=" relative  -left-96 w-96 bottom-96 -top-72   ">
                        <div class="tour_details_heading_wrapper bg-white shadow-2xl rounded-xl pt-6 pr-5 pb-9 pl-5">
                            @if ($hotel)

                                <div
                                    class="tour_details_top_heading display-flex justify-content-space-between align-items-center  ">
                                    <h2 class="text-3xl font-semibold line-height-40 Roboto sans-serif m-0   ">
                                        {{ __('lang.Hotel Name') }} : {{ $hotel->name }}
                                    </h2>
                                    <h5 class=" text-base Roboto sans-serif m-0 pt-2 pl-2 pr-2 text">
                                        <i class="fas fa-map-marker-alt  px-2"></i>
                                        {{ $hotel->city->name }}, {{ $hotel->country->name }}
                                    </h5>
                                </div>
                                <div class="tour_details_top_heading_right relative left-2">
                                    <h4 class="text-xl font-semibold text-black pt-2 pl-2">
                                        {{ __('lang.Type :') }}<span
                                            class="inline-block px-2 py-0.4 font-bold text-white rounded-2xl text-base relative left-3
                                    {{ $this->getBadgeClassHotel($hotel->type_hotel) }} ">
                                            @if ($hotel->type_hotel === 'Hotel')
                                                {{ __('lang.Hotel') }}
                                            @elseif ($hotel->type_hotel === 'Resort')
                                                {{ __('lang.Resort') }}
                                            @elseif ($hotel->type_hotel === 'Guest House')
                                                {{ __('lang.Guest House') }}
                                            @endif
                                        </span>
                                    </h4>
                                    <div class="text-base text-violet-600 pt-2 pl-2 relative left-3/4 bottom-28 pr-2">
                                        @for ($i = 1; $i <= $hotel->rating; $i++)
                                            <i class="fa-solid fa-star text-yellow-500"></i>
                                        @endfor
                                        @if ($hotel->rating < 5)
                                            @for ($i = $hotel->rating + 1; $i <= 5; $i++)
                                                <i class="fa-regular fa-star text-gray-400"></i>
                                            @endfor
                                        @endif
                                    </div>

                                </div>

                                <div class="tour_package_details_bar_list pt-5 max-h-80">
                                    <h5 class="font-medium border-b-2 border-violet-600 pb-2 inline-block text-base">
                                        {{ __('lang.Description') }}:
                                    </h5>
                                    <div class="max-h-60 ">
                                        {{ $hotel->description }}
                                    </div>
                                </div>
                            @else
                                <p class="text-red-500">{{ __('lang.Hotel not found.') }}</p>
                            @endif
                        </div>

                        <div class="tour_details_boxed bg-white shadow-2xl rounded-xl p-5 mt-7 pb-16">
                            <h3
                                class="heading_theme font-semibold inline-block  mb-5 rounded-s-sm  text-2xl border-b-2 border-violet-600 pb-2">
                                {{ __('lang.Select your room') }}</h3>
                            <div class="room_select_area">

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="room_booking_area">
                                            <div class="tour_search_form">
                                                <form action="!#" class="block mt-0 unicode-bidi isolate">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-8 col-md-6 col-sm-12 col-12 w-96 ml-14 max-h-20">
                                                            <div
                                                                class="form_search_date w-2/4 justify-between max-h-24">
                                                                <div
                                                                    class="flight_Search_boxed date_flex_area flex content-between bg-violet-100 pt-2 pr-2 pb-2 pl-5 rounded-lg relative right-4 max-h-24 ">
                                                                    <div class="Journey_date">
                                                                        <p
                                                                            class="text-sm text-slate-500 font-normal Poppins sans-serif mb-0 mt-0">
                                                                            {{ __('lang.Check In date') }}
                                                                        </p>
                                                                        <div class="relative">
                                                                            <input type="date" value=""
                                                                                id="checkInDate"
                                                                                wire:model.defer="checkInDate"
                                                                                wire:change="calculPrice"
                                                                                class="text-lg w-4/5 font-medium bg-transparent p-0 h-9 inherit rounded-none  line-height-inherit padding-inline-start-1px cursor-default">
                                                                            @error('checkInDate')
                                                                                <span
                                                                                    class="text-red-500 text-xs mt-1 block ">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="Journey_date relative left-10 pl-5">
                                                                        <p
                                                                            class="text-sm text-slate-500 font-normal Poppins sans-serif mb-0 mt-0">
                                                                            {{ __('lang.Check Out date') }}
                                                                        </p>
                                                                        <div class="relative">
                                                                            <input type="date" id="checkOutDate"
                                                                                wire:change="calculPrice"
                                                                                wire:model.defer="checkOutDate"
                                                                                class="text-lg w-4/5 font-medium bg-transparent p-0 h-9 inherit rounded-none line-height-inherit padding-inline-start-1px cursor-default">
                                                                            @error('checkOutDate')
                                                                                <span
                                                                                    class="text-red-500 text-xs  block relative right-10">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div>
                                                            @if (session()->has('message'))
                                                                <div class="alert alert-success mb-4">
                                                                    {{ session('message') }}
                                                                </div>
                                                            @endif

                                                            <div
                                                                class="relative bottom-20  -right-1/2  max-w-56 ml-14 h-14 ">
                                                                <div
                                                                    class="bg-violet-100 pt-2 pr-2  pl-5 rounded-lg relative w-48 top-2  left-3 ">
                                                                    <p
                                                                        class="text-base line-height-28 text-slate-500 font-normal Poppins sans-serif ">
                                                                        {{ __('lang.Guests') }}
                                                                    </p>
                                                                    <div class="dropdown h-9 pb-2 mb-3 relative top-1 ">
                                                                        <button class="dropdown-toggle" type="button"
                                                                            id="dropdownMenuButton1"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false"
                                                                            style="font-weight: bold;"
                                                                            aria-haspopup="true">
                                                                            {{ __('lang.N° Guests :') }}
                                                                            {{ $adults + $infants + $children }}

                                                                        </button>

                                                                        <div class="dropdown-menu dropdown_passenger_info dropdown-menu-right "
                                                                            aria-labelledby="dropdownMenuButton1">

                                                                            <div
                                                                                class="traveller-calculate-persons shadow-md">

                                                                                <div class="passengers ">

                                                                                    <div class="passengers-types ">
                                                                                        <!-- Adults -->
                                                                                        <div
                                                                                            class="passengers-type flex align-items-center pt-2 pr-4 pb-2 pl-4 justify-between border-b-2">
                                                                                            <div
                                                                                                class="text align-items-center flex">
                                                                                                <span
                                                                                                    class="count mr-5 w-6 inline-block text-xl font-semibold">{{ $adults }}</span>
                                                                                                <div
                                                                                                    class="type-label">
                                                                                                    <p
                                                                                                        class="text-sm text-slate-600">
                                                                                                        {{ __('lang.Adults') }}
                                                                                                    </p>
                                                                                                    <span
                                                                                                        class="text-xs text-slate-500">{{ __('lang.12+ yrs') }}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="button-set flex space-x-1">
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
                                                                                            <div
                                                                                                class="text align-items-center flex">
                                                                                                <span
                                                                                                    class="count mr-5 w-6 inline-block text-xl font-semibold">{{ $children }}</span>
                                                                                                <div
                                                                                                    class="type-label">
                                                                                                    <p
                                                                                                        class="text-sm text-slate-600">
                                                                                                        {{ __('lang.Children') }}
                                                                                                    </p>
                                                                                                    <span
                                                                                                        class="text-xs text-slate-500">{{ __('lang.Less than 12 and +2 yrs') }}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="button-set flex space-x-1">
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
                                                                                            <div
                                                                                                class="text align-items-center flex">
                                                                                                <span
                                                                                                    class="count mr-5 w-6 inline-block text-xl font-semibold">{{ $infants }}</span>
                                                                                                <div
                                                                                                    class="type-label">
                                                                                                    <p
                                                                                                        class="text-sm text-slate-600">
                                                                                                        {{ __('lang.Infants') }}
                                                                                                    </p>
                                                                                                    <span
                                                                                                        class="text-xs text-slate-500">{{ __('lang.Less than 2 yrs') }}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="button-set flex space-x-1">
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


                                                        <div
                                                            class="top_form_search_button text-right text-align-center mt-7 inline-block mb-5 relative top-14  ">
                                                            <button
                                                                class="cursor-pointer p-3 px-9 text-lg text-slate-500 font-normal border-b-2 border-violet-500  hover:text-white bg-violet-100 shadow-none overflow-hidden whitespace-nowrap relative z-0 border-none inline-block  leading-6 text-center no-underline hover:bg-yellow-500 align-middle select-none rounded-md transform transition duration-300  hover:scale-105 hover:shadow-lg  focus:outline-none active:scale-95 bottom-20 right-80 "
                                                                type="button" wire:click="checkAvailability">
                                                                {{ __('lang.Check availability') }}
                                                            </button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="room_book_item mt-14">
                                                @if ($availableRooms && $availableRooms->isNotEmpty())
                                                    <form wire:submit>
                                                        <div>
                                                            @foreach ($availableRooms as $room)
                                                                <div
                                                                    class="room_booking_right_side flex justify-between mb-4 p-4 border-b-2">
                                                                    <div class="room_checkbox flex items-center">
                                                                        <input type="checkbox"
                                                                            id="room-{{ $room->id }}"
                                                                            value="{{ $room->id }}"
                                                                            wire:model="selectedRooms"
                                                                            class="form-checkbox h-5 w-5 text-violet-600 mr-3"
                                                                            hidden>
                                                                    </div>

                                                                    <!-- Room Information -->
                                                                    <div class="room_booking_heading w-2/4">
                                                                        <h4 class="text-base">
                                                                            {{ $room->name }}
                                                                            ({{ number_format($room->room_capacity) }}
                                                                            Pax)
                                                                        </h4>
                                                                        <span
                                                                            class="bg-green-600 rounded-lg px-2 py-1 relative bottom-8 left-44 text-white font-bold text-sm ml-3">
                                                                            Available
                                                                        </span>
                                                                        <p
                                                                            class="text-sm text-gray-500 relative bottom-5">
                                                                            {{ Str::limit($room->description, 100, '...') }}
                                                                        </p>
                                                                    </div>

                                                                    <!-- Price -->
                                                                    <div
                                                                        class="price text-center w-56 relative left-12 max-h-5 mr-3">
                                                                        <h3
                                                                            class="text-base text-black font-semibold right-7 max-h-5">
                                                                            {{ $room->total_price }} TND /
                                                                            <del
                                                                                class="text-sm text-gray-600 relative top-1 decoration-red-600 decoration-2">
                                                                                {{ $room->price }} TND
                                                                            </del>
                                                                        </h3>
                                                                        <a href="{{ route('booking.' . app()->getLocale(), [
                                                                            'id' => $room->id,
                                                                            'checkInDate' => $checkInDate,
                                                                            'checkOutDate' => $checkOutDate,
                                                                            'adults' => $adults,
                                                                            'children' => $children,
                                                                            'infants' => $infants,
                                                                        ]) }}"
                                                                            class="  top-3 bg-violet-600 text-white py-2 px-6 rounded-lg overflow-hidden whitespace-nowrap relative z-0 border-none inline-block leading-6 text-center no-underline hover:bg-yellow-500 align-middle select-none transform transition duration-300 hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none active:scale-95 h-10 font-semibold w-32">
                                                                            Book
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>

                                                    </form>
                                                @elseif ($availableRooms && $availableRooms->isEmpty())
                                                    <p
                                                        class="text-red-500 font-bold text-lg relative left-52 bottom-16">
                                                        <i
                                                            class="fas fa-exclamation-circle px-2 text-lg text-red-500"></i>
                                                        {{ __('lang.No rooms available.') }}
                                                    </p>

                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>



            <!-- Related Hotels -->
            <div class="py-2 text-center bottom-60 m-24 relative pb-2">
                <h2
                    class="flex-col items-center py-2 mb-4 text-4xl font-bold text-gray-800 border-b-2 border-violet-500 inline-block">
                    {{ __('lang.Related Hotels') }}
                </h2>

                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-4 px-3
                    @if (count($relatedHotels) < 3) justify-center @endif">

                    @forelse ($relatedHotels as $relatedHotel)
                        <div class="p-1 bg-white rounded-lg shadow-2xl pb-4">
                            <img src="{{ asset('storage/' . $relatedHotel->image_cover) }}"
                                alt="{{ $relatedHotel->name }}" class="object-cover w-full h-40 mb-4 rounded-md"
                                style="transition: transform 0.3s ease-in-out 0.1s, opacity 0.3s ease-in-out;">
                            <div class="relative bottom-10 right-16">
                                <i class="px-1 text-white fa-solid fa-location-dot font-black"></i><span
                                    class="font-bold text-slate-50">
                                    {{ $hotel->city->name }}, {{ $hotel->country->name }} </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800">{{ $relatedHotel->name }}</h3>
                            <p class="text-gray-500">{{ Str::limit($relatedHotel->description, 30, '...') }}
                            </p>
                            <div class="py-3 mt-2">
                                <span
                                    class="inline-block px-2 py-0.4 font-bold text-white rounded-2xl text-md
                                    {{ $this->getBadgeClassHotel($relatedHotel->type_hotel) }}">
                                    @if ($relatedHotel->type_hotel === 'Hotel')
                                        {{ __('lang.Hotel') }}
                                    @elseif ($relatedHotel->type_hotel === 'Resort')
                                        {{ __('lang.Resort') }}
                                    @elseif ($relatedHotel->type_hotel === 'Guest House')
                                        {{ __('lang.Guest House') }}
                                    @endif
                                </span>
                            </div>

                            <button wire:click="toggleRoomAvailability"
                                class="w-full hover:font-bold font-medium text-white rounded-full lg:w-2/4 hover:bg-yellow-500
                                bg-violet-600 no-underline transform transition duration-300 hover:scale-105 hover:shadow-lg">
                                <a href="{{ route('details.slug.' . app()->getLocale(), $relatedHotel->slug) }}"
                                    class="text-white no-underline underline-offset-4">{{ __('lang.View Details') }}</a>
                            </button>
                        </div>
                    @empty
                        <p class="text-gray-500">{{ __('lang.No related hotels found.') }}</p>
                    @endforelse
                </div>
            </div>


        </section>
    </div>



    </section>

</div>
