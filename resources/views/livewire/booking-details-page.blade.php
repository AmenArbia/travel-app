<div>
    @include('livewire.partials.navbar')
    @vite('resources/css/booking-details.css')

    <title>{{ $title ?? 'Travel-App' }}</title>

    <section id="dashboard_main_arae" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="bg-white shadow-lg p-4 rounded">
                        <h3 class="font-bold mb-5">{{ __('lang.Booking history') }}</h3>

                        <a href="{{ route('hotels.' . app()->getLocale()) }}"
                            class="btnbtn  hover:bg-yellow-500 hover:font-bold font-medium text-white rounded-full px-4 py-2 mb-2
                                    bg-violet-600 no-underline transform transition duration-300 hover:scale-105 hover:shadow-lg mt-5">
                            {{ __('lang.Book Room') }}
                        </a>

                        <div class="table-responsive mt-3 mb-3">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>{{ __('lang.Hotel Name') }}</th>
                                        <th>{{ __('lang.Room name') }}</th>
                                        <th>{{ __('lang.Room type') }}</th>
                                        <th>{{ __('lang.Room price') }}</th>
                                        <th>{{ __('lang.Check In') }} / {{ __('lang.Check Out') }}</th>
                                        <th>{{ __('lang.Total price') }}</th>
                                        <th>{{ __('lang.Booking status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->hotel->name ?? 'N/A' }}</td>
                                            <td>{{ $booking->roomtype->name ?? 'N/A' }}</td>
                                            <td>
                                                @if ($booking->roomtype->room->type === 'Standard ')
                                                    <span
                                                        class="badge badge-success pending bg-green-500 inline-block px-2 font-bold text-white rounded-2xl text-md">
                                                        {{ __('lang.Standard ') }}
                                                    </span>
                                                @elseif ($booking->roomtype->room->type === 'Deluxe ')
                                                    <span
                                                        class="badge badge-primary approved bg-blue-500 inline-block px-2 font-bold text-white rounded-2xl text-md">
                                                        {{ __('lang.Deluxe ') }}
                                                    </span>
                                                @elseif ($booking->roomtype->room->type === 'Suite ')
                                                    <span
                                                        class="badge badge-warning cancelled bg-yellow-500 inline-block px-2 font-bold text-white rounded-2xl text-md">
                                                        {{ __('lang.Suite ') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $booking->roomtype->price ?? 'N/A' }} {{ __('lang.TND') }}</td>
                                            <td>
                                                {{ $booking->check_in_date ?? 'N/A' }} /
                                                {{ $booking->check_out_date ?? 'N/A' }}
                                            </td>
                                            <td>{{ $booking->total_price ?? 'N/A' }} {{ __('lang.TND') }}</td>
                                            <td>
                                                @if ($booking->booking_status == 'pending')
                                                    <span
                                                        class="badge badge-info pending bg-green-500 inline-block px-2 font-bold text-white rounded-2xl text-md">
                                                        {{ __('lang.Pending') }}
                                                    </span>
                                                @elseif ($booking->booking_status == 'approved')
                                                    <span
                                                        class="badge badge-success approved bg-blue-500 inline-block px-2 font-bold text-white rounded-2xl text-md">
                                                        {{ __('lang.Approved') }}
                                                    </span>
                                                @elseif ($booking->booking_status == 'cancelled')
                                                    <span
                                                        class="badge badge-danger cancelled bg-yellow-500 inline-block px-2 font-bold text-white rounded-2xl text-md">
                                                        {{ __('lang.Rejected') }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $bookings->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
