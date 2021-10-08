<?php

namespace FelineStudio\SlackReporter;

use Illuminate\Support\Facades\Http;

use Throwable;

class SlackReporter
{
    /**
     * Handler the throwable.
     * 
     * If package is enabled and webhook_url is no null, the report would be send.
     * 
     * @param Throwable $e - The exception to handle.
     */
    public function handle(Throwable $e) : void
    {
        if(config('enable') && !is_null(config('slack_webhook_url'))) {
            $this->sendReport($e);
        }
    }

    /**
     * Send the throwable to Slack.
     * 
     * The request format follows Block Kit visual components of Slack.
     * 
     * @param Throwable $e - The exception to handle.
     */
    private function sendReport(Throwable $e) : void
    {
        Http::post(config('slack_webhook_url'), [
            'text' => config('name') . ' occured ' . get_class($e),
            'blocks' => [
                [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => $e->__toString()
                    ]
                ]
            ]
        ]);
    }
}
