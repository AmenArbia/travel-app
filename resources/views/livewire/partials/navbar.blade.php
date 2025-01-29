<div>
    @vite('resources/css/navbar.css')


    <div class="static flex items-center justify-between px-4 py-2  navbar   bg-violet-400">
        <!-- Logo and Travel-Shaper Text -->
        <div class="relative flex items-center navbar-brand">
            <svg fill="none" height="36" viewBox="0 0 32 32" width="36" class="text-white">
                <path clip-rule="evenodd"
                    d="M17.6482 10.1305L15.8785 7.02583L7.02979 22.5499H10.5278L17.6482 10.1305ZM19.8798 14.0457L18.11 17.1983L19.394 19.4511H16.8453L15.1056 22.5499H24.7272L19.8798 14.0457Z"
                    fill="currentColor" fill-rule="evenodd" />
            </svg>
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
        </div>


        <div>
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




</div>
