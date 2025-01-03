<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        $locale = $request->segment(1);
        if ($locale !== 'ar') {
            $setLocale = 'en';
        }

        $additional_languages = [
            'ar' => 'Arabic',
        ];

        if (array_key_exists($locale, $additional_languages)) {
            $setLocale = $locale;
        }
        app()->setLocale($setLocale);


    }
}
