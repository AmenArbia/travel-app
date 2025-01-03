<div>
    <section id="dashboard_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="dashboard_common_table">
                        <h3 class="font-bold">Booking history</h3>

                        <button
                            class="px-4 py-2 font-bold text-white rounded-full hover:bg-yellow-500 bg-violet-600 relative ">
                            <a href="{{ route('room.en') }}" class="text-white underline-offset-4">Book Room</a>
                        </button>
                        <div class="table-responsive-lg table_common_area">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Hotel name</th>
                                        <th>Room code</th>
                                        <th>Room type</th>
                                        <th>Room price</th>
                                        <th>Check In / Check Out</th>
                                        <th>Total price</th>
                                        <th>Booking status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->hotel->name ?? 'N/A' }}</td>
                                            <td>{{ $booking->roomtype->name ?? 'N/A' }}</td>
                                            <td
                                                class="relative  inline-block px-2  font-bold text-black rounded-2xl text-md
                                            @if ($booking->roomtype->room->type == 'Standard ') bg-green-500
                                            @elseif ($booking->roomtype->room->type == 'Deluxe ') bg-blue-500
                                            @elseif ($booking->roomtype->room->type == 'Suite ') bg-yellow-500 @endif
                                        ">
                                                <span
                                                    class=" inline-block px-2  font-bold text-black rounded-2xl text-md ">
                                                    {{ $booking->roomtype->room->type ?? 'N/A' }}</span>
                                            </td>
                                            <td>{{ $booking->roomtype->price ?? 'N/A' }} TND</td>
                                            <td class="complete">
                                                {{ $booking->check_in_date ?? 'N/A' }} /
                                                {{ $booking->check_out_date ?? 'N/A' }}
                                            </td>
                                            <td>{{ $booking->total_price ?? 'N/A' }} TND</td>
                                            <td
                                                class="relative  inline-block px-2  font-bold text-black rounded-2xl text-md">
                                                @if ($booking->booking_status == 'pending')
                                                    <span
                                                        class="pending bg-blue-500  inline-block px-2  font-bold text-white rounded-2xl text-md">Pending</span>
                                                @elseif ($booking->booking_status == 'approved')
                                                    <span
                                                        class="approved bg-green-500  inline-block px-2  font-bold text-white rounded-2xl text-md">Approved</span>
                                                @elseif ($booking->booking_status == 'cancelled')
                                                    <span
                                                        class="cancelled bg-red-500 inline-block px-2  font-bold text-white rounded-2xl text-md">Rejected</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .section_padding {
            padding: 100px 0;
        }

        section {
            position: relative;
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

        .dashboard_common_table {
            background: #F3F6FD;
            border-radius: 12px;
            padding: 25px 30px;
        }

        .dashboard_common_table h3 {
            font-weight: bold;
            border-bottom: 1px solid #d5d5d5;
            padding-bottom: 11px;
            position: relative;
        }

        h3 {
            font-size: 24px;
            font-weight: 300;
        }

        .dashboard_common_table h3::after {
            content: "";
            width: 140px;
            height: 2px;
            background: var(--main-color);
            position: absolute;
            left: 0;
            bottom: 0;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .table_common_area {
            margin-top: 40px;
        }

        .table>thead {
            vertical-align: bottom;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        .table>:not(:last-child)>:last-child>* {
            border-bottom-color: currentColor;
        }

        .table_common_area thead tr th {
            border: none;
            background: #fff;
            padding: 15px 0;
        }

        .table>:not(caption)>*>* {
            padding: .5rem .5rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        th {
            text-align: inherit;
            text-align: -webkit-match-parent;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        th {
            display: table-cell;
            vertical-align: inherit;
            font-weight: bold;
            text-align: -internal-center;
            unicode-bidi: isolate;
        }

        .table_common_area table {
            text-align: center;
            border: 1px solid #d5d5d5;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        table {
            caption-side: bottom;
            border-collapse: collapse;
        }

        .table>tbody {
            vertical-align: inherit;
        }

        .table_common_area tbody tr td {
            padding: 16px 0;
        }

        .table>:not(caption)>*>* {
            padding: .5rem .5rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }
    </style>
</div>
