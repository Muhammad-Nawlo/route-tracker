<?php

namespace MuhammadNawlo\RouteTracker;

use Illuminate\Support\ServiceProvider;
use MuhammadNawlo\RouteTracker\Commands\RouteUsageCommand;
use MuhammadNawlo\RouteTracker\Middleware\TrackRouteUsage;

class RouteTrackerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/route-tracker.php' => config_path('route-tracker.php'),
        ], 'config');

        if (config('route-tracker.enabled')) {
            app('router')->pushMiddlewareToGroup('web', TrackRouteUsage::class);
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                RouteUsageCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/route-tracker.php', 'route-tracker');
    }
}
