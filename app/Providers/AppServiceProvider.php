<?php

namespace App\Providers;

use App\Models\Trip;
use Laravel\Sanctum\Sanctum;
use App\Observers\TripObserver;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        //Sanctum::ignoreMigration();

    }
}
