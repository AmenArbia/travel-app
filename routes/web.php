<?php

use App\Livewire\BookingDetailsPage;
use App\Livewire\BookingPage;
use App\Livewire\HomePage;
use App\Livewire\HotelDetailPage;
use App\Livewire\Partials\Preview;
use App\Livewire\RoomDetailsPage;
use App\Livewire\RoomsPage;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;


$language = [
    'ar',
    'en',
];
$defaultLanguage = 'en';


Route::prefix('ar')->group(function () {
    $locale_prefix = 'ar';

    Route::get('/', Preview::class)->name('preview.' . $locale_prefix);
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
});

$locale_prefix = 'en';

Route::get('/', Preview::class)->name('preview.' . $locale_prefix);
Route::get('/home', HomePage::class)->name('home.' . $locale_prefix);
Route::get('/room', RoomsPage::class)->name('room.' . $locale_prefix);
Route::get('/room/{id}', RoomDetailsPage::class)->name('room.details.' . $locale_prefix);
Route::get('/details/{slug}', HotelDetailPage::class)->name('details.slug.' . $locale_prefix);
Route::get('/booking/{id}', BookingPage::class)->name('booking.' . $locale_prefix);
Route::get('/booking', BookingDetailsPage::class)->name('booking.details.' . $locale_prefix);
Route::post('/set-locale', function () {
    $locale = request('locale');
    session(['locale' => $locale]);

    $currentUrl = url()->previous();
    $newUrl = preg_replace('/^.*\/(ar|en)(\/|$)/', "/$locale$2", $currentUrl);

    return redirect($newUrl);
})->name('web.set.locale');