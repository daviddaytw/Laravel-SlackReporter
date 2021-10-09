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
     * 
     * @return bool - Did the report sent successfully.
     */
    public function handle(Throwable $e) : bool
    {
        if(config('enable') && !empty(config('slack_webhook_url'))) {
            return $this->sendReport($e);
        }
        return false;
    }

    /**
     * Send the throwable to Slack.
     * 
     * The request format follows Block Kit visual components of Slack.
     * 
     * @param Throwable $e - The exception to handle.
     * 
     * @return bool - Did the request sent successfully.
     */
    private function sendReport(Throwable $e) : bool
    {
        $title =  config('name') . ' occured ' . get_class($e);
        $response = Http::post(config('slack_webhook_url'), [
            'text' => $title,
            'blocks' => [
                [
                    'type' => 'header',
                    'text' => [
                        'type' => 'plain_text',
                        'text' => $title
                    ]
                ],
                [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => "*Message:* {$e->getMessage()}",
                    ]
                ],
                [
                    'type' => 'section',
                    'text' => [
                        "type" => "mrkdwn",
                        "text" => "*StackTrace:*\n```\n{$e->getTraceAsString()}```\n"
                    ]
                ]
            ]
        ]);
        return $response->status() == 200;
    }
}
