<?php

use App\Livewire\BookingDetailsPage;
use App\Livewire\BookingPage;
use App\Livewire\HomePage;
use App\Livewire\HotelDetailPage;
use App\Livewire\Partials\Preview;
use App\Livewire\RoomDetailsPage;
use App\Livewire\RoomsPage;
use App\Http\Middleware\SetLocale;
<<<<<<< HEAD
use App\Livewire\BookingWaitingConfirmation;
use App\Models\Booking;
=======
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
use Illuminate\Support\Facades\Route;


$language = [
    'ar',
    'en',
];
$defaultLanguage = 'en';


Route::prefix('ar')->group(function () {
    $locale_prefix = 'ar';

    Route::get('/', Preview::class)->name('preview.' . $locale_prefix);
<<<<<<< HEAD
    Route::get('/hotels', HomePage::class)->name('hotels.' . $locale_prefix);
    Route::get('/room', RoomsPage::class)->name('room.' . $locale_prefix);
    Route::get('/room/{id}', RoomDetailsPage::class)->name('room.details.' . $locale_prefix);
    Route::get('/details/{slug}', HotelDetailPage::class)->name('details.slug.' . $locale_prefix);
    Route::get('/booking/{id}', BookingPage::class)->name('booking.' . $locale_prefix);
    Route::get('/booking-details', BookingDetailsPage::class)->name('booking.details.' . $locale_prefix);
    Route::get('/booking-waiting-confirmation', BookingWaitingConfirmation::class)->name('booking.waiting-conformation.' . $locale_prefix);
    Route::get('/booking/confirm/{id}', function ($id) {
        $booking = Booking::findOrFail($id);
        $booking->update(['is_confirmed' => true]);
        return view('booking-confirmation');
    })->name('booking.confirm.' . $locale_prefix);


=======
    Route::get('/home', HomePage::class)->name('home.' . $locale_prefix);
    Route::get('/room', RoomsPage::class)->name('room.' . $locale_prefix);
    Route::get('/room/{id}', RoomDetailsPage::class)->name('room.details.' . $locale_prefix);
    Route::get('/details/{slug}', HotelDetailPage::class)->name('details.slug.' . $locale_prefix);
    Route::get('/booking/{{id}}', BookingPage::class)->name('booking.' . $locale_prefix);
    Route::get('/booking/{room_id}', BookingPage::class)->name('booking.details.' . app()->getLocale());
    Route::post('/set-locale', function () {
        $locale = request('locale');
        session(['locale' => $locale]);

        // Build the new URL with the selected locale
        $currentUrl = url()->previous();
        $newUrl = preg_replace('/^.*\/(ar|en)(\/|$)/', "/$locale$2", $currentUrl);

        return redirect($newUrl);
    })->name('web.set.locale');
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
});

$locale_prefix = 'en';

Route::get('/', Preview::class)->name('preview.' . $locale_prefix);
<<<<<<< HEAD
Route::get('/hotels', HomePage::class)->name('hotels.' . $locale_prefix);
=======
Route::get('/home', HomePage::class)->name('home.' . $locale_prefix);
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
Route::get('/room', RoomsPage::class)->name('room.' . $locale_prefix);
Route::get('/room/{id}', RoomDetailsPage::class)->name('room.details.' . $locale_prefix);
Route::get('/details/{slug}', HotelDetailPage::class)->name('details.slug.' . $locale_prefix);
Route::get('/booking/{id}', BookingPage::class)->name('booking.' . $locale_prefix);
<<<<<<< HEAD
Route::get('/booking-details', BookingDetailsPage::class)->name('booking.details.' . $locale_prefix);
Route::get('/booking-waiting-confirmation', BookingWaitingConfirmation::class)->name('booking.waiting-conformation.' . $locale_prefix);
Route::get('/booking/confirm/{id}', function ($id) {
    $booking = Booking::findOrFail($id);
    $booking->update(['is_confirmed' => true]);
    return view('booking-confirmation');
})->name('booking.confirm.' . $locale_prefix);
=======
Route::get('/booking', BookingDetailsPage::class)->name('booking.details.' . $locale_prefix);
Route::post('/set-locale', function () {
    $locale = request('locale');
    session(['locale' => $locale]);

    $currentUrl = url()->previous();
    $newUrl = preg_replace('/^.*\/(ar|en)(\/|$)/', "/$locale$2", $currentUrl);

    return redirect($newUrl);
})->name('web.set.locale');
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
