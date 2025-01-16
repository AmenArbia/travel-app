<div>
    <section id="tour_details_main" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="relative w-96 max-h-60">
                    @if ($hotel)
                        <div
                            class="tour_details_right_boxed w-3/4 bg-white shadow-2xl relative left-2/4 bottom-12 rounded-lg pt-6 pr-5 pb-9 pl-5">
                            <div class="tour_details_right_box_heading">
                                <h3 class="font-semibold text-lg border-b-2 border-violet-600 pb-2 inline-block">
                                    {{ __('lang.Price starts from :') }}</h3>
                            </div>

                            <div class="tour_package_bar_price flex align-items-center pt-4 pb-10">
                                <h3 class="pl-2 text-xl font-semibold text-slate-700 ">
                                    {{ $roomtype->min('price') }} TND
                                    <sub class="font-bold text-violet-400"> {{ __('lang./per night') }}</sub>
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
                                            <p class="text-base  font-medium">{{ $amenity->type }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <div class="tour_details_img_wrapper mt-2 block ">
                                <!-- Main Image -->
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
                                        Previous
                                    </button>
                                    <button
                                        class="text-black p-2 rounded-full text-lg transform transition duration-200 hover:scale-95 hover:shadow-lg  hover:bg-yellow-500 hover:text-white hover:font-bold   focus:outline-none active:scale-95"
                                        wire:click="setCurrentImage({{ $currentImageIndex + 1 }})">
                                        Next<i class="fa-solid fa-chevron-right left-1 font-bold pl-1 relative top-0.5 "
                                            style="color: #8b65fa;  "></i>

                                    </button>
                                </div>
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
                            <div class="tour_details_top_heading_right">
                                <h4 class="text-xl font-semibold text-black pt-2 pl-2">
                                    {{ __('lang.Type :') }}<span
                                        class="inline-block px-2 py-0.4 font-bold text-white rounded-2xl text-base relative left-3
                                    {{ $this->getBadgeClassHotel($hotel->type_hotel) }} ">
                                        {{ $hotel->type_hotel }}
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
                            <p class="text-red-500">Hotel not found.</p>
                        @endif
                    </div>




                    <div class="tour_details_boxed bg-white shadow-2xl rounded-xl p-5 mt-7 pb-16">
                        <h3
                            class="heading_theme font-semibold inline-block  mb-5 rounded-s-sm  text-2xl border-b-2 border-violet-600 pb-2">
                            Select your room</h3>
                        <div class="room_select_area">

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="room_booking_area">
                                        <div class="tour_search_form">
                                            <form action="!#" class="block mt-0 unicode-bidi isolate">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-6 col-sm-12 col-12 w-96 ml-14 max-h-32">
                                                        <div class="form_search_date w-2/4 justify-between">
                                                            <div
                                                                class="flight_Search_boxed date_flex_area flex content-between bg-violet-100 pt-2 pr-2 pb-2 pl-5 rounded-lg relative right-4 ">
                                                                <div class="Journey_date">
                                                                    <p
                                                                        class="text-sm text-slate-500 font-normal Poppins sans-serif mb-0 mt-0">
                                                                        Check In date
                                                                    </p>
                                                                    <div class="relative">
                                                                        <input type="date" value=""
                                                                            id="checkInDate"
                                                                            wire:model.defer="checkInDate"
                                                                            wire:change="calculPrice"
                                                                            class="text-lg w-4/5 font-medium bg-transparent p-0 h-9 inherit rounded-none  line-height-inherit padding-inline-start-1px cursor-default">
                                                                        @error('checkInDate')
                                                                            <span
                                                                                class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="Journey_date relative left-10">
                                                                    <p
                                                                        class="text-sm text-slate-500 font-normal Poppins sans-serif mb-0 mt-0">
                                                                        Check Out date
                                                                    </p>
                                                                    <div class="relative">
                                                                        <input type="date" id="checkOutDate"
                                                                            wire:change="calculPrice"
                                                                            wire:model.defer="checkOutDate"
                                                                            class="text-lg w-4/5 font-medium bg-transparent p-0 h-9 inherit rounded-none line-height-inherit padding-inline-start-1px cursor-default">
                                                                        @error('checkOutDate')
                                                                            <span
                                                                                class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
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
                                                                    Guests
                                                                </p>
                                                                <div class="dropdown h-9 pb-2 mb-3 relative top-1 ">
                                                                    <button class="dropdown-toggle" type="button"
                                                                        id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                                        style="font-weight: bold;"
                                                                        aria-haspopup="true">
                                                                        N° Guests :
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
                                                                                            <div class="type-label">
                                                                                                <p
                                                                                                    class="text-sm text-slate-600">
                                                                                                    Adult</p>
                                                                                                <span
                                                                                                    class="text-xs text-slate-500">12+
                                                                                                    yrs</span>
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
                                                                                            <div class="type-label">
                                                                                                <p
                                                                                                    class="text-sm text-slate-600">
                                                                                                    Children</p>
                                                                                                <span
                                                                                                    class="text-xs text-slate-500">Less
                                                                                                    than 12 and +2
                                                                                                    yrs</span>
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
                                                                                            <div class="type-label">
                                                                                                <p
                                                                                                    class="text-sm text-slate-600">
                                                                                                    Infants</p>
                                                                                                <span
                                                                                                    class="text-xs text-slate-500">Less
                                                                                                    than 2
                                                                                                    yrs</span>
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
                                                            Check availability
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
                                                                        class="form-checkbox h-5 w-5 text-violet-600 mr-3">
                                                                </div>

                                                                <!-- Room Information -->
                                                                <div class="room_booking_heading w-2/4">
                                                                    <h4 class="text-base">
                                                                        {{ $room->name }}
                                                                        ({{ number_format($room->room_capacity) }} Pax)
                                                                    </h4>
                                                                    <span
                                                                        class="bg-green-600 rounded-lg px-2 py-1 relative bottom-8 left-44 text-white font-bold text-sm ml-3">
                                                                        Available
                                                                    </span>
                                                                    <p class="text-sm text-gray-500 relative bottom-5">
                                                                        {{ $room->description }}
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

                                                            <!-- Book Button
                                                            <div class="book-room flex justify-end mt-8">

                                                            </div>-->
                                                        @endforeach

                                                    </div>

                                                </form>
                                            @else
                                                @error('checkAvailability')
                                                    <span
                                                        class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                                @enderror
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>




            </div>


            <!-- Related Hotels -->
            <div class="py-2 text-center bottom-60 relative right-96 pb-2" style="width: 1300px">
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
                            <p class="text-gray-500">{{ Str::limit($relatedHotel->description, 30, '...') }}</p>
                            <div class="py-3 mt-2">
                                <span
                                    class="inline-block px-2 py-0.4 font-bold text-white rounded-2xl text-md
                                    {{ $this->getBadgeClassHotel($relatedHotel->type_hotel) }}">
                                    {{ $relatedHotel->type_hotel }}
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






        </div>




        <style>
            img:hover {
                transform: scale(1.05);

                opacity: 0.9;

            }

            .tour_package_details_bar_list ul li {
                padding-top: 15px;
                color: #212529;
                display: flex;
                align-items: center;
            }

            [type=button]:not(:disabled),
            [type=reset]:not(:disabled),
            [type=submit]:not(:disabled),
            button:not(:disabled) {
                cursor: pointer;
            }

            button[disabled] {
                opacity: 0.5;
                cursor: not-allowed;
            }

            @media (max-width: 1440px) {
                .dropdown_passenger_area button {
                    font-size: 18px;
                }
            }

            @media (min-width: 576px) {
                .col-sm-12 {
                    flex: 0 0 auto;
                    width: 100%;
                }
            }

            .col-12 {
                flex: 0 0 auto;
                width: 550px;
            }

            .row>* {
                flex-shrink: 0;
                width: 100%;
                max-width: 100%;
                padding-right: calc(var(--bs-gutter-x)* .5);
                padding-left: calc(var(--bs-gutter-x)* .5);
                margin-top: var(--bs-gutter-y);
            }

            .tab-content>.active {
                display: block;
            }

            .room_select_area .nav-tabs .nav-item.show .nav-link,
            .room_select_area .nav-tabs .nav-link.active {
                color: white;
                background-color: rgb(140, 27, 252);
                border-color: #dee2e6 #dee2e6 #fff;
            }

            .room_select_area .nav-tabs .nav-link:hover {
                color: white;

                background-color: rgb(213, 167, 58);

                border-color: #ccc;

            }

            .dropdown_passenger_area .dropdown-menu.show {
                right: 250px;
                position: relative;
                z-index: 1000;
            }

            .dropdown_passenger_area .dropdown-menu {
                z-index: 1000;
                padding: 15px 20px;
                font-size: 1rem;
                color: #212529;
                text-align: left;
                list-style: none;
                background-color: #fdfdfd;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, .15);
                border-radius: 0.25rem;
                border-top: none;
                border-bottom: 1px solid rgba(53, 50, 50, 0.15);
                position: relative;
                right: 250px;
            }

            .dropdown-menu.show {
                display: flex;
                position: relative;
                right: 250px;
            }

            .dropdown-menu {
                position: relative;
                left: 450px;
                z-index: 1000;
                display: none;
                min-width: 250px;
                margin: 0;
                font-size: 1rem;
                color: #212529;
                text-align: left;
                list-style: none;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, .15);
                border-radius: .25rem;
                border-top: none;
                border-bottom: 1px solid rgba(53, 50, 50, 0.15);
            }

            .dropdown_passenger_area button {
                border: none;
                background: transparent;
                padding: 0;
                font-size: 22px;
                font-weight: 500;
            }

            .dropdown-toggle {
                white-space: nowrap;
            }


            /* Styling the ::after pseudo-element */
            .room_select_area .nav-tabs .nav-link:hover::after {
                background-color: rgb(200, 150, 20);

                content: '';
                display: block;
                height: 3px;
                width: 100%;
                position: absolute;
                bottom: 0;
                left: 0;
            }




            .room_select_area .nav-tabs .nav-link {
                margin-bottom: 0;
                background: #F3F6FD;
                border: 1px solid transparent;
                border-radius: 0.25rem;
                padding: 10px 110px;
            }

            .nav-tabs .nav-item.show .nav-link,
            .nav-tabs .nav-link.active {
                color: #495057;
                background-color: #fff;
                border-color: #dee2e6 #dee2e6 #fff;
            }

            @media (max-width: 992px) {
                .flight_Search_boxed {
                    margin-bottom: 30px;
                }
            }

            .nav-tabs .nav-link {
                margin-bottom: -1px;
                background: 0 0;
                border: 1px solid transparent;
                border-top-left-radius: .25rem;
                border-top-right-radius: .25rem;
            }



            .nav-link {
                display: block;
                padding: .5rem 1rem;
                color: white;
                text-decoration: none;
                transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
            }

            [type=button],
            [type=reset],
            [type=submit],
            button {
                -webkit-appearance: button;
            }

            button,
            select {
                text-transform: none;
            }

            button,
            input,
            optgroup,
            select,
            textarea {
                margin: 0;
                font-family: inherit;
                font-size: inherit;
                line-height: inherit;
            }

            button {
                border-radius: 0;
            }

            *,
            ::after,
            ::before {
                box-sizing: border-box;
            }



            @media (max-width: 767px) {
                .toru_details_top_bottom_item {
                    display: inline-grid;
                    align-items: center;
                }
            }

            @media (max-width: 767px) {
                .tour_details_top_heading_right {
                    padding-top: 20px;
                }
            }

            .fa-map-marker-alt:before {
                content: "\f3c5";
            }

            *,
            ::after,
            ::before {
                box-sizing: border-box;
            }

            .fa,
            .fas {
                font-weight: 900;
            }

            .fa,
            .far,
            .fas {
                font-family: "Font Awesome 5 Free";
            }

            .fa,
            .fab,
            .fad,
            .fal,
            .far,
            .fas {
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                display: inline-block;
                font-style: normal;
                font-variant: normal;
                text-rendering: auto;
                line-height: 1;
            }

            div {
                display: block;
                unicode-bidi: isolate;
            }

            section {
                position: relative;
                display: block;
                unicode-bidi: isolate;
            }

            .section_padding {
                padding: 100px 0;
            }

            @media (min-width: 576px) {

                .container,
                .container-sm {
                    max-width: 540px;
                }
            }

            @media (max-width: 767px) {
                .tour_details_heading_wrapper {
                    display: inherit;
                }
            }

            .row {
                --bs-gutter-x: 1.5rem;
                --bs-gutter-y: 0;
                display: flex;
                flex-wrap: wrap;
                margin-top: calc(var(--bs-gutter-y)* -1);
                margin-right: calc(var(--bs-gutter-x)* -.5);
                margin-left: calc(var(--bs-gutter-x)* -.5);
                width: 750px;
            }

            .container,
            .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                width: 100%;
                padding-right: var(--bs-gutter-x, .75rem);
                padding-left: var(--bs-gutter-x, .75rem);
                margin-right: auto;
                margin-left: auto;
            }
        </style>
    </section>
</div>
