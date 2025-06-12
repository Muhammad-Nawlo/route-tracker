<?php


namespace MuhammadNawlo\RouteTracker\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use MuhammadNawlo\RouteTracker\RouteTrackerServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            RouteTrackerServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('route-tracker.enabled', true);
        $app['config']->set('filesystems.default', 'local');
        $app['config']->set('app.key', 'base64:' . base64_encode(random_bytes(32)));
    }
}
