<div class="min-h-screen bg-white">
    <div class="relative flex items-center justify-center min-h-screen overflow-hidden bg-slate-100">
        <div
            class="relative w-full h-full px-6 pt-16 overflow-hidden shadow-2xl bg-gray-00 isolate sm:rounded-none sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
            <svg viewBox="0 0 1024 1024"
                class="absolute left-1/2 top-1/2 -z-10 w-[64rem] -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
                aria-hidden="true">
                <circle cx="712" cy="712" r="712" fill="url(#6dae4d9218db83d49ff4948955ed0620)"
                    fill-opacity="0.7" />
                <defs>
                    <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                        <stop stop-color="#7775D6" />
                        <stop offset="1" stop-color="#E935C1" />
                    </radialGradient>
                </defs>
            </svg>
            <div class="relative max-w-md mx-auto text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left bottom-14">
                <h2 class="text-3xl font-semibold tracking-tight text-violet-500 sm:text-4xl ">
                    <span class="text-yellow-600 text-7xl text-bold text-animation ">Find the Best</span>
                    Rooms, Hotels, and Destinations for Your Next Trip.
                </h2>
                <p class="mt-6 text-slate-500 text-md text-animation2 "> Hotel room with ease using our app. Browse a
                    wide selection of
                    rooms, check real-time availability, and enjoy exclusive deals. Book your next stay effortlessly and
                    securely today! </p>
                <div class="flex items-center justify-center mt-10 gap-x-6 lg:justify-start ">
                    <a href="/home"
                        class=" right-28 rounded-md bg-violet-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-yellow-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white ">Get
                        started</a>
                    <a href="/home" class="text-sm font-semibold text-black after:border-t-violet-500">Learn more
                        <span aria-hidden="true">→</span></a>
                </div>
            </div>
            <div class="relative h-full mt-16 lg:mt-7">
                <img class="absolute top-0 left-0 bottom-auto w-auto rounded-s-full max-w-none bg-white/5 ring-1 ring-white/10 image-animation "
                    src="{{ asset('assets/6dae4d9218db83d49ff4948955ed0620.jpg') }}" alt="App screenshot">
            </div>
        </div>
    </div>

    <style>
        .text-animation {
            animation: fadeIn 2s ease-out forwards, scaleIn 2s ease-out forwards;
        }



        @keyframes cursor {
            50% {
                border-color: transparent;
            }
        }


        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0.8);
            }

            100% {
                transform: scale(1);
            }
        }

        .text-animation:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-out;
        }

        .text-animation:hover {
            filter: blur(1px);
            transition: filter 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .image-animation {
            animation: fadeIn 2s ease-out forwards, scaleIn 2s ease-out forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0.8);
            }

            100% {
                transform: scale(1);
            }
        }

        .image-animation:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }

        .image-animation:hover {
            filter: blur(1.5px);
            transition: filter 0.3s ease-in-out, transform 0.3s ease-in-out;
        }
    </style>

</div>




</div>
