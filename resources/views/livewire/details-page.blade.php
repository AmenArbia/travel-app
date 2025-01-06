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
                <div class="border p-3 mb-3">


                    <form name="step1h" id="step1h" autocomplete="off" action="/hotels/inc/search-hotel.cfm"
                        method="get" class="custom-engine fv-form fv-form-bootstrap" novalidate="novalidate"
                        data-gtm-form-interact-id="1"><button type="submit" class="fv-hidden-submit"
                            style="display: none; width: 0px; height: 0px;">Vérifier la disponibilité</button>

                        <input type="hidden" name="source" id="source" value="">
                        <input type="hidden" name="hotelId" value="38201112">
                        <input type="hidden" name="destinationId" value="43">
                        <input type="hidden" name="rooms" id="rooms2" value="1">
                        <input type="hidden" name="token" value="028DB4DD0267B0D346EB9EB461FC93778E697BCE">

                        <div class="engine-fiche">
                            <div class="row pt-md-2">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div class="position-relative">
                                                <div class="form-group has-success">
                                                    <label for="arrDate" class="mb-2">Arrivée</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text bg-transparent"
                                                            id="basic-addon1 br-0"> <i
                                                                class="far fa-calendar-alt pe-1 text-success fa-lg"></i></span>
                                                        <input name="arrDate" id="arrDate1h" placeholder="jj/mm/aaaa"
                                                            value="07/01/2025" required=""
                                                            class="form-control arrDate2 bg-white bl-0 h-40 ps-0"
                                                            readonly="" data-fv-field="arrDate"
                                                            data-gtm-form-interact-field-id="2">
                                                    </div>
                                                    <small class="help-block" data-fv-validator="notEmpty"
                                                        data-fv-for="arrDate" data-fv-result="VALID"
                                                        style="display: none;">Ce champs est obligatoire</small><small
                                                        class="help-block" data-fv-validator="date"
                                                        data-fv-for="arrDate" data-fv-result="VALID"
                                                        style="display: none;">Date invalide</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="position-relative ">
                                                <div class="form-group has-success">
                                                    <label for="depDate" class="mb-2">Départ</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text bg-transparent br-0"
                                                            id="basic-addon1"> <i
                                                                class="far fa-calendar-alt pe-1  text-success fa-lg"></i></span>
                                                        <input name="depDate" id="depDate1h" value="08/01/2025"
                                                            required="" placeholder="jj/mm/aaaa"
                                                            class="form-control depDate2  bg-white bl-0 h-40 ps-0"
                                                            readonly="" data-fv-field="depDate"
                                                            data-gtm-form-interact-field-id="3">
                                                    </div>

                                                    <small class="help-block" data-fv-validator="notEmpty"
                                                        data-fv-for="depDate" data-fv-result="VALID"
                                                        style="display: none;">Ce champs est obligatoire</small><small
                                                        class="help-block" data-fv-validator="date"
                                                        data-fv-for="depDate" data-fv-result="VALID"
                                                        style="display: none;">Date invalide</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 ">

                                    <div class="position-relative border-left-warning">
                                        <div class="form-group">
                                            <label class="mb-2"> Chambre et occupation </label>
                                            <div class="bord-1 ">
                                                <span class="persons persons-v2">
                                                    <div class="text-left guests-select">
                                                        <div class="form-control totalhotel h-40">
                                                            <i class="far fa-user pe-1 text-success fa-lg"></i>
                                                            <span class="valRoomstshotel" title="Chambres">1</span> <i
                                                                class="txt-room" title="Chambres">chambre</i>,
                                                            <span class="valAdultshotel" title="Adultes">2</span> <i
                                                                class="txt-adt" title="Adultes">adultes</i>
                                                            <span class="valChildrenhotel" title="Enfants"></span> <i
                                                                class="txt-enf" title="Enfants"></i>
                                                            <span class="valInfantshotel" title="Lits bébé"></span> <i
                                                                class="txt-beb" title="Lits bébé"></i>
                                                            <i class="fas fa-chevron-down float-end"
                                                                title="Modifier occupation"
                                                                style="line-height: 24px;"></i>
                                                        </div>
                                                    </div>
                                                    <div style="display: none;" class="guests  animated fadeInUp">
                                                        <div
                                                            class="button-save out valider border-bottom mb-2 pb-2 d-flex ">
                                                            <span class="align-self-center">Sélection des chambres et
                                                                des passagers</span>
                                                            <span class="ico-close ms-auto" aria-hidden="true"></span>
                                                        </div>
                                                        <div class="rooms">

                                                            <div class="roomItem row ">
                                                                <div
                                                                    class="form-group room-lab text-primary col-12 mt-2">
                                                                    <label>Chambre 1 </label>
                                                                </div>
                                                                <div class="form-group adults col-4">
                                                                    <label class="text-dark">Adultes</label>
                                                                    <select class="form-control wide adultshotel"
                                                                        name="adults1" id="adults1h_1">
                                                                        <option value="0">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2" selected="">2
                                                                        </option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group children  col-4">
                                                                    <label>Enfants </label>
                                                                    <select class="form-control wide childrenhotel"
                                                                        name="children1" id="children1h_1">
                                                                        <option value="0" selected="">0
                                                                        </option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                    <span class="text-dark">(2-11 ans)</span>
                                                                </div>

                                                                <div class="form-group  col-4">
                                                                    <label>Lit(s) bébé</label>
                                                                    <select class="form-control wide infantshotel"
                                                                        name="infant1" id="infant1h_1">
                                                                        <option value="0" selected="">0
                                                                        </option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                    </select>
                                                                    <span class="text-dark">(inf à 2 ans)</span>
                                                                </div>

                                                                <div class="form-group agechild col-12 row">

                                                                    <div class="enfant-age form-group col-4"
                                                                        style="display: none;">
                                                                        <label for="age_1_1">Age enf.1</label>
                                                                        <select class="form-control" name="age1_1"
                                                                            id="age1h_1_1">
                                                                            <option value="" selected="">-?-
                                                                            </option>

                                                                            <option value="2">2 </option>

                                                                            <option value="3">3 </option>

                                                                            <option value="4">4 </option>

                                                                            <option value="5">5 </option>

                                                                            <option value="6">6 </option>

                                                                            <option value="7">7 </option>

                                                                            <option value="8">8 </option>

                                                                            <option value="9">9 </option>

                                                                            <option value="10">10 </option>

                                                                            <option value="11">11 </option>

                                                                        </select>
                                                                    </div>

                                                                    <div class="enfant-age form-group col-4"
                                                                        style="display: none;">
                                                                        <label for="age_2_1">Age enf.2</label>
                                                                        <select class="form-control" name="age2_1"
                                                                            id="age1h_2_1">
                                                                            <option value="" selected="">-?-
                                                                            </option>

                                                                            <option value="2">2 </option>

                                                                            <option value="3">3 </option>

                                                                            <option value="4">4 </option>

                                                                            <option value="5">5 </option>

                                                                            <option value="6">6 </option>

                                                                            <option value="7">7 </option>

                                                                            <option value="8">8 </option>

                                                                            <option value="9">9 </option>

                                                                            <option value="10">10 </option>

                                                                            <option value="11">11 </option>

                                                                        </select>
                                                                    </div>

                                                                    <div class="enfant-age form-group col-4"
                                                                        style="display: none;">
                                                                        <label for="age_3_1">Age enf.3</label>
                                                                        <select class="form-control" name="age3_1"
                                                                            id="age1h_3_1">
                                                                            <option value="" selected="">-?-
                                                                            </option>

                                                                            <option value="2">2 </option>

                                                                            <option value="3">3 </option>

                                                                            <option value="4">4 </option>

                                                                            <option value="5">5 </option>

                                                                            <option value="6">6 </option>

                                                                            <option value="7">7 </option>

                                                                            <option value="8">8 </option>

                                                                            <option value="9">9 </option>

                                                                            <option value="10">10 </option>

                                                                            <option value="11">11 </option>

                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="delete-room">
                                                                    <a href="javascript:void(0);"
                                                                        class="del  text-danger"
                                                                        style="display: none;"> <i
                                                                            class="far fa-trash-alt"></i> </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="search-footer pt-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-8 align-self-center">
                                                                    <a href="javascript:void(0)"
                                                                        class="add  add-room"><i
                                                                            class="fa fa-plus-circle pr-1"
                                                                            aria-hidden="true"></i> Ajouter une
                                                                        chambre</a>
                                                                </div>
                                                                <div class="col-md-4 text-end ">
                                                                    <button
                                                                        class="btn  btn-warning button-save valider v-out btn-block rounded-0 "
                                                                        type="button"> Valider</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-3 align-self-center pt-28-md">
                                    <button type="submit" class="btn btn-info btn-block">Vérifier la
                                        disponibilité</button>
                                </div>
                            </div>

                        </div>
                    </form>

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
