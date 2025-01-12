<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{

    public const HOME = '/';
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
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
        Gate::policy(\App\Models\Theme::class, \App\Policies\ThemePolicy::class);
        Gate::policy(\App\Models\Issue::class, \App\Policies\IssuePolicy::class);
    }
}
