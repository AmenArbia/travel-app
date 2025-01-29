<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Navbar extends Component
{

    public $locale;

    public function mount()
    {
        $this->locale = session('locale', 'en');
    }

    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            session(['locale' => $locale]);

            $currentUrl = url()->current();
            $newUrl = preg_replace('/\/(ar|en)(\/|$)/', "/$locale$2", $currentUrl);

            return redirect($newUrl);
        }
    }
}