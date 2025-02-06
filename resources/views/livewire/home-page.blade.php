<div>
    @include('livewire.partials.navbar')
    @vite('resources/css/hotels.css')

    <title>{{ $title ?? 'Travel-App' }}</title>

    <div class="container-fluid py-5 bg-light" style="padding-right: 0px; padding-left: 0px; width: 100%;">
        <div class="container mb-5">
            <div class="row ">
                <!-- Sidebar Filters (Left Column) -->
                <div class="col-lg-3 mt-16">

                    <div class="card shadow-lg mb-4 rounded-2xl">
                        <div class="card-body ">
                            <h2 class=" font-bold text-xl text-violet-700 ">{{ __('lang.Hotel Type') }}</h2>
                            <hr class="border-primary">
                            <ul class="list-unstyled mt-2">
                                @foreach ($types as $type)
                                    <li class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.live='selected_types' id="{{ $type }}"
                                                value="{{ $type }}">
                                            <label class="form-check-label" for="{{ $type }}">
                                                @if ($type === 'Hotel')
                                                    {{ __('lang.Hotel') }}
                                                @elseif ($type === 'Resort')
                                                    {{ __('lang.Resort') }}
                                                @elseif ($type === 'Guest House')
                                                    {{ __('lang.Guest House') }}
                                                @endif
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow-lg mb-4 rounded-2xl ">
                        <div class="card-body">
                            <h2 class="font-bold text-xl  text-violet-700">{{ __('lang.Hotels Status') }}</h2>
                            <hr class="border-primary">
                            <ul class="list-unstyled mt-2">
                                @foreach ($statuses as $status)
                                    <li class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.live='selected_status' id="{{ $status }}"
                                                value="{{ $status }}">
                                            <label class="form-check-label" for="{{ $status }}">
                                                @if ($status === 'actif')
                                                    {{ __('lang.Active') }}
                                                @elseif ($status === 'en maintenance')
                                                    {{ __('lang.On repair') }}
                                                @elseif ($status === 'fermé')
                                                    {{ __('lang.Closed') }}
                                                @else
                                                    {{ ucfirst($status) }}
                                                @endif
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow-lg mb-4 rounded-2xl">
                        <div class="card-body">
                            <h2 class="font-bold text-xl  text-violet-700">{{ __('lang.Hotel Amenities') }}</h2>
                            <hr class="border-primary">
                            <ul class="list-unstyled mt-2">
                                @foreach ($amenitiesTypes as $amenityType)
                                    <li class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.live="selected_amenities"
                                                id="amenity-{{ $amenityType->id }}" value="{{ $amenityType->title }}">
                                            <label class="form-check-label" for="amenity-{{ $amenityType->id }}">
                                                {{ ucfirst($amenityType->title) }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- Hotel Listings (Right Column) -->
                <div class="col-lg-9 ">
                    <div class="row mb-3">
                        <div class="col-12">

                            <h2 class="font-bold  text-violet-700  text-center">
                                {{ $hotelsCount }}
                                {{ __('lang.Hotels found') }}</h2>

                        </div>
                    </div>

                    <div class="row">

                        @foreach ($hotels as $hotel)
                            <div class="col-md-12 mb-4 " wire:key='{{ $hotel->id }}'>
                                <div class="card shadow-2xl h-100 rounded-3xl">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <img src="{{ url('storage/' . $hotel->image_cover) }}"
                                                alt="{{ $hotel->slug }}" class="card-img-top h-100 object-cover">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card-body">
                                                <h3 class="card-title text-lg font-bold">
                                                    {{ __('lang.Hotel Name') }} :
                                                    {{ $hotel->name }}</h3>
                                                <p class="card-text"><i class="fas fa-map-marker-alt"></i>
                                                    {{ implode(', ', [$hotel->country->name, $hotel->city->name]) }}
                                                </p>
                                                <p class="card-text font-bold mt-2 mb-2 ">
                                                    {{ __('lang.Description') }}
                                                    :
                                                    <span
                                                        class="font-normal">{{ Str::limit($hotel->description, 76, '...') }}</span>
                                                </p>

                                                <div class="mb-3">
                                                    <span class="font-bold">{{ __('lang.Hotel type') }} :</span>
                                                    <span
                                                        class="badge rounded-2xl  text-sm  {{ $this->getBadgeClass($hotel->type_hotel) }}">
                                                        @if ($hotel->type_hotel === 'Hotel')
                                                            {{ __('lang.Hotel') }}
                                                        @elseif ($hotel->type_hotel === 'Resort')
                                                            {{ __('lang.Resort') }}
                                                        @elseif ($hotel->type_hotel === 'Guest House')
                                                            {{ __('lang.Guest House') }}
                                                        @endif
                                                    </span>
                                                </div>

                                                <div>
                                                    <span class="font-bold ">{{ __('lang.Status') }}
                                                        :</span>
                                                    <span class="badge bg-primary  ">
                                                        @if ($hotel->status === 'actif')
                                                            {{ __('lang.Active') }}
                                                        @elseif($hotel->status === 'en maintenance')
                                                            {{ __('lang.On repair') }}
                                                        @elseif ($hotel->status === 'fermé')
                                                            {{ __('lang.Closed') }}
                                                        @endif
                                                    </span>
                                                </div>

                                                <div class="mb-2 mt-0">
                                                    <ul class="list-inline">
                                                        @foreach ($hotel->amenities as $amenity)
                                                            @if ($amenity->status === 'Active')
                                                                <ul class="list-inline-item">
                                                                    <i class="pl-2"> @svg($amenity->icon ?? 'heroicon-o-cog', ['class' => 'w-10 h-10 text-black p-2'])
                                                                    </i>
                                                                    {{ $amenity->title }}
                                                                </ul>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="mt-2">
                                                        @if ($hotel->roomtype->isNotEmpty() && $hotel->roomtype->min('price') > 0)
                                                            <span class="text-muted font-bold">
                                                                {{ __('lang.Price start from :') }}
                                                                <span class="text-yellow-600  font-bold text-lg ">
                                                                    {{ $hotel->roomtype->min('price') }}
                                                                    {{ __('lang.TND') }}
                                                                    <sub
                                                                        class="text-yellow-600 font-weight-bold">{{ __('lang./Per night') }}</sub>
                                                                </span>
                                                            </span>
                                                        @else
                                                            <div class="ml-2">
                                                                <span class="text-yellow-600 font-bold">
                                                                    {{ __('lang.No rooms available.') }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>


                                                    <div class="mt-2">
                                                        @if (!empty($hotel->slug))
                                                            <a href="{{ route('details.slug.' . app()->getLocale(), $hotel->slug) }}"
                                                                class="bg-violet-500 hover:bg-yellow-500 rounded-2xl btn btn-primary cursor-pointer outline-none  py-1 px-4  overflow-hidden whitespace-nowrap  z-0 border-none  leading-6   align-middle select-none transform transition duration-300 hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none active:scale-95  font-bold">
                                                                {{ __('lang.Check Details') }}
                                                            </a>
                                                        @else
                                                            <span class="btn btn-secondary disabled">
                                                                No Details Available
                                                            </span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end mt-4">
                        {{ $hotels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
