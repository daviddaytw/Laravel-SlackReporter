<?php

namespace FelineStudio\SlackReporter;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FelineStudio\SlackReporter\Skeleton\SkeletonClass
 */
class SlackReporterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'slack-reporter';
    }
}
