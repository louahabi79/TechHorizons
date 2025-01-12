<?php

namespace App\Providers;

use App\Models\Theme;
use App\Policies\ThemePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Theme::class => \App\Policies\ThemePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        if (!app()->bound('Illuminate\Contracts\Auth\Access\Gate')) {
            dd('Gate binding not found');
        }
    }
}
