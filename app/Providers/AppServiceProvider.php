<?php

namespace App\Providers;

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
        // Share new contact messages count with admin layout
        view()->composer('layouts.admin', function ($view) {
            $view->with('newMessagesCount', \App\Models\ContactMessage::new()->count());
        });

        // Share hero data with guest layout
        view()->composer('layouts.guest', function ($view) {
            try {
                $homePage = \App\Models\Page::where('key', 'home')->first();
                $view->with('homePage', $homePage);
            } catch (\Exception $e) {
                $view->with('homePage', null);
            }
        });
    }
}
