<div>
<<<<<<< HEAD
    @include('livewire.partials.navbar')
    @vite('resources/css/booking.css')

    <title>{{ $title ?? 'Travel-App' }}</title>

    <div class="section_padding">
        <div class="container">
            <div>
                <div class="row relative top-10">
                    <div class="bg-white rounded-full shadow-3xl w-1/2 ml-20 max-h-max mt-20">

                        <div class="relative w-1/3 bg-white shadow-2xl bottom-12 rounded-lg pt-6 pr-5 pb-9 pl-5 mr-40">
                            <div class="box-title">
                                <h3
                                    class="font-semibold text-lg border-b-2 border-border-gray-200 pb-2  text-violet-400">
                                    {{ __('lang.Reservation Information') }}
                                </h3>
                            </div>

                            <div class="">
                                <div class="main-image mb-4">
                                    @if ($room && $room->photos)
                                        <img src="{{ asset('storage/' . $room->photos[0]) }}"
                                            alt="{{ $room->code }} photo"
                                            class="object-cover w-full h-full rounded-md
                                            ">
                                    @endif
                                </div>

                            </div>
                            <div>

                                <div class="border border-gray-200 mt-2 rounded-md ">

                                    <h5 class="ml-3 pt-2 text-gray-800 font-semibold">
                                        {{ __('lang.Hotel :') }} <span class=" font-bold ">
                                            {{ $room->hotel->name }}</span>
                                    </h5>
                                    <div class=" ml-3">
                                        @for ($i = 1; $i <= $room->hotel->rating; $i++)
                                            <i
                                                class="fa-solid
                                        fa-star text-yellow-500"></i>
                                        @endfor
                                        @if ($room->hotel->rating < 5)
                                            @for ($i = $room->hotel->rating + 1; $i <= 5; $i++)
                                                <i class="fa-regular fa-star text-gray-400"></i>
                                            @endfor
                                        @endif
                                    </div>
                                    <i class="px-1 text-gray-400 fa-solid fa-location-dot pt-3 pb-3 ml-3 "></i><span
                                        class="font-semiibold text-gray-600">
                                        {{ $room->hotel->city->name }}, {{ $room->hotel->country->name }} </span>

                                    @foreach ($room->hotel->amenities->chunk(4) as $amenityChunk)
                                        <ul class="list-none m-0 p-0 flex flex-wrap gap-4 pb-2 pt-1 ml-4">
                                            @foreach ($amenityChunk as $amenity)
                                                <li class="flex items-center gap-2  ">
                                                    @svg($amenity->icon ?? 'heroicon-o-cog', ['class' => 'w-4 h-4 text-black'])
                                                    <p class="text-gray-500">
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
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>

                                <div class="border border-gray-200 mt-2 rounded-md pb-2">
                                    <h5 class="ml-3 pt-4 text-gray-800 font-semibold">
                                        {{ __('lang.Reservation details') }}
                                    </h5>
                                    <div
                                        class="grid grid-cols-3 items-center gap-4 ml-16 mr-16 border border-b-2 border-gray-200 border-l-0 border-r-0 border-t-0  pb-0">
                                        <div
                                            class="text-center flex flex-col items-center justify-center w-56 relative right-12 m-2">
                                            <h5 class="text-violet-500  font-semibold right-16 relative">
                                                {{ __('lang.Check in date :') }}
                                            </h5>
                                            <span
                                                class="text-gray-600 flex items-center justify-center w-30 pr-10   text-sm relative  inset-x-0 right-7">{{ \Carbon\Carbon::parse($checkInDate)->format('l, d F Y') }}</span>
                                        </div>

                                        <div class="h-full border-l border-gray-300 relative left-12 "></div>
                                        <div
                                            class=" text-center flex flex-col items-center justify-center relative w-56 right-10 bottom-1 m-2 ">
                                            <h5 class="text-violet-500 font-semibold relative right-16">
                                                {{ __('lang.Check out date :') }}
                                            </h5>
                                            <span
                                                class="text-gray-600 flex items-center justify-center w-30 pr-12   text-sm relative  inset-x-0 right-7">{{ \Carbon\Carbon::parse($checkOutDate)->format('l, d F Y') }}</span>

                                        </div>
                                        <div>
                                            <h5
                                                class="text-center items-center justify-center w-56 relative right-16 ml-2 bottom-2 text-violet-500 font-semibold text-base">
                                                {{ __('lang.Period of stay :') }} <span
                                                    class="text-sm  font-semibold text-gray-500  ">
                                                    {{ \Carbon\Carbon::parse($checkInDate)->diffInDays(\Carbon\Carbon::parse($checkOutDate)) }}
                                                    {{ __('lang.nights') }}
                                                </span>

                                            </h5>

                                            <div>
                                                <h5
                                                    class="text-center items-center justify-center w-56 relative -left-24  ml-2 bottom-2 text-violet-500 font-semibold text-base pl-2">
                                                    {{ __('lang.N° of Guests :') }} <span
                                                        class="text-sm  font-semibold text-gray-500">{{ $adults + $infants + $children }}</span>
                                                </h5>
                                            </div>
                                        </div>




                                    </div>
                                    <div class="ml-2 mt-1">

                                        <div class=" ml-2">
                                            @if ($room)
                                                <h5 class="text font-semibold text-gray-700">
                                                    {{ __('lang.Selected Room') }}
                                                </h5>
                                                <p class="text-gray-500 font-semibold">{{ __('lang.Name :') }} <span
                                                        class="text-gray-400">{{ ucfirst($room->name) }}</span></p>
                                                @if ($typeroom)
                                                    <p class="text-gray-500 p-2 font-semibold ">
                                                        {{ __('lang.Type :') }} <span
                                                            class=" inline-block px-2 py-0.4 font-bold text-white rounded-2xl text-md {{ $this->getBadgeClassRoom($typeroom->room->type) }}">

                                                            @if ($typeroom->room->type === 'Standard ')
                                                                {{ __('lang.Standard ') }}
                                                            @elseif ($typeroom->room->type === 'Deluxe ')
                                                                {{ __('lang.Deluxe ') }}
                                                            @elseif ($typeroom->room->type === 'Suite ')
                                                                {{ __('lang.Suite ') }}
                                                            @endif
                                                        </span></p>
                                                @endif
                                            @else
                                                <p class="text-gray-500">{{ __('lang.No room selected yet.') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="ml-1 mt-2 bg-violet-100 h-20 border border-gray-200 rounded-md ">
                                    <h5 class="relative top-6  ml-4 text-2xl font-bold">
                                        {{ __('lang.Total Price :') }} <span
                                            class="text-black font-semibold relative left-12 ">{{ __('lang.TND') }}
                                            {{ $roomPrice + $amenity->hotels->first()->pivot->price }}/<del
                                                class="text-sm text-gray-500 relative top-1 decoration-red-600 decoration-2">
                                                {{ $room->price }} {{ __('lang.TND') }}
                                            </del>
                                        </span>
                                    </h5>
                                </div>

                            </div>

                        </div>
                        <div class="relative   bg-white rounded-lg shadow-2xl mr-40 mb-5 pb-4 "
                            style="left: 500px ; bottom: 927px ; width: 850px;  ">
                            <div class="pt-3 pr-5 pb-4 pl-2">
                                <h4 class="font-semibold text-xl text-violet-400 border-b-2 border-gray-200 pb-1 m-3  ">
                                    {{ __('lang.Enter your details') }}
                                </h4>
                            </div>
                            <form method="POST" wire:submit.prevent="submit">
                                @csrf
                                <div class="  pb-2 mr-2 ml-2 mb-2  border border-b-2 border-gray-200   ">
                                    <div class="grid grid-cols-2 sm:col-span-4 lg:col-span-2">
                                        <div class=" pt-2 pb-4 ml-5 " style="width: 350px">
                                            <label for="name" class="pb-2 font-semibold">{{ __('lang.Full Name') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('lang.Enter your name') }}"
                                                wire:model="name"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 " required>
                                            <div>
                                                @error('name')
                                                    <span class="error text-red-600"> <i
                                                            class="fas fa-exclamation-triangle"></i>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class=" pt-2 pb-4 ml-5 " style="width: 350px">
                                            <label for="name"
                                                class="pb-2 font-semibold">{{ __('lang.Email address') }} </label>
                                            <input type="email"
                                                placeholder="{{ __('lang.Enter your email address') }}"
                                                wire:model="email"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 " required>
                                            <div>
                                                @error('email')
                                                    <span class="error text-red-600"><i
                                                            class="fas fa-exclamation-triangle"></i>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class=" pb-4 ml-5 " style="width: 350px">
                                            <label for="name"
                                                class="pb-2 font-semibold">{{ __('lang.Phone number') }} </label>
                                            <input type="tel"
                                                placeholder="{{ __('lang.Enter your phone number') }}"
                                                wire:model="phone"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200" required>
                                            <div>
                                                @error('phone')
                                                    <span class="error text-red-600"><i
                                                            class="fas fa-exclamation-triangle"></i>


                                                        {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div
                                        class=" border border-b-2 border-gray-200 pb-2 w-4/5 border-t-0 border-r-0 border-l-0 left-20 relative ">

                                    </div>
                                    <h3
                                        class="font-semibold  m-5 order border-b-2 border-gray-200 pb-2 w-28 border-t-0 border-r-0 border-l-0  text-black">
                                        {{ __('lang.Your address') }}
                                    </h3>
                                    <div class="grid grid-cols-2 sm:col-span-4 lg:col-span-2">
                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <label for="address"
                                                class="pb-2 font-semibold">{{ __('lang.Address') }}</label>
                                            <input type="text" id="address" wire:model="address"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200" required>
                                            <div>
                                                @error('address')
                                                    <span class="error text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <label for="address"
                                                class="pb-2 font-semibold">{{ __('lang.Street') }}</label>
                                            <input type="text" id="address" wire:model="street"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200"
                                                placeholder="{{ __('lang.Enter your street') }}" required>
                                            <div>
                                                @error('address')
                                                    <span class="error text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <label for="country"
                                                class="pb-2 font-semibold">{{ __('lang.Country/Region') }}</label>
                                            <select wire:model="country"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200" required>
                                                <option value="" disabled selected>Choose your country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('country')
                                                    <span class="error text-red-600">
                                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <label for="city"
                                                class="pb-2 font-semibold">{{ __('lang.City') }}</label>
                                            <select wire:model="city"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200" required>
                                                <option value="" disabled selected>
                                                    {{ __('lang.Choose your city') }}</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('city')
                                                    <span class="error text-red-600">
                                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div
                                            class="relative top-2  left-7 border border-t-2 border-b-0 border-l-0 border-r-0">

                                            <h3 class="relative top-3 font-semibold text-black">Add Amenities </h3>
                                            <div class=" border border-t-2 border-gray-200 pb-2  border-b-0 border-r-0 border-l-0 right-2 relative top-3 "
                                                style="width: 130px;">
                                            </div>
                                            @foreach ($amenities as $amenity)
                                                <div class="top-3 relative max-h-10">
                                                    <label>
                                                        <input type="checkbox" wire:model="selectedAmenities"
                                                            value="{{ $amenity->id }}" wire:change="calculPrice"
                                                            class="pr-2">
                                                        {{ $amenity->title }} :
                                                    </label>
                                                    <p class="pl-4 relative left-20 bottom-6">
                                                        {{ $amenity->description }}
                                                    </p>
                                                    <p class="relative left-full text-left pl-2 bottom-12 ">Price :
                                                        {{ $amenity->hotels->first()->pivot->price }}
                                                        {{ __('lang.TND') }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>








                                        <div class=" pb-4 ml-5 " style="width: 350px">
                                            <input type="date" placeholder="Complet address"
                                                wire:model="checkInDate"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200  " hidden>
                                        </div>

                                        <div class=" pb-4 ml-5 " style="width: 350px">
                                            <input type="date" placeholder="Complet address"
                                                wire:model="checkOutDate"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200  " hidden>
                                        </div>

                                        <div class=" pb-4 ml-5 " style="width: 350px">
                                            <input type="number" placeholder="Complet address" wire:model="adults"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200  " hidden>
                                        </div>
                                        <div class=" pb-4 ml-5 " style="width: 350px">
                                            <input type="number" placeholder="Complet address" wire:model="children"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200  " hidden>
                                        </div>
                                        <div class=" pb-4 ml-5 " style="width: 350px">
                                            <input type="number" placeholder="Complet address" wire:model="infants"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200  " hidden>
                                        </div>
                                        <div class=" pb-4 ml-5 " style="width: 350px">
                                            <input type="number" placeholder="Complet address" wire:model="roomId"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200  " hidden>
                                        </div>

                                        <div class=" pb-4 ml-5 " style="width: 350px">
                                            <input type="number" placeholder="Complet address" wire:model="hotelId"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200  " hidden>
                                        </div>

                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <input type="number" wire:model="roomtype_Id" value=""
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 " hidden>
                                        </div>

                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <input type="number" wire:model="capacitys" value=""
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 " hidden>
                                        </div>
                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <input type="number" wire:model="price" value=""
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 " hidden>
                                        </div>
                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <input type="number" wire:model="total_price" value=""
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 " hidden>
                                        </div>

                                    </div>
                                </div>


                                <div>

                                    <button type="submit"
                                        class="bg-violet-600 left-3/4  text-white py-2 px-6 rounded-md overflow-hidden whitespace-nowrap relative z-0 border-none inline-block leading-6 text-center no-underline hover:bg-yellow-500 align-middle select-none transform transition duration-300 hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none active:scale-95 h-10 font-semibold w-32">
                                        {{ __('lang.Book now') }} </button>
                                </div>

                            </form>


                            <div class="">
                                @if (session('success'))
                                    <div class="  left-3/4 right-0   bg-white rounded-lg relative shadow-2xl w-72 "
                                        style="bottom: 450px">
                                        <h3
                                            class="text-green-600 font-bold justify-center items-center relative left-5 bottom-4 pt-5 pb-2 pl-2">
                                            <x-heroicon-o-check-circle
                                                class="text-green-600 w-10 h-7 pr-2 relative right-4 top-6" />
                                            <span class="pl-5"> {{ session('success') }}</span>

                                        </h3>

                                    </div>
                                @endif
                            </div>

                            <script>
                                @if (session('success'))
                                    setTimeout(function() {
                                        window.location.href = "{{ route('booking.details.' . app()->getLocale()) }}";
                                    }, 2000);
                                @endif
                            </script>




                        </div>

                    </div>






                </div>
            </div>


        </div>
    </div>
=======
   
    <form wire:submit.prevent="submitBooking">
        <div class="flex flex-wrap gap-10">
            <!-- User Information -->
            <div
                class="w-96 py-10 bg-slate-50 rounded-2xl hover:bg-white hover:shadow-lg shadow-xl transition duration-300 booking_tour_form">
                <h2 class="font-bold text-violet-600 left-9 py-8 relative">User Information</h2>
                <input type="text" wire:model="name" placeholder="Full Name" required class="form-control py-5">
                <input type="email" wire:model="email" placeholder="Email" required class="form-control">
                <input type="text" wire:model="phone" placeholder="Phone" required class="form-control">
                <!-- Room Capacity Section -->

                <h3 class="font-bold text-violet-600 relative left-9 py-10">Reservation Information</h3>
                @if ($roomType)
                    <div class="tour_package_details_bar_list">
                        <h5 class="font-bold relative left-9 ">Room Capacity: {{ $roomType->room_capacity }}</h5>
                        <div class="select_person_item">
                            <div class="select_person_left">
                                <h6>Capacity</h6>
                            </div>
                            <div class="select_person_right">
                                <button class="rounded-none border-none focus:outline-none bg-white" type="button"
                                    wire:click="decrement('capacity')">-</button>
                                <h6>{{ $capacity }}</h6>
                                <button class="rounded-none border-none focus:outline-none bg-white" type="button"
                                    wire:click="increment('capacity')">+</button>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 relative left-20">Select a room to view capacity options.</p>
                @endif
                <div>
                    <div class="select_person_item">
                        <div class="select_person_left">
                            <h6 class="font-bold">Adult</h6>
                            <p>12y+</p>
                        </div>
                        <div class="select_person_right">
                            <button class="rounded-none border-none focus:outline-none bg-white" type="button"
                                wire:click="decrement('adults')">-</button>
                            <h6>{{ $adults }}</h6>
                            <button class="rounded-none border-none focus:outline-none bg-white" type="button"
                                wire:click="increment('adults')">+</button>
                        </div>
                    </div>
                    <div class="select_person_item">
                        <div class="select_person_left">
                            <h6 class="font-bold">Children</h6>
                            <p>2 - 12 years</p>
                        </div>
                        <div class="select_person_right">
                            <button class="rounded-none border-none focus:outline-none bg-white" type="button"
                                wire:click="decrement('children')">-</button>
                            <h6>{{ $children }}</h6>
                            <button class="rounded-none border-none focus:outline-none bg-white" type="button"
                                wire:click="increment('children')">+</button>
                        </div>
                    </div>
                    <div class="select_person_item">
                        <div class="select_person_left">
                            <h6 class="font-bold">Infants</h6>
                            <p>Below 2 years</p>
                        </div>
                        <div class="select_person_right">
                            <button class="rounded-none border-none focus:outline-none bg-white" type="button"
                                wire:click="decrement('infants')">-</button>
                            <h6>{{ $infants }}</h6>
                            <button class="rounded-none border-none focus:outline-none bg-white" type="button"
                                wire:click="increment('infants')">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Details -->
            <div
                class="w-96 py-10  bg-slate-50 rounded-2xl hover:bg-white hover:shadow-lg shadow-lg transition duration-300 booking_tour_form">
                <h2 class="font-bold text-violet-600 left-9 relative">Booking Details</h2>
                <h4 class="text-slate-600 font-semibold py-5 left-9 relative">Reservation Dates</h4>
                <input type="date" wire:model="check_in_date" placeholder="Check-in Date" required
                    class="rounded-3xl width-96 form-control">
                <input type="date" wire:model="check_out_date" placeholder="Check-out Date" required
                    class="rounded-3xl form-control">
                <h4 class="text-slate-600 font-semibold py-5 left-9 relative">Room Selection</h4>
                <select wire:model="hotel_id" wire:change="loadHotelDetails" class="form-control">
                    <option value="" class="text-gray-500 rounded-lg">Select Hotel</option>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                    @endforeach
                </select>
                <select wire:model="roomtype_id" wire:change="loadRoomPrice" class="form-control">
                    <option value="">Select Room</option>
                    @foreach ($roomTypes as $roomType)
                        <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                    @endforeach
                </select>

                <div
                    class=" py-10 bg-white rounded-2xl hover:bg-white hover:shadow-lg shadow-xl transition duration-300 relative top-7 ">
                    <!-- Price Per Night -->

                    <label for="price_per_night" class="font-bold text-black relative left-10">Price Per Night :
                    </label>
                    <input type="text" id="price_per_night" wire:model="price_per_night" readonly
                        class="rounded-xl border-none  focus:outline-none  relative left-10  ">
                    <span
                        class="text-black font-bold text-lg relative left-16 ">..........................................................................................................</span>
                    <h3 class="text-black font-bold text-xl relative top-4 left-10">Total Price :
                        <span>{{ $total_price }}
                            TND</span>
                    </h3>
                </div>



            </div>


        </div>


        <button type="submit"
            class="px-4 py-2 font-bold text-white rounded-full hover:bg-yellow-500 bg-violet-600 top-10 relative left-52">Submit
            Booking</button>

    </form>





    <style>
         
        .section_padding {
            padding: 100px 0;
        }

        section {
            position: relative;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        section {
            display: block;
            unicode-bidi: isolate;
        }

        @media (min-width: 768px) {

            .container,
            .container-md,
            .container-sm {
                max-width: 720px;
            }
        }

        @media (min-width: 576px) {

            .container,
            .container-sm {
                max-width: 540px;
            }
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

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y)* -1);
            margin-right: calc(var(--bs-gutter-x)* -.5);
            margin-left: calc(var(--bs-gutter-x)* -.5);
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x)* .5);
            padding-left: calc(var(--bs-gutter-x)* .5);
            margin-top: var(--bs-gutter-y);
        }

        .booking_tour_form {}

        .booking_tour_form h3 {
            border-bottom: 1px solid var(#8B3EEA);
            padding-bottom: 10px;
            display: inline-block;
            font-weight: 500;
            margin-bottom: 20px;
            position: relative;
            right: 150px;
            font-weight: bold
        }

        .heading_theme {
            border-bottom: 2px solid var(--main-color);
            padding-bottom: 10px;
            display: inline-block;
            font-weight: 500;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 24px;
            font-weight: 300;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }

        .h3,
        h3 {
            font-size: calc(1.3rem + .6vw);
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .booking_tour_form {
            position: relative;
            left: 50px;
            width: 650px;
        }

        .tour_booking_form_box {
            background: #FFFFFF;
            box-shadow: -4px -5px 14px rgb(0 0 0 / 8%), 5px 8px 16px rgb(0 0 0 / 8%);
            border-radius: 10px;
            padding: 20px 20px 20px 20px;
            position: relative;
            right: 350px;

        }

        option {
            font-weight: normal;
            display: block;
            padding-block-start: 0px;
            padding-block-end: 1px;
            min-block-size: 1.2em;
            padding-inline: 2px;
            white-space: nowrap;
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y)* -1);
            margin-right: calc(var(--bs-gutter-x)* -.5);
            margin-left: calc(var(--bs-gutter-x)* -.5);
        }

        #tour_bookking_form_item {
            padding-top: 25px;
        }

        .bg_input {
            background-color: #F3F6FD;
        }

        .form-control {
            height: 55px;
            border: 2px dashed #dddddd75;
            font-size: 16px;

        }

        .form-control {
            height: 50px;
            border: none;
            box-shadow: 0px 1px 13px 0px #0000000d;
            font-size: 16px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        input:not([type="image" i],
        [type="range" i],
        [type="checkbox" i],
        [type="radio" i]) {
            overflow-clip-margin: 0px !important;
            overflow: clip !important;
        }

        input[type="text" i] {
            padding-block: 1px;
            padding-inline: 2px;
        }

        input:not([type="file" i],
        [type="image" i],
        [type="checkbox" i],
        [type="radio" i]) {}

        input {
            font-style: ;
            font-variant-ligatures: ;
            font-variant-caps: ;
            font-variant-numeric: ;
            font-variant-east-asian: ;
            font-variant-alternates: ;
            font-variant-position: ;
            font-variant-emoji: ;
            font-weight: ;
            font-stretch: ;
            font-size: ;
            font-family: ;
            font-optical-sizing: ;
            font-size-adjust: ;
            font-kerning: ;
            font-feature-settings: ;
            font-variation-settings: ;
            text-rendering: auto;
            color: fieldtext;
            letter-spacing: normal;
            word-spacing: normal;
            line-height: normal;
            text-transform: none;
            text-indent: 0px;
            text-shadow: none;
            display: inline-block;
            text-align: start;
            appearance: auto;
            -webkit-rtl-ordering: logical;
            cursor: text;
            background-color: field;
            margin: 0em;
            padding: 1px 0px;
            border-width: 2px;
            border-style: inset;
            border-color: light-dark(rgb(118, 118, 118), rgb(133, 133, 133));
            border-image: initial;
            padding-block: 1px;
            padding-inline: 2px;
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y)* -1);
            margin-right: calc(var(--bs-gutter-x)* -.5);
            margin-left: calc(var(--bs-gutter-x)* -.5);
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y)* -1);
            margin-right: calc(var(--bs-gutter-x)* -.5);
            margin-left: calc(var(--bs-gutter-x)* -.5);
        }



        :root {
            --main-color: #8B3EEA;
            --white-color: #ffffff;
            --black-color: #2B2540;
            --black-color-opacity: #2b2540c4;
            --paragraph-color: #818090;
            --bg-color: #F3F6FD;
            --transition: .4s all ease-in-out;
        }

        :root {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        form {
            display: block;
            margin-top: 0em;
            unicode-bidi: isolate;
        }

        #tour_bookking_form_item .form-group {
            margin-bottom: 30px;
        }

        .bg_input {
            background-color: #F3F6FD;
        }

        .form-control {
            height: 55px;
            border: 2px dashed #dddddd75;
            font-size: 16px;
        }

        .form-control {
            height: 50px;
            border: none;
            box-shadow: 0px 1px 13px 0px #0000000d;
            font-size: 16px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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

        .write_spical_check {
            padding-top: 10px;
        }

        .form-check {
            display: block;
            min-height: 1.5rem;
            padding-left: 1.5em;
            margin-bottom: .125rem;
        }

        .form-check-input[type=checkbox] {
            border-radius: .25em;
        }

        .form-check .form-check-input {
            float: left;
            margin-left: -1.5em;
        }

        .form-check-input {
            width: 1em;
            height: 1em;
            margin-top: .25em;
            vertical-align: top;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            border: 1px solid rgba(0, 0, 0, .25);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }

        .form-check-label {
            width: 100%;
            position: relative;
            right: 350px;

        }

        label {
            display: inline-block;
        }

        .booking_tour_form_submit a {
            margin-top: 15px;

        }

        .booking_tour_form_submit {
            position: relative;
            right: 130px;
            bottom: 1200px;
        }

        .form-check-input {
            position: relative;
            right: 350px;
        }

        .btn_md {
            padding: 12px 35px;
            font-size: 18px;
        }

        .btn_theme {
            color: var(--white-color);
            background-color: var(--main-color);
            transition: var(--transition);
            box-shadow: none;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            z-index: 0;
            border: none;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            font-size: 16px;
            border-radius: 5px;
            box-shadow: none;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            z-index: 0;
        }



        a {
            text-decoration: none;
            -webkit-transition: all 0.3s ease-in-out 0.1s;
            transition: all 0.3s ease-in-out 0.1s;
            outline: 0 !important;
            color: var(--main-color);
        }

        a {
            color: #0d6efd;
            text-decoration: underline;
        }

        .tour_detail_right_sidebar {
            margin-bottom: 30px;
            position: relative;
            left: 350px;
            width: 550px;
            bottom: 900px;
        }

        .tour_detail_right_sidebar2 {
            margin-bottom: 30px;
            position: relative;
            right: 397px;
            top: 0px;
            width: 650px;
            bottom: 950px;
        }


        .tour_details_right_box_heading h3 {
            font-weight: bold;
            font-size: 35;
            border-bottom: 1px solid var(--main-color);
            padding-bottom: 10px;
            display: inline-block;
        }

        .valid_date_area {
            display: flex;
            align-items: center;
            padding-top: 25px;
        }

        .valid_date_area_one {
            padding-right: 40px;
        }

        .valid_date_area_one h5 {
            font-weight: 500;
            padding-bottom: 5px;
        }

        p:last-child {
            margin-bottom: 0;
        }

        p {
            font-size: 16px;
            line-height: 28px;
            color: var(--paragraph-color);
            font-weight: 400;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 0;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .tour_package_details_bar_list {
            padding-top: 20px;
        }

        .tour_package_details_bar_list h5 {
            font-weight: bolder;
            border-bottom: 1px solid var(--main-color);
            padding-bottom: 10px;
            display: inline-block;
        }

        .tour_package_details_bar_list h3 {
            font-weight: bold;
            border-top: 1px solid var(--main-color);
            padding-bottom: 10px;
            display: inline-block;
            font-size: 25px;
        }

        ul {
            padding: 0;
            margin: 0;
        }

        dl,
        ol,
        ul {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        ol,
        ul {
            padding-left: 2rem;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        ul {
            display: block;
            list-style-type: disc;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding-inline-start: 40px;
            unicode-bidi: isolate;
        }

        .tour_package_details_bar_list ul li {
            padding-top: 15px;
            color: var(--paragraph-color);
            display: flex;
            align-items: center;
        }

        ul li {
            list-style: none;
            padding: 0;
        }

        li {
            display: list-item;
            text-align: -webkit-match-parent;
            unicode-bidi: isolate;
        }

        ul li i {
            color: var(--black-color);
            font-size: 6px;
            padding-right: 7px;
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

        i {
            font-style: italic;
        }

        .tour_package_details_bar_price {
            padding-top: 20px;
        }

        .tour_package_details_bar_price h5 {
            font-weight: 500;
            border-bottom: 1px solid var(--main-color);
            padding-bottom: 10px;
            display: inline-block;
        }

        .tour_package_bar_price {
            display: flex;
            align-items: center;
            padding-top: 15px;
        }

        .tour_package_bar_price h6 {
            font-size: 16px;
            font-weight: 500;
        }

        .tour_package_bar_price h3 {
            padding-left: 10px;
            font-size: 22px;
            font-weight: 500;
            color: var(--main-color);
        }

        tour_package_bar_price h3 sub {
            color: var(--paragraph-color);
            font-weight: 400;
            bottom: 0;
            font-size: 14px;
        }

        sub {
            bottom: -.25em;
        }

        sub,
        sup {
            position: relative;
            font-size: .75em;
            line-height: 0;
            vertical-align: baseline;
        }

        .tour_detail_right_sidebar {
            margin-bottom: 30px;
        }

        .tour_details_right_boxed {
            background: #FFFFFF;
            box-shadow: -4px -5px 14px rgba(0, 0, 0, 0.08), 5px 8px 16px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            padding: 25px 20px 35px 20px;
        }


        .edit_date_form {
            padding-top: 20px;
        }

        .edit_date_form .form-control {
            border: 1px solid var(--black-color);
            margin-top: 10px;
        }

        .tour_package_details_bar_list {
            padding-top: 20px;
        }

        .tour_package_details_bar_list h5 {
            font-weight: 500;
            border-bottom: 1px solid var(--main-color);
            padding-bottom: 10px;
            display: inline-block;
        }

        .select_person_item {
            padding-top: 15px;
            padding-bottom: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .select_person_left h6 {
            position: relative;
            left: 20px;
            font-size: 16px;
            font-weight: bold;
        }

        .select_person_left p {
            position: relative;
            left: 20px;
            font-size: 14px;
            font-weight: 700;
        }

        .edit_person {
            text-align: right;
            padding-top: 15px;
        }

        .edit_person p {
            color: var(--main-color);
            cursor: pointer;
        }

        .tour_detail_right_sidebar {
            margin-bottom: 30px;
        }

        .tour_details_right_boxed {
            background: #FFFFFF;
            box-shadow: -4px -5px 14px rgba(0, 0, 0, 0.08), 5px 8px 16px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            padding: 25px 20px 35px 20px;
        }


        .coupon_code_area_booking {
            padding-top: 30px;
        }

        .coupon_code_submit {
            padding-top: 20px;
        }

        [type=button]:not(:disabled),
        [type=reset]:not(:disabled),
        [type=submit]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer;
        }

        .btn_md {
            padding: 12px 35px;
            font-size: 18px;
        }

        .btn_theme {
            color: var(--white-color);
            background-color: var(--main-color);
            transition: var(--transition);
            box-shadow: none;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            z-index: 0;
            border: none;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            font-size: 16px;
            border-radius: 5px;
            box-shadow: none;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            z-index: 0;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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

        button {
            appearance: auto;
            font-style: ;
            font-variant-ligatures: ;
            font-variant-caps: ;
            font-variant-numeric: ;
            font-variant-east-asian: ;
            font-variant-alternates: ;
            font-variant-position: ;
            font-variant-emoji: ;
            font-weight: ;
            font-stretch: ;
            font-size: ;
            font-family: ;
            font-optical-sizing: ;
            font-size-adjust: ;
            font-kerning: ;
            font-feature-settings: ;
            font-variation-settings: ;
            text-rendering: auto;
            color: buttontext;
            letter-spacing: normal;
            word-spacing: normal;
            line-height: normal;
            text-transform: none;
            text-indent: 0px;
            text-shadow: none;
            display: inline-block;
            text-align: center;
            align-items: flex-start;
            cursor: default;
            box-sizing: border-box;
            background-color: buttonface;
            margin: 0em;
            padding-block: 1px;
            padding-inline: 6px;
            border-width: 2px;
            border-style: outset;
            border-color: buttonborder;
            border-image: initial;
        }

        .btn_theme:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 580px;
            height: 550px;
            margin: auto;
            background: var(--black-color);
            border-radius: 50%;
            z-index: -1;
            -webkit-transform-origin: top center;
            transform-origin: top center;
            -webkit-transform: translateX(-50%) translateY(-5%) scale(.4);
            transform: translateX(-50%) translateY(-5%) scale(.4);
            transition: var(--transition);
        }

        .tour_detail_right_sidebar {
            margin-bottom: 30px;
        }

        .tour_details_right_boxed {
            background: #FFFFFF;
            box-shadow: -4px -5px 14px rgba(0, 0, 0, 0.08), 5px 8px 16px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            padding: 25px 20px 35px 20px;
        }

        .tour_booking_amount_area ul {
            padding-top: 15px;
        }

        *.tour_booking_amount_area ul li {
            display: flex;
            justify-content: space-between;
            padding-bottom: 6px;
            font-weight: 500;
            font-size: 16px;
        }

        .tour_booking_amount_area ul li:last-child {
            border-bottom: 1px solid #dadada;
        }

        .tour_bokking_subtotal_area {
            padding-top: 15px;
        }

        .tour_bokking_subtotal_area h6 {
            font-size: 16px;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            padding-left: 105px;
        }

        .coupon_add_area {
            padding-top: 15px;
            border-bottom: 1px solid #dadada;
            padding-bottom: 15px;
        }

        .coupon_add_area h6 {
            font-size: 16px;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
        }

        .remove_coupon_tour {
            font-size: 14px;
            font-style: italic;
            font-weight: 400 !important;
            color: var(--main-color);
            cursor: pointer;

        }

        .total_subtotal_booking h6 {
            font-size: 16px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;

        }



        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: var(--bs-font-sans-serif);
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        body {
            display: block;
            margin: 8px;
        }

        :root {
            --main-color: #8B3EEA;
            --white-color: #ffffff;
            --black-color: #2B2540;
            --black-color-opacity: #2b2540c4;
            --paragraph-color: #818090;
            --bg-color: #F3F6FD;
            --transition: .4s all ease-in-out;
        }

        :root {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
        }
    </style>
</div>
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
