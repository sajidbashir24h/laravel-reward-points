<?php

namespace Sajidbashir24h\Gamify;

use Sajidbashir24h\Gamify\Facades\Gamify;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;
use Sajidbashir24h\Gamify\Listeners\SyncBadges;
use Illuminate\Support\ServiceProvider;
use Sajidbashir24h\Gamify\Console\MakeBadgeCommand;
use Sajidbashir24h\Gamify\Console\MakePointCommand;
use Sajidbashir24h\Gamify\Events\PointsChanged;

class GamifyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // publish config
        $this->publishes([
            __DIR__ . '/config/gamify.php' => config_path('gamify.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/config/gamify.php', 'gamify');

        // Publish factory
        $this->loadFactoriesFrom(__DIR__ . '/Factories');

        // publish migration
        if (!class_exists('CreateGamifyTables')) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__ . '/migrations/create_gamify_tables.php.stub' => database_path("/migrations/{$timestamp}_create_gamify_tables.php"),
            ], 'migrations');
        }

        // register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakePointCommand::class,
                MakeBadgeCommand::class,
            ]);
        }

        // register event listener
        Event::listen(PointsChanged::class, SyncBadges::class);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // register facade
        $this->app->bind(Gamify::class, function ($app) {
            return new Gamify();
        });

        $this->app->alias(Gamify::class, 'gamify');
    }
}
