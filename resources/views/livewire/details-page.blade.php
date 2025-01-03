<div class="w-full ">
    <section class="overflow-hidden py-11 font-poppins bg-slate-100">
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="flex flex-wrap px-8 py-20 mx-auto drop-shadow-xl rounded-2xl sm:px-6 lg:px-8">
                <!-- Hotel Images Section -->
                <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{
                    mainImage: '{{ url('storage/' . $hotel->image_cover) }}',
                    photos: @js($photos),
                    currentIndex: 0,
                    roomAvailable: false,
                    showModal: true,
                }">
                    <div class="relative p-5 bg-white shadow-lg rounded-2xl bottom-10 right-3">
                        <div class="sticky top-0 overflow-hidden z-70">
                            <!-- Main Image -->
                            <div class="relative mb-6 lg:mb-10 lg:h-2/3">
                                <img :src="mainImage" alt="{{ $hotel->name }}"
                                    class="object-cover w-full rounded-2xl lg:h-full hover:border hover:border-violet-600 ">
                            </div>

                            <!-- Thumbnail Images -->
                            <div class="flex-wrap hidden md:flex">
                                @foreach ($photos as $index => $photo)
                                    <div class="w-1/2 p-2 sm:w-1/4">
                                        <img src="{{ url('storage/' . $photo->photos[0]) }}" alt="{{ $photo->caption }}"
                                            class="object-cover w-full cursor-pointer lg:h-20 hover:border hover:border-blue-500"
                                            x-on:click="mainImage = '{{ url('storage/' . $photo->photos[0]) }}'; currentIndex = {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Image Navigation Buttons -->
                            <div class="flex justify-between mt-4">
                                <!-- Previous Image -->
                                <button
                                    x-on:click="currentIndex = (currentIndex - 1 + photos.length + 1) % (photos.length + 1);
                                          mainImage = currentIndex === 0 ? '{{ url('storage/' . $hotel->image_cover) }}' : '{{ url('storage') }}/' + photos[currentIndex - 1].photos[0]"
                                    class="px-4 py-2 font-bold text-white rounded-full bg-violet-500 hover:bg-yellow-600">
                                    {{ __('lang.Previous') }}
                                </button>

                                <!-- Next Image -->
                                <button
                                    x-on:click="currentIndex = (currentIndex + 1) % (photos.length + 1);
                                          mainImage = currentIndex === 0 ? '{{ url('storage/' . $hotel->image_cover) }}' : '{{ url('storage') }}/' + photos[currentIndex - 1].photos[0]"
                                    class="px-4 py-2 font-bold text-white rounded-full bg-violet-500 hover:bg-yellow-600 ">
                                    {{ __('lang.Next') }}
                                </button>
                            </div>
                        </div>
                    </div>

                </div>



                <!-- Hotel Details Section -->
                <div class="w-full px-4 md:w-1/2">
                    <div class="relative p-5 bg-white shadow-lg rounded-xl lg:pl-20 left-7 bottom-10">
                        <div class="mb-8">
                            @if ($hotel)
                                <h2
                                    class="relative max-w-xl mb-6 text-2xl font-bold text-violet-700 md:text-4xl left-10 hover:text-yellow-600">
                                    {{ __('lang.Hotel Name') }} : {{ $hotel->name }}
                                </h2>
                                <p class="relative max-w-md font-bold text-violet-600 right-10">
                                    <li class="relative max-w-md font-bold text-violet-600 right-10">
                                        {{ __('lang.Description') }} : <span class="font-normal text-black">
                                            {{ $hotel->description }}</span>

                                    </li>
                                </p>
                                <p class="inline-block mb-6 text-4xl font-bold text-gray-700 dark:text-gray-400">
                                    <span></span>
                                </p>
                                <ul class="pl-6 list-disc">
                                    <li class="relative font-bold text-violet-600 right-10">
                                        {{ __("lang.Type d'hotel") }} :

                                        <span
                                            class="inline-block px-2 py-0.3 font-bold text-white rounded-2xl text-md
                                             {{ $this->getBadgeClassHotel($hotel->type_hotel) }}">
                                            {{ $hotel->type_hotel }}</span>
                                    </li>
                                    <li class="relative font-bold text-violet-600 right-10">{{ __('lang.Location') }} :
                                        <i class="px-1 text-yellow-600 fa-solid fa-location-dot"></i><span
                                            class="font-medium text-black">
                                            {{ $hotel->city->name }}, {{ $hotel->country->name }} </span>
                                    </li>
                                    <li class="relative font-bold text-violet-600 right-10 ">Status: <span
                                            class="font-medium text-black ">{{ ucfirst($hotel->status) }} </span> </li>
                                </ul>
                            @else
                                <p class="text-red-500">Hotel not found.</p>
                            @endif
                        </div>



                        <!-- Amenities Section -->
                        <div class="mb-8">
                            <h3 class="relative text-lg font-bold text-violet-600 right-10">{{ __('lang.Facilities') }}
                                :</h3>
                            <ul class="pl-6 list-disc">
                                @foreach ($hotel->amenities as $amenity)
                                    <li class="relative font-medium text-black right-10 ">{{ $amenity->type }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Call-to-Action -->
                        <a href="#related-rooms">
                            <div class="relative flex flex-wrap items-center gap-4 left-16">
                                <button wire:click="toggleRoomAvailability" wire:target="toggleRoomAvailability"
                                    class="w-full p-3 font-bold text-white rounded-full lg:w-1/2 hover:bg-yellow-600 bg-violet-600">
                                    {{ __('lang.Room check') }}
                                </button>
                            </div>
                        </a>


                    </div>

                </div>

                <!-- Room Availble -->
                <div class="flex flex-col items-center">
                    <div id="related-rooms">
                        @if ($roomAvailable)
                            <h2 class="flex flex-col items-center py-2 mb-4 text-4xl font-extrabold text-gray-800 ">
                                {{ __('lang.Related Rooms') }}
                            </h2>

                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3 lg:grid-cols-3 ">
                                @if ($roomAvailable && $roomtype->isNotEmpty())
                                    @foreach ($roomtype as $type)
                                        <div class="p-4 bg-white rounded-lg shadow-lg">
                                            <img src="{{ asset('storage/' . (is_array($type->photos) ? $type->photos[0] : $type->photos)) }}"
                                                alt="{{ $type->name }}"
                                                class="object-cover w-full h-40 mb-4 rounded-md ">

                                            <h3 class="text-xl font-bold text-black-600">{{ $type->name }}</h3>
                                            <p class="text-gray-700">{{ Str::limit($type->description, 50) }}</p>
                                            <ul class="py-3 pl-6 list-disc">
                                                @if ($type->room)
                                                    <li class="font-bold text-violet-600">
                                                        {{ __('lang.Type') }} :
                                                        <span
                                                            class="inline-block px-2 py-0.4 font-bold text-white rounded-2xl text-md
                                                            @if ($type->room->type === 'Standard ') bg-green-500
                                                            @elseif ($type->room->type === 'Deluxe ') bg-blue-500
                                                            @elseif ($type->room->type === 'Suite ') bg-yellow-500 @endif">
                                                            {{ $type->room->type ?? 'N/A' }}
                                                        </span>
                                                    </li>

                                                    <li class="font-bold text-violet-600">
                                                        {{ __('lang.Room Capacity') }}:
                                                        <ul>
                                                            <li class="text-violet-400">{{ __('lang.Adults') }}: <span
                                                                    class="font-medium text-black">{{ $type->room->adult_capacity['adult_min'] ?? 'N/A' }}
                                                                    -
                                                                    {{ $type->room->adult_capacity['adult_max'] ?? 'N/A' }}</span>
                                                            </li>
                                                            <li class="text-violet-400">{{ __('lang.Children') }}:
                                                                <span
                                                                    class="font-medium text-black">{{ $type->room->children_capacity['children_max'] ?? 'N/A' }}
                                                                </span>
                                                            </li>
                                                            <li class="text-violet-400 ">{{ __('lang.Infants') }}:
                                                                <span
                                                                    class="font-medium text-black">{{ $type->room->infants_capacity['infants_max'] ?? 'N/A' }}</span>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="py-2 font-bold text-yellow-600">{{ __('lang.Price') }}:
                                                        <span class="font-bold text-black">
                                                            <span class="text-lg font-bold text-black"> TND
                                                                {{ $type->price }}
                                                                <span
                                                                    class="text-sm font-bold text-yellow-500 underline">
                                                                    {{ __('lang./per
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                night') }}</span>
                                                            </span>
                                                        </span>
                                                    </li>
                                                @else
                                                    <li class="text-gray-500">No room information available for this
                                                        type.</li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endforeach
                                @else
                                @endif
                            </div>
                        @endif
                    </div>

                </div>
                <!-- Related Hotels -->
                <div class="py-2">
                    <h2 class="flex flex-col items-center py-2 mb-4 text-4xl font-extrabold text-gray-800 ">
                        {{ __('lang.Related Hotels') }}</h2>
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse ($relatedHotels as $relatedHotel)
                            <div class="p-4 bg-white rounded-lg shadow-lg">
                                <img src="{{ asset('storage/' . $relatedHotel->image_cover) }}"
                                    alt="{{ $relatedHotel->name }}" class="object-cover w-full h-40 mb-4 rounded-md">
                                <h3 class="text-xl font-bold text-gray-800">{{ $relatedHotel->name }}</h3>
                                <p class="text-gray-500">{{ Str::limit($relatedHotel->description, 20) }}</p>
                                <div class="py-3 mt-2">
                                    <span
                                        class="inline-block px-2 py-0.4 font-bold text-white rounded-2xl text-md
                                           {{ $this->getBadgeClassHotel($relatedHotel->type_hotel) }} ">
                                        {{ $relatedHotel->type_hotel }}
                                    </span>
                                </div>

                                <button wire:click="toggleRoomAvailability"
                                    class="w-full font-bold text-white rounded-full lg:w-2/4 hover:bg-yellow-600 bg-violet-600"><a
                                        href="{{ route('details.slug.' . app()->getLocale(), $relatedHotel->slug) }}"
                                        class="text-white underline-offset-4">{{ __('lang.View Details') }}</a>
                                </button>
                            </div>
                        @empty
                            <p class="text-gray-500">{{ __('lang.No related hotels found.') }}</p>
                        @endforelse

                    </div>

                </div>


    </section>

</div>
