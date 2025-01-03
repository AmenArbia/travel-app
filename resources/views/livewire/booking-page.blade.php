<div>
   
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
