<?php

namespace Amirsahra\Illustrator;

use Illuminate\Support\ServiceProvider;

class IllustratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Illustrator', Illustrator::class);
    }

    public function boot()
    {
        // todo add config
    }
}