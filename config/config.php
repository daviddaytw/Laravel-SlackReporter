<?php

return [

    /**
     * The Application name
     */
    'name' => config('app.name'),

    /**
     * Option to enable reporter.
     * The package would only send report when in production by default.
     * 
     */
    'enable' => (config('app.env') == 'production'),

    /**
     * The URL of Slack incoming webhook. 
     */
    'slack_webhook_url' => '',
];