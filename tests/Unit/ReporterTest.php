<?php

namespace Tests\Unit;

use Error;
use Exception;
use FelineStudio\SlackReporter\SlackReporter;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase;
use Throwable;

class ReporterTest extends TestCase
{
    /**
     * A basic error handling test.
     *
     * @return void
     */
    public function testBasicHandling()
    {
        Http::fake();

        $e = new Exception('Some throwable');
        $reporter = new SlackReporter();

        $this->assertFalse($reporter->handle($e));
    
        config()->set('enable', true);
        config()->set('slack_webhook_url', 'some webhook url');

        $this->assertTrue($reporter->handle($e));
    }
}