<div class="bg-light">
    @include('livewire.partials.navbar')

    @vite('resources/css/preview.css')

    <div
        class="container-fluid position-relative d-flex align-items-center justify-content-center overflow-hidden bg-light min-vh-100">
        <div class="row w-100 align-items-center">
            <!-- Text on the Left -->
            <div class="col-lg-6 text-center text-lg-start">
                <div class="position-relative max-w-md mx-auto lg:mx-0 lg:py-32">
                    <h2 class="text-3xl fw-semibold tracking-tight text-violet-500 sm:text-4xl">
                        <span class="text-yellow-600 display-4 fw-bold text-animation">Find the Best</span>
                        Rooms, Hotels, and Destinations for Your Next Trip.
                    </h2>
                    <p class="mt-6 text-secondary text-animation2"> Hotel room with ease using our app. Browse a
                        wide selection of
                        rooms, check real-time availability, and enjoy exclusive deals. Book your next stay effortlessly
                        and
                        securely today! </p>
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start mt-10 gap-3">
                        <a href="/hotels"
                            class="px-3.5 py-2.5 text-sm fw-semibold p-2  text-decoration-none hover-scale btn mt-3 hover:bg-yellow-500 hover:font-bold font-medium text-white rounded-full
                                    bg-violet-600 no-underline transform transition duration-300 hover:scale-105 hover:shadow-lg ">Get
                            started</a>
                        <a href="/hotels" class="text-sm fw-semibold text-black text-decoration-none hover-scale">Learn
                            more
                            <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>

            <!-- Picture on the Right -->
            <div class="col-lg-6 position-relative mt-16 mt-lg-0">
                <img class="w-100 h-auto rounded-start-pill image-animation"
                    src="{{ asset('assets/6dae4d9218db83d49ff4948955ed0620.jpg') }}" alt="App screenshot">
            </div>
        </div>
    </div>
</div>
