<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use MuhammadNawlo\RouteTracker\Middleware\TrackRouteUsage;

beforeEach(function () {
    // Fake the default storage disk so no real files are created
    Storage::fake();

    // Register a test route with the middleware attached
    Route::middleware(['web', TrackRouteUsage::class])
        ->name('test-route')
        ->get('/test-route', function () {
            return response('Test route response');
        });
});

it('logs route usage', function () {
    // Make a GET request to the test route
    $this->get('/test-route')->assertOk();

    // Assert that the route-usage.json file was created in the storage disk
    Storage::assertExists('route-usage.json');

    // Get and decode the JSON content from the file
    $content = Storage::get('route-usage.json');
    $data = json_decode($content, true);

    // Assert the log data contains the route key
    expect($data)->toHaveKey('test-route');

    // Assert the hits count is 1 for the first hit
    expect($data['test-route']['hits'])->toBe(1);

    // Assert last_used is not null
    expect($data['test-route']['last_used'])->not->toBeNull();
});
