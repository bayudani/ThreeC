<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;


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
    public function boot(): void
    {
        if (str_contains(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        // Share kontak admin ke semua view untuk footer
        view()->composer('*', function ($view) {
            $kontaks = \App\Models\KontakAdmin::where('is_active', true)
                ->orderBy('urutan')
                ->get();
            $view->with('footerKontaks', $kontaks);
        });
    }
}
