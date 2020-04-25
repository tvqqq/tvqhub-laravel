<?php

namespace Deep\Providers;

use Deep\Controllers\DeepHelper;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class DeepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/deep.php', 'deep');

        $loader = AliasLoader::getInstance();
        $loader->alias('Deep', DeepHelper::class);

        $this->app->singleton('Deep', function () {
            return new DeepHelper();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'deep');
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }
}
