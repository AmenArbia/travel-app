<div class="py-10 rounded-lg font-poppins bg-slate-100">
    <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
        <div class="flex flex-wrap mb-24 -mx-3">
            <div class="w-full pr-2 lg:w-1/4 lg:block">
                <div class="p-4 mb-5 bg-white border border-gray-200 shadow-xl rounded-xl dark:bg-white ">
<<<<<<< HEAD
                    <h2 class="text-2xl font-bold dark:text-violet-600">{{ __('lang.Room Type') }}</h2>
=======
                    <h2 class="text-2xl font-bold dark:text-violet-600">Room Type</h2>
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df

                    <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                    <ul>
                        @foreach ($types as $type)
                            <li class="mb-4">
                                <label for="{{ $type }}" class="flex items-center dark:text-gray-300">
                                    <input type="checkbox" wire:model.live='selected_types' id="{{ $type }}"
                                        value="{{ $type }}" class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">{{ ucfirst($type) }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <div class="p-4 mb-5 bg-white border border-gray-200 shadow-xl rounded-xl dark:bg-white ">
<<<<<<< HEAD
                        <h2 class="text-2xl font-bold dark:text-violet-600">{{ __('lang.Filter by Price') }}</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>

                        <div class="mb-4">
                            <label class="block mb-2 font-medium dark:text-black">{{ __('lang.Minimum Price') }}</label>
                            <input type="range" wire:model.live="selectedMinPrice" min="{{ $minPrice }}"
                                max="{{ $maxPrice }}" class="w-full cursor-pointer">
                            <div class="mt-2 text-sm text-gray-600 dark:text-black">
                                {{ $selectedMinPrice }} {{ __('lang.TND') }}
=======
                        <h2 class="text-2xl font-bold dark:text-violet-600">Filter by Price</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>

                        <div class="mb-4">
                            <label class="block mb-2 font-medium dark:text-black">Minimum Price</label>
                            <input type="range" wire:model="selectedMinPrice" min="{{ $minPrice }}"
                                max="{{ $maxPrice }}" class="w-full cursor-pointer">
                            <div class="mt-2 text-sm text-gray-600 dark:text-black">
                                Selected: {{ $selectedMinPrice }} TND
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                            </div>
                        </div>

                        <div class="mb-4">
<<<<<<< HEAD
                            <label
                                class="block mb-2 font-medium dark:text-black">{{ __('lang.Maximum Price') }}</label>
                            <input type="range" wire:model="selectedMaxPrice" min="{{ $minPrice }}"
                                max="{{ $maxPrice }}" class="w-full cursor-pointer">
                            <div class="mt-2 text-sm text-gray-600 dark:text-black">
                                {{ $selectedMaxPrice }} {{ __('lang.TND') }}
=======
                            <label class="block mb-2 font-medium dark:text-black">Maximum Price</label>
                            <input type="range" wire:model="selectedMaxPrice" min="{{ $minPrice }}"
                                max="{{ $maxPrice }}" class="w-full cursor-pointer">
                            <div class="mt-2 text-sm text-gray-600 dark:text-black">
                                Selected:{{ $selectedMaxPrice }} TND
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                            </div>
                        </div>

                        <button wire:click="applyPriceFilter"
                            class="px-4 py-2 font-bold text-white rounded hover:bg-yellow-500 bg-violet-600">
<<<<<<< HEAD
                            {{ __('lang.Apply Filter') }}
=======
                            Apply Filter
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                        </button>
                    </div>
                </div>



            </div>

            <div class="w-full px-3 lg:w-3/4">
                <div class="relative row left-80 bottom-10">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="py-5 text-5xl font-extrabold  text-violet-500 section_heading_center ">
<<<<<<< HEAD
                            <h2 class="font-bold">{{ $roomsCount }} {{ __('lang.Rooms found') }}</h2>
=======
                            <h2 class="font-bold">{{ $roomsCount }} Rooms found</h2>
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                        </div>
                    </div>
                </div>
                <div class="relative w-full px-4 bottom-12">
                    @foreach ($rooms as $room)
                        @foreach ($room->roomtype as $roomType)
                            <div class="flex flex-wrap " wire:key='{{ $room->id }}'>
                                <div class="w-full px-2 mb-6">
                                    <div
                                        class="flex overflow-hidden border rounded-lg shadow-lg cursor-pointer bg-white">
                                        <div class="w-1/2">
                                            @if ($roomType && $roomType->photos)
<<<<<<< HEAD
                                                <img src="{{ asset('storage/' . $roomType->photos[0]) }}"
                                                    alt="{{ $room->code }} photo" class="object-cover w-full h-full">
=======
                                                <img src="" alt="{{ $room->code }} photo"
                                                    class="object-cover w-full h-full">
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                                            @endif
                                        </div>
                                        <div class="flex flex-col justify-between w-3/4 p-4 bg-white">

                                            <div>
<<<<<<< HEAD
                                                <h3 class="mb-2 text-xl font-bold text-black">{{ __('lang.Room') }} :
=======
                                                <h3 class="mb-2 text-xl font-bold text-black">Room :
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                                                    {{ $room->code }}
                                                </h3>
                                                <p class="mt-2 text-gray-400">{{ $room->description }}</p>
                                            </div>

                                            <div class="mt-4">
                                                <span class="font-bold text-black">
<<<<<<< HEAD
                                                    {{ __('lang.Type room') }} : <span
=======
                                                    Type room : <span
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                                                        class="inline-block px-2 py-0.5 font-bold text-white rounded-full text-md {{ $this->getBadgeClass($room->type) }}">{{ $room->type }}</span>
                                                </span>
                                            </div>

                                            <div class="mt-4">
                                                <span class="font-bold text-black">
<<<<<<< HEAD
                                                    {{ __('lang.Capacity') }} : <span
=======
                                                    Capacity : <span
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                                                        class="inline-block px-2 py-0.2 text-white bg-blue-500 rounded-full text-md">
                                                        {{ $room->capacity }} <span
                                                            class="font-medium text-white">{{ $room->pax_capacity['pax_min'] ?? 'N/A' }}
                                                            - {{ $room->pax_capacity['pax_max'] ?? 'N/A' }}</span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="relative mt-4 left-80 bottom-44 ">
                                                @foreach ($room->roomtype as $typeRoom)
                                                    <div class="mt-4">
                                                        <span class="text-lg font-bold text-black py-2 ">
<<<<<<< HEAD
                                                            {{ __('lang.Price') }}: <span
=======
                                                            Price: <span
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                                                                class="inline-block px-2 py-0.2 text-yellow-500   bg-slate-500 rounded-full underline-offset-auto text-md">
                                                                {{ $typeRoom->price }} TND
                                                            </span>
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="relative border rounded-full bottom-4 w-36 left-80 ">
                                                <a href="{{ route('room.details.' . app()->getLocale(), $room->id) }}"
<<<<<<< HEAD
                                                    class="block text-center   py-1 rounded-full left-28 top-20px text-white bg-violet-600 hover:bg-yellow-500  font-bold btn btn-primary all">
                                                    {{ __('lang.Room Details') }}
=======
                                                    class="block text-center   py-1 rounded-full left-28 top-20px text-white bg-violet-600 hover:bg-yellow-500  font-bold btn btn-primary">
                                                    Check Details
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <!-- pagination start -->
                <div class="flex justify-end mt-6">
                    {{ $rooms->links() }}
                </div>
                <!-- pagination end -->
            </div>
        </div>
    </div>
</div>
