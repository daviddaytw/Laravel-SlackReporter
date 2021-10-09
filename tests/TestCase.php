<?php

namespace Tests;

use FelineStudio\SlackReporter\SlackReporterServiceProvider;
use FelineStudio\SlackReporter\SlackReporterFacade;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            SlackReporterServiceProvider::class,
        ];
    }

    /**
     * Override application aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'SlackReporter' => SlackReporterFacade::class,
        ];
    }

    /**
     * Ignore package discovery from.
     *
     * @return array
     */
    public function ignorePackageDiscoveriesFrom()
    {
        return [];
    }
}