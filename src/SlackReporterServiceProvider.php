<?php

namespace FelineStudio\SlackReporter;

use Illuminate\Support\ServiceProvider;

class SlackReporterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('slack-reporter.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'slack-reporter');

        // Register the main class to use with the facade
        $this->app->singleton('slack-reporter', function () {
            return new SlackReporter;
        });
    }
}
