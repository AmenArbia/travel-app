<div>
<<<<<<< HEAD
    @vite('resources/css/navbar.css')


    <div class="static flex items-center justify-between px-4 py-2  navbar   bg-violet-400">
=======
    <div class="static flex items-center justify-between px-4 py-2 bg-violet-600 navbar">
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
        <!-- Logo and Travel-Shaper Text -->
        <div class="relative flex items-center navbar-brand">
            <svg fill="none" height="36" viewBox="0 0 32 32" width="36" class="text-white">
                <path clip-rule="evenodd"
                    d="M17.6482 10.1305L15.8785 7.02583L7.02979 22.5499H10.5278L17.6482 10.1305ZM19.8798 14.0457L18.11 17.1983L19.394 19.4511H16.8453L15.1056 22.5499H24.7272L19.8798 14.0457Z"
                    fill="currentColor" fill-rule="evenodd" />
            </svg>
<<<<<<< HEAD
            <p class="ml-2 font-bold text-white"><a
                    href="/"class="font-semibold text-white navbar-item text-foreground right-3  no-underline hover:text-yellow-600 relative  ">{{ __('lang.Travel-Shaper') }}</a>
            </p>

        </div>

        <!-- Navbar Links -->
        <div class="relative flex items-center gap-24
         right-16 " style="">
            <a href="/"
                class="font-semibold text-white navbar-item text-foreground right-16 hover:text-yellow-600 no-underline "><i
                    class="fa-solid fa-house"></i></a>
            <a href="/hotels"
                class="font-semibold text-white navbar-item is-active text-primary hover:text-yellow-600 no-underline"
                aria-current="page"><i class="fa-solid fa-hotel pr-1"></i>{{ __('lang.Hotels') }}</a>
            <a href="/booking-details"
                class="font-semibold text-white navbar-item is-active text-primary hover:text-yellow-600 no-underline "
                aria-current="page"><i class="fa-solid fa-file-circle-check pr-1"></i>{{ __('lang.Booking') }}</a>
=======
            <p class="ml-2 font-bold text-white">Travel-Shaper</p>
        </div>

        <!-- Navbar Links -->
        <div class="relative flex items-center gap-10 right-16">
            <a href="/" class="font-semibold text-white navbar-item text-foreground right-16">Home</a>
            <a href="/home" class="font-semibold text-white navbar-item is-active text-primary"
                aria-current="page">Hotels</a>
            <a href="/room" class="font-semibold text-white navbar-item is-active text-primary"
                aria-current="page">Rooms</a>
            <a href="/booking" class="font-semibold text-white navbar-item is-active text-primary"
                aria-current="page">Booking</a>
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
        </div>


        <div>
<<<<<<< HEAD
            @php
                $currentLocale = app()->getLocale();
                $otherLocale = $currentLocale === 'ar' ? 'en' : 'ar';
                $currentUrl = url()->current();

                if ($currentLocale === 'ar') {
                    $translatedUrl = preg_replace('/^.*\/ar(\/|$)/', "$1", $currentUrl);
                    $translatedUrl = url($translatedUrl);
                } else {
                    $translatedUrl = url("/$otherLocale") . str_replace(url('/'), '', $currentUrl);
                }
            @endphp

            <a href="{{ $translatedUrl }}"
                class="font-bold text-white navbar-item is-active hover:text-yellow-600 text-primary no-underline">
                {{ $otherLocale === 'en' ? 'English' : 'العربية' }}
            </a>
        </div>



    </div>


    <section id="common_banner">
        <div class="background-blur"></div>
        <div class="content-container">
            <h3 class="text-violet-800 font-bold text-5xl pt-3 rounded-full  " style="background: #ffffff4d;">
                <a href="/" class="text-violet-800 font-bold p-5 rounded-md no-underline relative">
                    {{ __('lang.Travel Shaper') }}
                </a>
                <div class="relative left-48 mt-2">
                    <nav class="flex mb-1" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-1 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="/"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                    </svg>
                                    {{ __('lang.Home') }}
                                </a>
                            </li>

                            @php
                                $segments = Request::segments();
                                $url = '';
                                $segments = array_filter($segments, function ($segment) {
                                    return !in_array($segment, ['ar', 'en']);
                                });
                            @endphp

                            @foreach ($segments as $index => $segment)
                                @php
                                    $url = "{$url}/{$segment}";
                                    $isLast = $loop->last;
                                @endphp

                                <li>
                                    <div class="flex items-center">
                                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>

                                        @if (!$isLast)
                                            <a href="{{ url($url) }}"
                                                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                                {{ ucfirst(str_replace('-', ' ', $segment)) }}
                                            </a>
                                        @else
                                            <span
                                                class="ms-1 text-sm font-medium text-white md:ms-2 dark:text-slate-500">
                                                {{ ucfirst(str_replace('-', ' ', $segment)) }}
                                            </span>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                </div>




            </h3>

        </div>
    </section>




=======
            <form action="{{ route('web.set.locale') }}" method="POST" id="languageForm">
                @csrf
                <select name="locale" onchange="document.getElementById('languageForm').submit()">
                    <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
                    <option value="ar" {{ app()->getLocale() === 'ar' ? 'selected' : '' }}>Arabic</option>
                </select>
            </form>
        </div>


    </div>

    <!-- Banner -->
    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2 class="text-violet-800 font-bold text-6xl"><a href="/"
                                class="text-violet-800 font-bold ">Travel Shaper</a>
                        </h2>
                        <ul>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        #common_banner {
            background-image: url(storage/photos/hotel-pool-with-mosaictiled-bottom-swimup-bar-serving-refreshing-beverages.jpg);
            padding: 200px 0 130px 0;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        section {
            position: relative;
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

        .common_bannner_text {
            text-align: center;
            position: relative;
            top: 50px;
        }


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

        .common_bannner_text ul {
            padding-top: 20px;
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

        .common_bannner_text ul li:first-child {
            padding-left: 0px;
        }

        .common_bannner_text ul li {
            display: inline-block;
            padding-left: 7px;
            color: rgb(114, 7, 255);
            font-weight: 600;
        }

        ul li {
            list-style: none;
            padding: 0;
            font-weight: 600;
        }


        .common_bannner_text ul li a {
            color: rgb(114, 7, 255);
            font-weight: 600;
            font-size: 20px;
        }

        a {
            text-decoration: none;
            -webkit-transition: all 0.3s ease-in-out 0.1s;
            transition: all 0.3s ease-in-out 0.1s;
            color: rgb(114, 7, 255);
        }

        a {
            color: #0d6efd;
            text-decoration: underline;
        }

        .common_bannner_text ul li span {
            padding-right: 5px;
            font-weight: 600;
            font-size: 20px;

        }

        .common_bannner_text ul li span i {
            color: rgb(114, 7, 255);
            font-size: 7px;
            position: relative;
            top: -2px;
            left: -3px;
            font-weight: 600;
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

        .fa-circle:before {
            content: "\f111";
        }
    </style>
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
</div>
