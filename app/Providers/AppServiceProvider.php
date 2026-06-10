<?php

namespace App\Providers;

use App\Filament\Pages\Dashboard as CustomDashboard;
use App\Models\User;
use App\Policies\UserPolicy;
use Filament\Pages\Dashboard as FilamentDashboard;
use Illuminate\Support\Facades\Gate;
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
        $this->app->bind(FilamentDashboard::class, function () {
            return new CustomDashboard();
        });
        Gate::policy(User::class, UserPolicy::class);
    }
}
