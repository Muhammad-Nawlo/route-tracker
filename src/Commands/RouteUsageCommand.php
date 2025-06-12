<?php
namespace MuhammadNawlo\RouteTracker\Commands;


use Illuminate\Console\Command;
use MuhammadNawlo\RouteTracker\Support\UsageLogger;

class RouteUsageCommand extends Command
{
    protected $signature = 'route:usage';
    protected $description = 'Display route usage statistics';

    public function handle()
    {
        $data = UsageLogger::getUsage();

        if (empty($data)) {
            $this->info('No route usage data found.');
            return;
        }

        $this->table(['Route', 'Hits', 'Last Used'], collect($data)->map(function ($item, $route) {
            return [$route, $item['hits'], $item['last_used']];
        })->toArray());
    }
}
