<div class="py-10 rounded-lg font-poppins bg-slate-100">
    <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
        <div class="flex flex-wrap mb-24 -mx-3">
            <div class="w-full pr-2 lg:w-1/4 lg:block">
                <div class="p-4 mb-5 bg-white border border-gray-200 shadow-xl rounded-xl">
                    <h2 class="text-2xl font-bold dark:text-violet-600">{{ __('lang.Hotel Type') }}</h2>

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

                <div class="p-4 mb-5 bg-white border border-gray-200 shadow-xl rounded-xl ">
                    <h2 class="text-2xl font-bold dark:text-violet-600">{{ __('lang.Hotels Status') }}s</h2>

                    <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                    <ul>
                        @foreach ($statuses as $status)
                            <li class="mb-4">
                                <label for="{{ $status }}" class="flex items-center text-gray-950">
                                    <input type="checkbox" wire:model.live='selected_status' id="{{ $status }}"
                                        value="{{ $status }}" class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">{{ ucfirst($status) }}</span>
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
                            <li class="mb-4">
                                <label for="amenity-{{ $amenityType }}" class="flex items-center dark:text-gray-300">
                                    <input type="checkbox" wire:model.live="selected_amenities"
                                        id="{{ $amenityType }}" value="{{ $amenityType }}" class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">{{ ucfirst($amenityType) }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>



                <!-- <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                    <h2 class="text-2xl font-bold dark:text-violet-600">Capacity</h2>
                    <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                    <div>
                        <input type="range" class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                            max="500" value="1" step="1">
                        <div class="flex justify-between ">
                            <span class="inline-block text-lg font-bold text-blue-400 "> 0</span>
                            <span class="inline-block text-lg font-bold text-blue-400 "> 500</span>
                        </div>
                    </div>
                </div>
            -->
            </div>
            <div class="w-full px-3 lg:w-3/4">
                <!--   <div class="px-3 mb-4">

                    <div class="flex items-center justify-between">
                        <select name="" id=""
                            class="block w-40 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                            <option value="">Sort by Capacity</option>
                            <option value="">Sort by Price</option>
                        </select>
                    </div>
                </div>-->


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
                                <div class="flex overflow-hidden border rounded-lg shadow-lg cursor-pointer">
                                    <div class="w-1/2">
                                        <img src="{{ url('storage/' . $hotel->image_cover) }}"
                                            alt="{{ $hotel->name }}" class="object-cover w-full h-full">
                                    </div>

                                    <div class="flex flex-col justify-between w-3/4 p-4 bg-slate-100">


                                        <div>
                                            <h3 class="mb-2 text-xl font-bold text-black">{{ __('lang.Hotel Name') }} :
                                                {{ $hotel->name }}
                                            </h3>
                                            <p class="text-sm text-black"><i
                                                    class="px-2 fa-solid fa-location-dot"></i>{{ implode(', ', [$hotel->country->name, $hotel->city->name]) }}
                                            </p>
                                            <p class="mt-2 text-gray-600">{{ __('lang.Description') }} :
                                                {{ $hotel->description }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <span class="font-bold text-black ">
                                                {{ __("lang.Type d'hotel") }} :
                                                <span
                                                    class="inline-block px-2 py-0.5 font-bold text-slate-100 rounded-full text-md
                                                    {{ $this->getBadgeClass($hotel->type_hotel) }}">
                                                    {{ $hotel->type_hotel }}
                                                </span>

                                            </span>
                                        </div>

                                        <div class="mt-4">
                                            <span class="font-bold text-black">
                                                {{ __('lang.Status') }} : <span
                                                    class="inline-block px-2 py-0.2  text-slate-100 bg-blue-500 rounded-full text-md">
                                                    {{ ucfirst($hotel->status) }}</span>
                                            </span>

                                        </div>

                                        <div class=" cruise_content_bottom_left">
                                            <ul>
                                                @foreach ($hotel->amenities as $amenity)
                                                    <li><i
                                                            class="
                                                @if ($amenity->type === 'Internet') fa-solid fa-wifi
                                                @elseif ($amenity->type === 'Kitchen') fa-solid fa-kitchen-set
                                                @elseif ($amenity->type === 'Bedroom') fa-solid fa-bed
                                                @elseif ($amenity->type === 'Living Area') fa-solid fa-couch
                                                @elseif ($amenity->type === 'Media and Technology') fa-brands fa-instagram
                                                @else fa-solid fa-circle-question @endif"></i>
                                                        {{ $amenity->type }}</li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <div class="mt-4">
                                            @if (!empty($hotel->slug))
                                                <a href="{{ route('details.slug.' . app()->getLocale(), $hotel->slug) }}"
                                                    class="relative block w-32 font-bold text-center text-zinc-500 hover:text-white rounded-full left-3/4 top-20px hover:bg-violet-500 btn btn-primary">
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

    <style>
        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y)* -1);
            margin-right: calc(var(--bs-gutter-x)* -.5);
            margin-left: calc(var(--bs-gutter-x)* -.5);
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        ul {
            padding: 0;
            margin: 0;
        }

        .cruise_content_bottom_left ul li {
            background: #f5f4f4;
            border: 1px solid #DDDDDD;
            border-radius: 20px;
            display: inline-block;
            padding: 3px 9px;
            font-size: 14px;
            color: var(--black-color);
            margin-right: 10px;
            position: relative;
            top: 10px
        }

        .cruise_content_bottom_wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 23px;
        }

        @media (min-width: 768px) {
            .col-md-12 {
                flex: 0 0 auto;
                width: 100%;
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
            width: 100%;
        }

        .section_heading_center {
            text-align: center;
            padding-bottom: 30px;
        }

        h2 {
            font-size: 30px;
        }




        .section_heading_center h2:after {
            content: "";
            position: absolute;
            width: 200px;
            height: 1px;
            background: #8B5CF6;
            transform: translate(-50%, 50%);
            bottom: 0;
            position: relative;
            top: 40px;


        }
    </style>
</div>
