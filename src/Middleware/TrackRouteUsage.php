<?php

namespace MuhammadNawlo\RouteTracker\Middleware;

use Closure;
use Illuminate\Http\Request;
use MuhammadNawlo\RouteTracker\Support\UsageLogger;

class TrackRouteUsage
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);


        if (! config('route-tracker.enabled')) {
            return $response;
        }

        $route = $request->route();
        $name = $route?->getName() ?? $request->path();

        if ($name) {
            UsageLogger::log($name);
        }

        return $response;
    }
}
