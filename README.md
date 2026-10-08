# Route Tracker for Laravel

[![Tests](https://github.com/Muhammad-Nawlo/route-tracker/actions/workflows/run-tests.yml/badge.svg)](https://github.com/Muhammad-Nawlo/route-tracker/actions/workflows/run-tests.yml)
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)

Find out which routes in your Laravel app are actually used. Route Tracker counts hits and records the last-used time for every route, so you can spot dead endpoints before you delete or refactor them.

## Features

- Zero setup: the middleware registers itself on the `web` group
- Records hit count and last-used timestamp per route (route name, or path for unnamed routes)
- Stores data as JSON on your default filesystem disk, so it works with local storage, S3 and any other Laravel disk
- `php artisan route:usage` prints a usage table
- Switch it off with one environment variable
- Supports Laravel 10, 11 and 12 on PHP 8.0+

## Installation

```bash
composer require muhammad-nawlo/route-tracker
```

The service provider is auto-discovered. Optionally publish the config:

```bash
php artisan vendor:publish --provider="MuhammadNawlo\RouteTracker\RouteTrackerServiceProvider" --tag=config
```

## Usage

Browse your app as normal, then run:

```bash
php artisan route:usage
```

```
+-----------------+------+---------------------+
| Route           | Hits | Last Used           |
+-----------------+------+---------------------+
| dashboard       | 42   | 2026-10-08 14:03:11 |
| profile.edit    | 7    | 2026-10-07 09:12:45 |
| reports/export  | 1    | 2026-09-30 17:40:02 |
+-----------------+------+---------------------+
```

The raw data lives in `route-usage.json` on the default disk.

To track API routes too, add the middleware to the `api` group yourself:

```php
// bootstrap/app.php (Laravel 11+)
->withMiddleware(function (Middleware $middleware) {
    $middleware->api(append: [
        \MuhammadNawlo\RouteTracker\Middleware\TrackRouteUsage::class,
    ]);
})
```

## Configuration

```php
// config/route-tracker.php
return [
    'enabled' => env('ROUTE_TRACKER_ENABLED', true),
];
```

Set `ROUTE_TRACKER_ENABLED=false` to turn tracking off.

> Every request reads and writes one JSON file, so the package is best suited to development, staging and low-to-medium traffic apps.

## Testing

```bash
composer test
```

## Changelog

See [CHANGELOG.md](CHANGELOG.md).

## License

MIT. See [LICENSE.md](LICENSE.md).
