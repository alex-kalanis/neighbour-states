<?php

namespace App\Providers;

use App\Interfaces\PointCoordinatesInterface;
use App\Lib\Locate\Db;
use App\Services\Coordinates;
use App\Services\GoogleMaps\Client as LocalClient;
use yidas\googleMaps\Client as RemoteClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
