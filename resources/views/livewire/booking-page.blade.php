<div>
    @include('livewire.partials.navbar')
    @vite('resources/css/booking.css')

    <title>{{ $title ?? 'Travel-App' }}</title>

    <div>
        <div class="container" style="max-width: 1388px; margin-top: 40px; padding-left: 0px; padding-right: 0px;">
            <div class="row">
                <div class="col-md-4">
                    <div class="row
                            ">
                        <h3
                            class="font-semibold text-lg border-b-2 border-border-gray-200 pb-2 pb  mt-4 text-violet-400">
                            {{ __('lang.Reservation Information') }}
                        </h3>

                        <div class=" bg-white shadow-2xl pt-2 ">
                            <div class="main-image mb-4">
                                @if ($room && $room->photos)
                                    <img src="{{ asset('storage/' . $room->photos[0]) }}" alt="{{ $room->code }} photo"
                                        class="object-cover img-fluid w-full h-full rounded-md
                                                    ">
                                @endif
                            </div>

                        </div>
                        <div class="bg-white shadow-2xl ">

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
                                    {{ $room->hotel->city->name }}, {{ $room->hotel->country->name }}
                                </span>

                                @foreach ($room->hotel->amenities->chunk(4) as $amenityChunk)
                                    <ul class="list-none m-0 p-2 flex flex-wrap gap-4 pb-2 pt-1">
                                        @foreach ($amenityChunk as $amenity)
                                            <li class="flex items-center gap-2  ml-2  ">
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
                                <div class="grid grid-cols-3 items-center gap-4 ml-16 mr-16   pb-0">
                                    <div class="col-md-12">

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
                                                class="text-center items-center justify-center w-56 relative   ml-2 bottom-2 text-violet-500 font-semibold text-base pl-2">
                                                {{ __('lang.N° of Guests :') }}
                                                <span class="text-sm  font-semibold text-gray-500 w-20">
                                                    <ul class="ml-1 ">
                                                        <li class="text-black">Adults :
                                                            {{ $adults }}
                                                        </li>
                                                        <li class="relative text-black left-1">Children :
                                                            {{ $children }}</li>
                                                        <li class="text-black">Infants :
                                                            {{ $infants }}
                                                        </li>
                                                    </ul>
                                                </span>

                                            </h5>
                                        </div>


                                    </div>

                                </div>
                                <div class="ml-2 mt-1">

                                    <div class=" ml-2">
                                        @if ($room)
                                            <h5 class="text font-bold text-gray-800">
                                                {{ __('lang.Selected Room') }}
                                            </h5>
                                            <p class="text-gray-500 font-semibold">{{ __('lang.Name :') }}
                                                <span class="text-gray-700">{{ ucfirst($room->name) }}</span>
                                            </p>
                                            @if ($typeroom)
                                                <p class="text-gray-500 p-2 font-semibold relative right-2 ">
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
                                            <p class="text-gray-500">{{ __('lang.No room selected yet.') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="ml-1 mt-2 bg-violet-100 h-20 border border-gray-200 rounded-md mb-4  ">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class=" pt-2   ml-4 text-2xl font-bold  ">
                                                {{ __('lang.Total Price :') }} <span
                                                    class="text-black font-semibold relative left-12 ">{{ __('lang.TND') }}
                                                    {{ $roomPrice }}
                                                    <!-- + $amenity->hotels->first()->pivot->price -->
                                                    </del>
                                                </span>
                                            </h5>
                                        </div>

                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-8">


                    <div class=" bg-white rounded-lg shadow-2xl  mb-5 pb-4 ">
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
                                            wire:model="name" class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 "
                                            required>
                                        <div>
                                            @error('name')
                                                <span class="error text-red-600"> <i
                                                        class="fas fa-exclamation-triangle"></i>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=" pt-2 pb-4 ml-5 " style="width: 350px">
                                        <label for="name" class="pb-2 font-semibold">{{ __('lang.Email address') }}
                                        </label>
                                        <input type="email" placeholder="{{ __('lang.Enter your email address') }}"
                                            wire:model="email" class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 "
                                            required>
                                        <div>
                                            @error('email')
                                                <span class="error text-red-600"><i
                                                        class="fas fa-exclamation-triangle"></i>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=" pb-4 ml-5 " style="width: 350px">
                                        <label for="name" class="pb-2 font-semibold">{{ __('lang.Phone number') }}
                                        </label>
                                        <input type="tel" placeholder="{{ __('lang.Enter your phone number') }}"
                                            wire:model="phone" class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200"
                                            required>
                                        <div>
                                            @error('phone')
                                                <span class="error text-red-600"><i class="fas fa-exclamation-triangle"></i>


                                                    {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div
                                    class=" border border-b-2 border-gray-200 pb-2 w-4/5 border-t-0 border-r-0 border-l-0 left-20  ">

                                </div>
                                <h3
                                    class="font-semibold  m-5 order border-b-2 border-gray-200 pb-2 w-28 border-t-0 border-r-0 border-l-0  text-black">
                                    {{ __('lang.Your address') }}
                                </h3>
                                <div class="grid grid-cols-2 sm:col-span-4 lg:col-span-2">


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
                                        <select wire:model="z" wire:change="getCities"
                                            class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200" required>
                                            <option value="" selected>Choose your country</option>
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
                                        <select wire:model="x" class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200"
                                            required>
                                            <option value="" selected>
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
                                    <div>
                                        <div class="pb-4 ml-5" style="width: 350px">

                                            <input type="text" id="address" wire:model="address"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200"
                                                placeholder="Complete address" required hidden>
                                            <div>
                                                @error('address')
                                                    <span class="error text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    @if ($amenities->isNotEmpty())

                                        <div class="relative top-2  left-7 ">
                                            <h3 class="relative top-3 pt-2 pb-2 font-semibold text-black">
                                                {{ __('lang.Add Amenities') }}
                                            </h3>
                                            <div class="  right-2 relative top-3 " style="width: 130px;">
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
                                                    <p class="relative left-full text-left pl-2 bottom-12 ">
                                                        {{ __('lang.Price :') }}
                                                        {{ $amenity->hotels->first()->pivot->price }}
                                                        {{ __('lang.TND') }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif










                                    <div class=" pb-4 ml-5 " style="width: 350px">
                                        <input type="date" placeholder="Complet address" wire:model="checkInDate"
                                            class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200  " hidden>
                                    </div>

                                    <div class=" pb-4 ml-5 " style="width: 350px">
                                        <input type="date" placeholder="Complet address" wire:model="checkOutDate"
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
                                <button type="submit" wire:click="bookNow" wire:loading.attr="disabled"
                                    class="btn mt-3 hover:bg-yellow-500 hover:font-bold font-medium text-white rounded-full
                                    bg-violet-600 no-underline transform transition duration-300 hover:scale-105 hover:shadow-lg w-32 relative left-3/4 ">
                                    <span wire:loading.remove wire:target="bookNow">
                                        {{ __('lang.Book now') }}
                                    </span>

                                    <span wire:loading wire:target="bookNow" class="inline-flex items-center">
                                        <svg aria-hidden="true" role="status"
                                            class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="#E5E7EB" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentColor" />
                                        </svg>
                                        {{ __('lang.Loading...') }}
                                    </span>
                                </button>
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
