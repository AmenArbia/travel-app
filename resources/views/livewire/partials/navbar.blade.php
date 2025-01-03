<div>
    <div class="static flex items-center justify-between px-4 py-2 bg-violet-600 navbar">
        <!-- Logo and Travel-Shaper Text -->
        <div class="relative flex items-center navbar-brand">
            <svg fill="none" height="36" viewBox="0 0 32 32" width="36" class="text-white">
                <path clip-rule="evenodd"
                    d="M17.6482 10.1305L15.8785 7.02583L7.02979 22.5499H10.5278L17.6482 10.1305ZM19.8798 14.0457L18.11 17.1983L19.394 19.4511H16.8453L15.1056 22.5499H24.7272L19.8798 14.0457Z"
                    fill="currentColor" fill-rule="evenodd" />
            </svg>
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
        </div>


        <div>
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
</div>
