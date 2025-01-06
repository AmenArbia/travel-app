<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Navbar extends Component
{

    public $locale;

    public function mount()
    {
        // Initialize the selected locale from session or default
        $this->locale = session('locale', 'en');
    }

    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            session(['locale' => $locale]); // Save the locale in session
            app()->setLocale($locale);

            // Redirect to the same page with the correct locale prefix
            $currentUrl = url()->current();
            $newUrl = preg_replace('/\/(ar|en)(\/|$)/', "/$locale$2", $currentUrl);

            return redirect($newUrl);
        }
    }
}
