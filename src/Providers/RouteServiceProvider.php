<?php

namespace LaravelersAcademy\ZoomMeeting\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    public function map()
    {
        
        $this->mapApiRoutes();

    }

    protected function mapApiRoutes()
    {
        Route::middleware('api')
            ->prefix('api/zoom')
            ->namespace('LaravelersAcademy\ZoomMeeting\Http\Controllers')
            ->group(__DIR__.'/../../routes/api.php');
    }

}
