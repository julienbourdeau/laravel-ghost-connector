<?php

namespace Julienbourdeau\LaravelGhostConnector;

use Illuminate\Support\ServiceProvider;

class LaravelGhostConnectorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Default config is merged into the `services` namespace.
        // Feel free to override the values in your `config/services.php` file.
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'services');

        $this->app->singleton(GhostClient::class, function () {
            return new GhostClient(
                config('services.ghost.api_url'),
                config('services.ghost.content_key')
            );
        });
    }
}
