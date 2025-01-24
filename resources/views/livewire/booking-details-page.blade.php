<div>
    @include('livewire.partials.navbar')
    @vite('resources/css/booking-details.css')

    <title>{{ $title ?? 'Travel-App' }}</title>

    <section id="dashboard_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="dashboard_common_table bg-white shadow-2xl p-10 rounded-2xl  ">
                        <h3 class="font-bold">{{ __('lang.Booking history') }}</h3>

                        <button
                            class="px-4 py-2 font-bold text-white rounded-full hover:bg-yellow-500 bg-violet-600 relative ">
                            <a href="{{ route('hotels.' . app()->getLocale()) }}"
                                class="text-white no-underline">{{ __('lang.Book Room') }}</a>
                        </button>
                        <div class="table-responsive-lg table_common_area">
                            <table class="table">
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
                                            <td class="inline-block">{{ $booking->hotel->name ?? 'N/A' }}</td>
                                            <td>{{ $booking->roomtype->name ?? 'N/A' }}</td>
                                            <td
                                                class="relative  inline-block px-2   font-bold text-black  text-md
                                            @if ($booking->roomtype->room->type === 'Standard ') bg-green-500
                                            @elseif ($booking->roomtype->type === 'Deluxe ') bg-blue-500
                                            @elseif ($booking->roomtype->type === 'Suite ') bg-yellow-500 @endif
                                        ">
                                                <span class=" inline-block px-2  font-bold text-black  text-md  ">
                                                    {{ $booking->roomtype->room->type ?? 'N/A' }}</span>
                                            </td>
                                            <td>{{ $booking->roomtype->price ?? 'N/A' }} {{ __('lang.TND') }}</td>
                                            <td class="complete">
                                                {{ $booking->check_in_date ?? 'N/A' }} /
                                                {{ $booking->check_out_date ?? 'N/A' }}
                                            </td>
                                            <td>{{ $booking->total_price ?? 'N/A' }} {{ __('lang.TND') }}</td>
                                            <td class="px-2 inline-block">
                                                @if ($booking->booking_status == 'pending')
                                                    <span
                                                        class="pending bg-blue-500 inline-block px-2 font-bold text-white rounded-2xl text-md">
                                                        {{ __('lang.Pending') }}
                                                    </span>
                                                @elseif ($booking->booking_status == 'approved')
                                                    <span
                                                        class="approved bg-green-500 inline-block px-2 font-bold text-white rounded-2xl text-md">
                                                        {{ __('lang.Approved') }}
                                                    </span>
                                                @elseif ($booking->booking_status == 'cancelled')
                                                    <span
                                                        class="cancelled bg-red-500 inline-block px-2 font-bold text-white rounded-2xl text-md">
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
                    <div class="flex justify-end mt-6 ">
                        {{ $bookings->links('pagination::tailwind', ['class' => 'pagination-class']) }}
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
