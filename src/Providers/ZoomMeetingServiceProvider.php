<?php

namespace LaravelersAcademy\ZoomMeeting\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelersAcademy\ZoomMeeting\Zoom\Meeting;

class ZoomMeetingServiceProvider extends ServiceProvider
{

    public function register()
    {
        
        $this->app->bind('meeting', function($app) {
            return new Meeting();
        });

        $this->mergeConfigFrom(__DIR__.'/../../config/zoom.php', 'zoom');

    }

    public function boot()
    {
        
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../../config/zoom.php' => config_path('zoom.php'),
            ], 'config');

        }

    }

}
