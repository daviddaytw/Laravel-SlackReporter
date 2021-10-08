<?php

namespace FelineStudio\SlackReporter;

use Illuminate\Support\Facades\Http;

use Throwable;

class SlackReporter
{
    /**
     * Handler the exception and send to Slack.
     * 
     * The request format follows Block Kit visual components of Slack.
     * 
     * @param Throwable $e - The exception to handle.
     */
    public function handle(Throwable $e) : void
    {
        Http::post(config('slack_webhook_url'), [
            'text' => config('name') . ' occured ' . $e->getMessage(),
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
