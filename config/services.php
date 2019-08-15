<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'location_iq' => [
        'base_url' => env('LOCATION_IQ_URL'),
        'api_key' => env('LOCATION_IQ_KEY')
    ],

    'dark_sky' => [
        'base_url' => env('DARK_SKY_URL'),
        'api_key' => env('DARK_SKY_KEY'),
        'units' => 'si',
    ],
    
    'duck_duck_go' => [
        'base_url' => env('DUCK_DUCK_GO_URL'),
    ],

    'wolfram_alpha' => [
        'base_url' => env('WOLFRAM_ALPHA_URL'),
        'api_key' => env('WOLFRAM_ALPHA_KEY'),
        'units' => 'metric',
    ],

    'timezone_db' => [
        'base_url' => env('TIMEZONE_DB_URL'),
        'api_key' => env('TIMEZONE_DB_KEY'),
    ],

    'autoremote' => [
        'base_url' => env('AUTOREMOTE_URL'),
        'api_key' => env('AUTOREMOTE_KEY'),
    ],

    'pushbullet' => [
        'base_url' => env('PUSHBULLET_URL'),
        'api_key' => env('PUSHBULLET_KEY'),
        'channel' => env('PUSHBULLET_CHANNEL', 'irene'),
    ]

];
