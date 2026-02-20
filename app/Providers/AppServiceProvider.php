<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS in production
        if (config('app.env') === 'production' || isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            URL::forceScheme('https');
        }

        // Share new contact messages count with admin layout
        view()->composer('layouts.admin', function ($view) {
            try {
                $newMessagesCount = \App\Models\ContactMessage::new()->count();
                $view->with('newMessagesCount', $newMessagesCount);
            } catch (\Exception $e) {
                $view->with('newMessagesCount', 0);
            }
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
