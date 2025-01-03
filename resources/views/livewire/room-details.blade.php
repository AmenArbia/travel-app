<div id="tour_details_main" class="section_padding">
    <div class="container">
        <div class="relative row top-20">
            <div class="col-lg-8">
                <div class="tour_details_leftside_wrapper">
                    @if ($rooms)
                        <div class="relative tour_details_heading_wrapper top-24 ">
                            <div class="tour_details_top_heading">
                                <h2 class="relative font-bold top-5">Room code : {{ $room->code }}</h2>
                                <h3
                                    class="relative  inline-block px-2  font-bold text-white rounded-2xl text-md top-5
                                @if ($room->type == 'Standard ') bg-green-500
                                @elseif ($room->type == 'Deluxe ') bg-blue-500
                                @elseif ($room->type == 'Suite ') bg-yellow-500 @endif
                            ">
                                    {{ $room->type }} Room</h3>
                                <h5><i class="fas fa-map-marker-alt"></i>
                                    {{ implode(', ', [$hotel->country->name, $hotel->city->name]) }}
                                </h5>


                                <h6 class="relative text-base font-bold bottom-7 right-64">Rating : </h6>
                                <div class="relative bottom-7 left-5">
                                    @for ($i = 1; $i <= floor($room->rating); $i++)
                                        <i class="text-yellow-500 fa-solid fa-star"></i>
                                    @endfor
                                    @if ($room->rating - floor($room->rating) >= 0.5)
                                        <i class="text-yellow-500 fa-solid fa-star-half "></i>
                                    @endif
                                    @for ($i = ceil($room->rating); $i < 5; $i++)
                                        <i class="text-gray-400 fa-regular fa-star"></i>
                                    @endfor

                                </div>
                                <div class="relative left-28 bottom-9 ">
                                    <h6 class="relative py-4 text-xl font-bold bottom-8 -left-14 ">/ {{ $room->rating }}
                                    </h6>

                                </div>

                            </div>

                        </div>
                </div>

                <div class="tour_details_img_wrapper">


                    <div class="slider-container">
                        <div class="slider">
                            @foreach ($roomtype as $type)
                                @if ($type->photos && count($type->photos) > 0)
                                    @foreach ($type->photos as $index => $photo)
                                        @if ($index == $currentSlide)
                                            <div class="slide">
                                                <img class="w-96 rounded-3xl " src="{{ url('storage/' . $photo) }}"
                                                    alt="Room Image">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>

                        <div class="relative py-5 left-64">
                            <button wire:click="previousSlide"
                                class="px-6 py-2 font-bold text-white cursor-pointer rounded-3xl left-32 top-5 bg-violet-600 hover:bg-violet-700">Previous</button>
                            <button wire:click="nextSlide"
                                class="px-6 py-2 font-bold text-white cursor-pointer rounded-3xl left-40 top-5 bg-violet-600 hover:bg-violet-700">Next</button>
                        </div>
                    </div>

                    <div class="tour_details_boxed">
                        <h3 class="heading_theme">Description</h3>
                        <div class="tour_details_boxed_inner">
                            <p>
                                {{ $room->description }}
                            </p>
                            @foreach ($roomtype as $type)
                                <p class="font-bold">
                                    Room Capacity: {{ $type->room_capacity }}
                                </p>


                                <ul>
                                    <li class="font-bold text-violet-600"> <i class=" fa-solid fa-person font-lg"></i>
                                        Adults: <span
                                            class="font-medium text-black">{{ $type->room->adult_capacity['adult_min'] ?? 'N/A' }}
                                            -
                                            {{ $type->room->adult_capacity['adult_max'] ?? 'N/A' }}</span>
                                    </li>
                                    <li class="font-bold text-violet-600"><i class="fa-solid fa-child"></i> Children:
                                        <span
                                            class="font-medium text-black">{{ $type->room->children_capacity['children_max'] ?? 'N/A' }}
                                        </span>
                                    </li>
                                    <li class="font-bold text-violet-600"><i class="fa-solid fa-baby"></i> Infants:
                                        <span
                                            class="font-medium text-black">{{ $type->room->infants_capacity['infants_max'] ?? 'N/A' }}</span>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>

                    <div class="tour_details_boxed">
                        <h3 class="heading_theme">Room amenities</h3>
                        <div class="tour_details_boxed_inner">
                            <div class="room_details_facilities">
                                <div class="toru_details_top_bottom_item">

                                    @foreach ($amenity as $amenities)
                                        <div class="tour_details_top_bottom_text">
                                            <p><i
                                                    class="
                                            @if ($amenities->type === 'Internet') fa-solid fa-wifi
                                            @elseif ($amenities->type === 'Kitchen') fa-solid fa-kitchen-set
                                            @elseif ($amenities->type === 'Bedroom') fa-solid fa-bed
                                            @elseif ($amenities->type === 'Living Area') fa-solid fa-couch
                                            @elseif ($amenities->type === 'Media and Technology') fa-brands fa-instagram
                                            @else fa-solid fa-circle-question @endif"></i>
                                                {{ $amenities->type }}</p>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>


            <div class="col-lg-4">
                <div class="tour_details_right_sidebar_wrapper">
                    <div class="tour_detail_right_sidebar">
                        <div class="tour_details_right_boxed">
                            <div class=" tour_details_right_box_heading">
                                @foreach ($roomtype as $type)
                                    <h3 class="font-extrabold"> Price</h3>


                            </div>
                            <div class="tour_package_bar_price">
                                <h3>{{ $type->price }} TND<sub>/Per night</sub> </h3>
                            </div>
                            @endforeach
                            <div class="tour_package_details_bar_list">
                                <h5 class="font-bold">Hotel facilities</h5>
                                <ul>
                                    <li><i class="py-2 fas fa-circle"></i>Buffet breakfast as per the Itinerary</li>
                                    <li><i class="fas fa-circle"></i>Visit eight villages showcasing Polynesian
                                        culture
                                    </li>
                                    <li><i class="fas fa-circle"></i>Complimentary Camel safari, Bonfire,</li>
                                    <li><i class="fas fa-circle"></i>All toll tax, parking, fuel, and driver
                                        allowances
                                    </li>
                                    <li><i class="fas fa-circle"></i>Comfortable and hygienic vehicle</li>
                                </ul>
                            </div>
                            <a class="relative px-4 py-2 font-bold text-white cursor-pointer rounded-3xl left-40 top-5 bg-violet-600 hover:bg-violet-700"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                aria-controls="offcanvasRight"
                                href="{{ route('booking.' . app()->getLocale(), $room->id) }}">Book
                                Now</a>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .section_padding {
            padding: 100px;
            width: 49%;
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
            position: relative;

            bottom: 70px;
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        div {
            display: block;
            unicode-bidi: isolate;
        }

        body {
            padding: 0;
            margin: 0;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
        }



        .col-lg-8 {
            width: 750px;
        }


        .tour_details_heading_wrapper {
            align-items: center;
            border-radius: 10px;


        }

        .tour_details_top_heading {}

        h2 {
            font-size: 36px;
            font-weight: 500;
            line-height: 40px;
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

        @media (min-width: 1200px) {

            .h2,
            h2 {
                font-size: 2rem;
            }
        }

        .h2,
        h2 {
            font-size: calc(1.325rem + .9vw);
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h2 {
            display: block;
            font-size: 1.5em;
            margin-block-start: 0.83em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
        }

        .tour_details_top_heading h5 {
            font-size: 16px;
        }


        .tour_details_top_heading h6 {
            padding-top: 15px;
            font-size: 16px;
            position: relative;
            left: 20px;
        }

        h5 {
            font-size: 18px;
            font-weight: 400;
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

        .h5,
        h5 {
            font-size: 1.25rem;
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h5 {
            display: block;
            font-size: 0.83em;
            margin-block-start: 1.67em;
            margin-block-end: 1.67em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
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

        .tour_details_top_heading_right h4 {
            color: var(--main-color);
        }

        h4 {
            font-size: 20px;
            font-weight: 500;
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

        @media (min-width: 1200px) {

            .h4,
            h4 {
                font-size: 1.5rem;
            }
        }

        .h4,
        h4 {
            font-size: calc(1.275rem + .3vw);
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

        .tour_details_top_heading_right h4 {
            color: var(--main-color);
        }

        h4 {
            font-size: 20px;
            font-weight: 500;
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

        @media (min-width: 1200px) {

            .h4,
            h4 {
                font-size: 1.5rem;
            }
        }

        .h4,
        h4 {
            font-size: calc(1.275rem + .3vw);
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h4 {
            display: block;
            margin-block-start: 1.33em;
            margin-block-end: 1.33em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
        }

        .tour_details_top_heading_right h6 {
            font-size: 16px;
            color: var(--main-color);
            padding-top: 5px;
        }

        h6 {
            font-size: 14px;
            font-weight: 400;
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

        .h6,
        h6 {
            font-size: 1rem;
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h6 {
            display: block;
            font-size: 0.67em;
            margin-block-start: 2.33em;
            margin-block-end: 2.33em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
        }

        .tour_details_top_heading_right p {
            padding-top: 2px;
            font-size: 14px;
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        p {
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            unicode-bidi: isolate;
        }

        .tour_details_img_wrapper {
            margin-top: 40px;
            display: flex;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        div {
            display: block;
            unicode-bidi: isolate;
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

        element.style {
            opacity: 1;
            width: 3196px;
            transform: translate3d(-940px, 0px, 0px);
        }


        .tour_details_img_wrapper {
            margin-top: 40px;
            display: block;
        }

        .tour_details_boxed {
            background: #FFFFFF;
            box-shadow: -4px -5px 14px rgb(0 0 0 / 8%), 5px 8px 16px rgb(0 0 0 / 8%);
            border-radius: 10px;
            margin-top: 5px;
            width: 750px;
            position: relative;
            top: 50px;
        }

        .heading_theme {
            border-bottom: 1px solid var(--main-color);
            padding-bottom: 10px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 24px;
            font-weight: 300;
        }

        @media (min-width: 1200px) {

            .h3,
            h3 {
                font-size: 1.75rem;
            }
        }

        .tour_details_boxed_inner p {
            padding-bottom: 5px;
            font-weight: 500;
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        p {
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            unicode-bidi: isolate;
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



        .tour_details_boxed {
            background: #FFFFFF;
            box-shadow: -4px -5px 14px rgb(0 0 0 / 8%), 5px 8px 16px rgb(0 0 0 / 8%);
            border-radius: 10px;
            padding: 20px 20px;
            margin-top: 30px;
            position: relative;
            top: -25px;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x)* .5);
            padding-left: calc(var(--bs-gutter-x)* .5);
            margin-top: var(--bs-gutter-y);
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .tour_detail_right_sidebar {
            margin-bottom: 30px;
            position: relative;
            left: 780px;
            bottom: 1250px;
        }

        .tour_details_right_box_heading h3 {
            font-weight: bolder;
        }

        .tour_details_right_boxed {
            background: #FFFFFF;
            box-shadow: -4px -5px 14px rgba(0, 0, 0, 0.08), 5px 8px 16px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            padding: 25px 20px 35px 20px;
            top: 190px;
            position: relative;
        }

        .tour_details_right_box_heading h3 {
            font-weight: 500;
            font-size: 22px;
            border-bottom: 1px solid var(--main-color);
            padding-bottom: 10px;
            display: inline-block;
            font-weight: bolder;

        }

        h3 {
            font-size: 24px;
            font-weight: 300;
            font-weight: bolder
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h3 {
            display: block;
            font-size: 1.17em;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
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

        h6 {
            font-size: 14px;
            font-weight: 400;
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

        .h6,
        h6 {
            font-size: 1rem;
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h6 {
            display: block;
            font-size: 0.67em;
            margin-block-start: 2.33em;
            margin-block-end: 2.33em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
        }

        .tour_package_bar_price h3 {
            padding-left: 10px;
            font-size: 22px;
            font-weight: 500;
            color: var(--main-color);
            font-weight: bold;
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h3 {
            display: block;
            font-size: 1.17em;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
        }

        .tour_package_details_bar_list {
            padding-top: 20px;
        }

        .tour_package_details_bar_list h5 {
            font-weight: 500;
            border-bottom: 1px solid var(--main-color);
            padding-bottom: 10px;
            display: inline-block;
            font-weight: bold;
        }

        h5 {
            font-size: 18px;
            font-weight: 400;
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

        .h5,
        h5 {
            font-size: 1.25rem;
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

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h5 {
            display: block;
            font-size: 0.83em;
            margin-block-start: 1.67em;
            margin-block-end: 1.67em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
        }

        .tour_package_details_bar_list ul li {
            padding-top: 15px;
            color: var(--paragraph-color);
            display: flex;
            align-items: center;
            padding-right: 5px;
        }

        ul li {
            list-style: none;
            padding: 0;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        li {
            display: list-item;
            text-align: -webkit-match-parent;
            unicode-bidi: isolate;
        }

        ul {
            list-style-type: disc;
        }

        .tour_select_offer_bar_bottom button {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
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

        .w-100 {
            width: 100% !important;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: violet;
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


        .btn_theme:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 580px;
            height: 550px;
            margin: auto;

            border-radius: 50%;
            z-index: -1;
            -webkit-transform-origin: top center;
            transform-origin: top center;
            -webkit-transform: translateX(-50%) translateY(-5%) scale(.4);
            transform: translateX(-50%) translateY(-5%) scale(.4);
            transition: var(--transition);
        }

        /* Slider Container */
        .slider-container {
            width: 750px;
            overflow: hidden;
            position: relative;
        }

        /* Slider Track */
        .slider {
            display: flex;
            scroll-snap-type: x mandatory;
            overflow-x: auto;
            scroll-behavior: smooth;
            width: 100%;
        }

        /* Individual Slides */
        .slide {
            /* Each slide takes full width */
            scroll-snap-align: start;
            text-align: center;
            width: 100%;
        }

        .slide img {
            width: 100%;
            height: auto;
        }

        /* Slider Controls */
        .slider-controls {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        .slider-controls button {
            margin: 0 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .slider-controls button:hover {
            background-color: #0056b3;
        }
    </style>

</div>
