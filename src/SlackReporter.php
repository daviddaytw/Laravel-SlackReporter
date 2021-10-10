<?php

namespace FelineStudio\SlackReporter;

use Illuminate\Support\Facades\Http;

use Throwable;

class SlackReporter
{
    /**
     * Handler the throwable.
     * 
     * If package is enabled environment and webhook_url is no null, the report would be send.
     * 
     * @param Throwable $e - The exception to handle.
     * 
     * @return bool - Did the report sent successfully.
     */
    public function handle(Throwable $e) : bool
    {
        if(config('slack-reporter.env') == config('app.env') && !empty(config('slack-reporter.webhook_url'))) {
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
        $title =  config('app.name') . ' occured ' . get_class($e);
        $response = Http::post(config('slack-reporter.webhook_url'), [
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
                        'text' => '*Message:* `' . str_replace('`', '\'', $e->getMessage()) . '`',
                    ]
                ]
            ]
        ]);
        return $response->status() == 200;
    }
}
