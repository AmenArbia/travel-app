<div>
    @include('livewire.partials.navbar')
    @vite('resources/css/hotels.css')

    <title>{{ $title ?? 'Travel-App' }}</title>

    <div class="py-10 rounded-lg font-poppins bg-slate-100">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <div class="w-full pr-2 lg:w-1/4 lg:block relative top-16">
                    <div class="p-4 mb-5 bg-white border border-gray-200 shadow-xl rounded-xl">
                        <h2 class="text-2xl font-bold dark:text-violet-600">{{ __('lang.Hotel Type') }}</h2>

                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            @foreach ($types as $type)
                                <li class="mb-4">
                                    <label for="{{ $type }}" class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" wire:model.live='selected_types' id="{{ $type }}"
                                            value="{{ $type }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg dark:text-gray-400">
                                            @if ($type === 'Hotel')
                                                {{ __('lang.Hotel') }}
                                            @elseif ($type === 'Resort')
                                                {{ __('lang.Resort') }}
                                            @elseif ($type === 'Guest House')
                                                {{ __('lang.Guest House') }}
                                            @endif
                                        </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="p-4 mb-5 bg-white border border-gray-200 shadow-xl rounded-xl ">
                        <h2 class="text-2xl font-bold dark:text-violet-600">{{ __('lang.Hotels Status') }}</h2>

                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            @foreach ($statuses as $status)
                                <li class="mb-4">
                                    <label for="{{ $status }}" class="flex items-center text-gray-950">
                                        <input type="checkbox" wire:model.live='selected_status'
                                            id="{{ $status }}" value="{{ $status }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg dark:text-gray-400">
                                            @if ($status === 'actif')
                                                {{ __('lang.Active') }}
                                            @elseif ($status === 'en maintenance')
                                                {{ __('lang.On repair') }}
                                            @elseif ($status === 'fermé')
                                                {{ __('lang.Closed') }}
                                            @else
                                                {{ ucfirst($status) }}
                                            @endif
                                        </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="p-4 mb-5 bg-white border border-gray-200 shadow-xl rounded-xl">
                        <h2 class="text-2xl font-bold dark:text-violet-600">{{ __('lang.Hotel Amenities') }}</h2>

                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-violet-600"></div>

                        <ul>
                            @foreach ($amenitiesTypes as $amenityType)
                                <li class="mb-4 cursor-pointer"
                                    wire:click="selected_amenities('{{ $amenityType->title }}')">
                                    <label for="amenity-{{ $amenityType->id }}"
                                        class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" wire:model.live="selected_amenities"
                                            id="amenity-{{ $amenityType->id }}" value="{{ $amenityType->title }}"
                                            class="w-4 h-4 mr-2">
                                        <span class="text-lg dark:text-gray-400">
                                            {{ ucfirst($amenityType->title) }}
                                        </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>





                </div>
                <div class="w-full px-3 lg:w-3/4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="font-extrabold  text-violet-500 section_heading_center ">
                                <h2 class="text-4xl font-bold">{{ $hotelsCount }} {{ __('lang.Hotels found') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4">
                        @foreach ($hotels as $hotel)
                            <div class="flex flex-wrap " wire:key='{{ $hotel->id }}'>
                                <div class="w-full px-2 mb-6 ">
                                    <div class="flex overflow-hidden border rounded-lg shadow-lg ">
                                        <div class="w-1/2  max-h-68 ">
                                            <img src="{{ url('storage/' . $hotel->image_cover) }}"
                                                alt="{{ $hotel->slug }}" class="object-cover w-full h-full rounded-">
                                        </div>

                                        <div class="flex flex-col justify-between w-3/4 p-4 bg-white shadow-2xl">


                                            <div>
                                                <h3 class="mb-2 text-xl font-bold text-black">
                                                    {{ __('lang.Hotel Name') }} :
                                                    {{ $hotel->name }}
                                                </h3>

                                                <p class="text-sm text-black"><i
                                                        class="px-2 fa-solid fa-location-dot"></i>{{ implode(', ', [$hotel->country->name, $hotel->city->name]) }}
                                                </p>
                                                <p class="mt-2 text-gray-600">{{ __('lang.Description') }} :
                                                    {{ Str::limit($hotel->description, 50, '...') }}</p>
                                            </div>
                                            <div class="mt-2">
                                                <span class="font-bold text-black ">
                                                    {{ __('lang.Hotel type') }} :
                                                    <span
                                                        class="inline-block px-2 py-0.5 font-bold text-slate-100 rounded-full text-md
                                                        {{ $this->getBadgeClass($hotel->type_hotel) }}">
                                                        @if ($hotel->type_hotel === 'Hotel')
                                                            {{ __('lang.Hotel') }}
                                                        @elseif ($hotel->type_hotel === 'Resort')
                                                            {{ __('lang.Resort') }}
                                                        @elseif ($hotel->type_hotel === 'Guest House')
                                                            {{ __('lang.Guest House') }}
                                                        @endif
                                                    </span>

                                                </span>
                                            </div>

                                            <div class="mt-2">
                                                <span class="font-bold text-black">
                                                    {{ __('lang.Status') }} : <span
                                                        class="inline-block px-2 py-0.2  text-slate-100 bg-blue-500 rounded-full text-md
                                                       ">
                                                        @if ($hotel->status === 'actif')
                                                            {{ __('lang.Active') }}
                                                        @elseif($hotel->status === 'en maintenance')
                                                            {{ __('lang.On repair') }}
                                                        @elseif ($hotel->status === 'fermé')
                                                            {{ __('lang.Closed') }}
                                                        @endif

                                                    </span>
                                                </span>

                                            </div>

                                            <div class="cruise_content_bottom_left mb-2 mt-2">
                                                <ul>
                                                    @foreach ($hotel->amenities as $amenity)
                                                        @if ($amenity->status === 'Active')
                                                            <li class="m-1">
                                                                <i
                                                                    class="
                                                                @switch($amenity->title)
                                                                    @case('Internet') fa-solid fa-wifi @break
                                                                    @case('Kitchen') fa-solid fa-kitchen-set @break
                                                                    @case('Bedroom') fa-solid fa-bed @break
                                                                    @case('Living Area') fa-solid fa-couch @break
                                                                    @case('Media and Technology') fa-brands fa-instagram @break
                                                                    @default fa-solid fa-circle-question
                                                                @endswitch
                                                            "></i>

                                                                {{ $amenity->title }}
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </div>

                                            <div class="mt-6 ">
                                                @if ($hotel)
                                                    <div class="relative">
                                                        @if ($hotel->roomtype->isNotEmpty() && $hotel->roomtype->min('price') > 0)
                                                            <span class="text-gray-500 font-bold">
                                                                {{ __('lang.Price start from :') }}
                                                                <span class="text-yellow-600 font-bold text-xl">
                                                                    {{ $hotel->roomtype->min('price') }}
                                                                    {{ __('lang.TND') }}
                                                                </span>
                                                                <sub class="text-yellow-600 font-bold">
                                                                    {{ __('lang./Per night') }}
                                                                </sub>
                                                            </span>
                                                        @else
                                                            <span class="text-yellow-600 font-bold relative left-40">
                                                                {{ __('lang.No Price Available') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endif



                                                @if (!empty($hotel->slug))
                                                    <a href="{{ route('details.slug.' . app()->getLocale(), $hotel->slug) }}"
                                                        class="relative block w-32   text-center text-white hover:text-white rounded-2xl left-3/4 top-24px  no-underline bg-violet-500 hover:bg-yellow-500 btn btn-primary cursor-pointer outline-none  py-1 px-4  overflow-hidden whitespace-nowrap  z-0 border-none  leading-6   align-middle select-none transform transition duration-300 hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none active:scale-95 h-8 font-bold">
                                                        {{ __('lang.Check Details') }}
                                                    </a>
                                                @else
                                                    <span
                                                        class="block px-4 py-2 text-center text-blacke bg-gray-500 rounded">
                                                        No Details Available
                                                    </span>
                                                @endif
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <!-- pagination start -->
                    <div class="flex justify-end mt-6">
                        {{ $hotels->links() }}
                    </div>

                    <!-- pagination end -->
                </div>
            </div>
        </div>


    </div>

</div>
