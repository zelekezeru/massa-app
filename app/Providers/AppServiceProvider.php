<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;

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
        Vite::prefetch(concurrency: 3);
        // Optionally, you can register policies or seed default roles/permissions here
        Inertia::share([
            'translations' => fn () => [
                'lang' => app()->getLocale(),
                'messages' => include resource_path("lang/" . app()->getLocale() . "/messages.php")
            ]
        ]);
    }
}
