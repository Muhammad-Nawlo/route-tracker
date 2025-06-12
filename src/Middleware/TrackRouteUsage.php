<?php

namespace MuhammadNawlo\RouteTracker\Middleware;

use Closure;
use MuhammadNawlo\RouteTracker\Support\UsageLogger;
use Illuminate\Http\Request;
class TrackRouteUsage
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        logger('TrackRouteUsage middleware fired for route: ' . $request->path());


        if (!config('route-tracker.enabled')) {
            return $response;
        }

        $route = $request->route();
        $name = $route?->getName() ?? $request->path();

        if ($name) {
            logger("Logging route usage for: {$name}");
            UsageLogger::log($name);
        }

        return $response;
    }
}
