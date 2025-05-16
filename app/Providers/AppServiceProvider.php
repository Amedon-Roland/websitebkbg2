<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Reservation;
use App\Models\RoomCategory;
use App\Observers\RoomCategoryObserver;
use App\Observers\ReservationObserver;

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
        RoomCategory::observe(RoomCategoryObserver::class);
        Reservation::observe(ReservationObserver::class);
    }
}
