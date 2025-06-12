<?php

namespace MuhammadNawlo\RouteTracker\Support;

use Illuminate\Support\Facades\Storage;

class UsageLogger
{
    protected static $file = 'route-usage.json';

    public static function log(string $route)
    {
        $path = 'route-usage.json';
        $data = [];
        if (Storage::exists($path)) {
            $data = json_decode(Storage::get($path), true);
        }

        $data[$route] = [
            'hits' => ($data[$route]['hits'] ?? 0) + 1,
            'last_used' => now()->toDateTimeString(),
        ];

        Storage::put($path, json_encode($data));
    }

    public static function getUsage()
    {
        if (! Storage::exists(self::$file)) {
            return [];
        }

        return json_decode(Storage::get(self::$file), true);
    }
}
