<div>
    @include('livewire.partials.navbar')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <title>Waiting for Confirmation</title>

                        <div class="mt-5">
                            <h2 class="text-success font-bold">Booking Submitted Successfully</h2>
                        </div>

                        <div class="mt-5 mx-4 mb-4">
                            <p>We've sent a confirmation email to your email address.</p>
                            <p>After you check your email box and confirm you receive the email, just wait for the
                                approval of your booking.</p>
                            <small class="text-muted">Go check your booking details.</small>
                            <p class="text-danger font-medium pt-2">If you don't receive an email, please verify
                                it in the form.</p>
                        </div>

                        <a href="/booking-details"
                            class="btn hover:bg-yellow-500 hover:font-bold font-medium text-white rounded-full
                                    bg-violet-600 no-underline transform transition duration-300 hover:scale-105 hover:shadow-lg">
                            Booking details <x-heroicon-o-chevron-right class="inline-block w-4 h-4 ml-2" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
