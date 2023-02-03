<?php

namespace Amirsahra\Illustrator;

use Illuminate\Support\ServiceProvider;

class IllustratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Illustrator', Illustrator::class);
        $this->mergeConfigFrom(__DIR__ . '/Config/illustrator.php', 'illustrator');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/illustrator.php' => config_path('illustrator.php')
        ], 'illustrator');
    }
}