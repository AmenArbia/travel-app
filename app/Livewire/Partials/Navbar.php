<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Navbar extends Component
{

    public $locale;

    public function mount()
    {
<<<<<<< HEAD
=======
        // Initialize the selected locale from session or default
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
        $this->locale = session('locale', 'en');
    }

    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
<<<<<<< HEAD
            session(['locale' => $locale]);

=======
            session(['locale' => $locale]); // Save the locale in session
            app()->setLocale($locale);

            // Redirect to the same page with the correct locale prefix
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
            $currentUrl = url()->current();
            $newUrl = preg_replace('/\/(ar|en)(\/|$)/', "/$locale$2", $currentUrl);

            return redirect($newUrl);
        }
    }
}
