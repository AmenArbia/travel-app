<div>
    <div class="section_padding">
        <div class="container">
            <div>
                <div class="row relative top-10">
                    <div class="bg-white rounded-full shadow-3xl w-1/2 ml-20 max-h-max mt-20">

                        <div class="relative w-1/3 bg-white shadow-2xl bottom-12 rounded-lg pt-6 pr-5 pb-9 pl-5 mr-40">
                            <div class="box-title">
                                <h3
                                    class="font-semibold text-lg border-b-2 border-border-gray-200 pb-2  text-violet-400">
                                    Reservation Information
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
                                        Hotel : <span class=" font-bold "> {{ $room->hotel->name }}</span>
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
                                                    <p class="text-gray-500">{{ $amenity->type }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>

                                <div class="border border-gray-200 mt-2 rounded-md pb-2">
                                    <h5 class="ml-3 pt-4 text-gray-800 font-semibold">
                                        Reservation details
                                    </h5>
                                    <div
                                        class="grid grid-cols-3 items-center gap-4 ml-16 mr-16 border border-b-2 border-gray-200 border-l-0 border-r-0 border-t-0  pb-0">
                                        <div
                                            class="text-center flex flex-col items-center justify-center w-56 relative right-12 m-2">
                                            <h5 class="text-violet-500  font-semibold right-16 relative">Check in :
                                            </h5>
                                            <span
                                                class="text-gray-600 flex items-center justify-center w-30 pr-10   text-sm relative  inset-x-0 right-7">{{ \Carbon\Carbon::parse($checkInDate)->format('l, d F Y') }}</span>
                                        </div>

                                        <div class="h-full border-l border-gray-300 relative left-12 "></div>
                                        <div
                                            class=" text-center flex flex-col items-center justify-center relative w-56 right-10 bottom-1 m-2 ">
                                            <h5 class="text-violet-500 font-semibold relative right-16">Check out :
                                            </h5>
                                            <span
                                                class="text-gray-600 flex items-center justify-center w-30 pr-12   text-sm relative  inset-x-0 right-7">{{ \Carbon\Carbon::parse($checkOutDate)->format('l, d F Y') }}</span>

                                        </div>
                                        <div>
                                            <h5
                                                class="text-center items-center justify-center w-56 relative right-16 ml-2 bottom-2 text-violet-500 font-semibold text-base">
                                                Period of stay : <span class="text-sm  font-semibold text-gray-500  ">
                                                    {{ \Carbon\Carbon::parse($checkInDate)->diffInDays(\Carbon\Carbon::parse($checkOutDate)) }}
                                                    nights
                                                </span>

                                            </h5>

                                            <div>
                                                <h5
                                                    class="text-center items-center justify-center w-56 relative -left-24  ml-2 bottom-2 text-violet-500 font-semibold text-base pl-2">
                                                    N° of Guests : <span
                                                        class="text-sm  font-semibold text-gray-500">{{ $adults + $infants + $children }}</span>
                                                </h5>
                                            </div>
                                        </div>




                                    </div>
                                    <div class="ml-2 mt-1">

                                        <div class=" ml-2">
                                            @if ($room)
                                                <h5 class="text font-semibold text-gray-700">Selected Room
                                                </h5>
                                                <p class="text-gray-500 font-semibold">Name : <span
                                                        class="text-gray-400">{{ ucfirst($room->name) }}</span></p>
                                                @if ($typeroom)
                                                    <p class="text-gray-500 p-2 font-semibold ">
                                                        Type : <span
                                                            class=" inline-block px-2 py-0.4 font-bold text-white rounded-2xl text-md {{ $this->getBadgeClassRoom($typeroom->type) }}">
                                                            {{ $typeroom->type }}</span></p>
                                                @endif
                                            @else
                                                <p class="text-gray-500">No room selected yet.</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="ml-1 mt-2 bg-violet-100 h-20 border border-gray-200 rounded-md ">
                                    <h5 class="relative top-6  ml-4 text-2xl font-bold">
                                        Total Price : <span class="text-black font-semibold relative left-12 ">TND
                                            {{ $roomPrice }}/<del
                                                class="text-sm text-gray-500 relative top-1 decoration-red-600 decoration-2">
                                                {{ $room->price }} TND
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
                                    Enter your details
                                </h4>
                            </div>
                            <form method="POST" wire:submit.prevent="submit">
                                @csrf
                                <div class="  pb-2 mr-2 ml-2 mb-2  border border-b-2 border-gray-200   ">
                                    <div class="grid grid-cols-2 sm:col-span-4 lg:col-span-2">
                                        <div class=" pt-2 pb-4 ml-5 " style="width: 350px">
                                            <label for="name" class="pb-2 font-semibold">Full Name </label>
                                            <input type="text" placeholder="Enter your name" wire:model="name"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 " required>
                                            <div>
                                                @error('name')
                                                    <span class="error text-red-600"> <i
                                                            class="fas fa-exclamation-triangle"></i>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class=" pt-2 pb-4 ml-5 " style="width: 350px">
                                            <label for="name" class="pb-2 font-semibold">Email address </label>
                                            <input type="email" placeholder="Enter your email" wire:model="email"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200 " required>
                                            <div>
                                                @error('email')
                                                    <span class="error text-red-600"><i
                                                            class="fas fa-exclamation-triangle"></i>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class=" pb-4 ml-5 " style="width: 350px">
                                            <label for="name" class="pb-2 font-semibold">Phone number </label>
                                            <input type="tel" placeholder="Enter your phone number"
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
                                        Your address
                                    </h3>
                                    <div class="grid grid-cols-2 sm:col-span-4 lg:col-span-2">
                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <label for="address" class="pb-2 font-semibold">Address</label>
                                            <input type="text" id="address" wire:model="address"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200" required>
                                            <div>
                                                @error('address')
                                                    <span class="error text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <label for="address" class="pb-2 font-semibold">Street</label>
                                            <input type="text" id="address" wire:model="street"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200" required>
                                            <div>
                                                @error('address')
                                                    <span class="error text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="pb-4 ml-5" style="width: 350px">
                                            <label for="country" class="pb-2 font-semibold">Country/Region</label>
                                            <select wire:model="country"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200" required>
                                                <option value="" disabled selected>Choose your country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        {{ $country->id == $this->country ? 'selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
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
                                            <label for="city" class="pb-2 font-semibold">City</label>
                                            <select wire:model="city"
                                                class="w-80 pt-2 pl-2 pb-2 mt-1 border border-gray-200" required>
                                                <option value="" disabled selected>Choose your city</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ $city->id == $this->city ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
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
                                        Book now </button>
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

            <style>
                .section_padding {
                    padding: 100px 0;
                }

                .row {
                    --bs-gutter-x: 1.5rem;
                    --bs-gutter-y: 0;
                    display: flex;
                    flex-wrap: nowrap;
                    margin-top: calc(var(--bs-gutter-y)* -1);
                    margin-right: calc(var(--bs-gutter-x)* -.5);
                    margin-left: calc(var(--bs-gutter-x)* -.5);
                    width: 1450px;
                }

                .container {
                    width: 100%;
                }

                .room-details {
                    background-color: #f9f9f9;
                    border-radius: 8px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                .room-details h4 {
                    margin-bottom: 10px;
                }
            </style>
        </div>
    </div>
