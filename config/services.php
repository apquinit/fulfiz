<?php

return [
    'location_iq' => [
        'base_url' => 'https://us1.locationiq.com/v1/search.php',
        'api_key' => env('API_LOCATION_IQ_KEY', getenv('API_LOCATION_IQ_KEY') ? null : null)
    ],

    'dark_sky' => [
        'base_url' => 'https://api.darksky.net/forecast',
        'api_key' => env('API_DARK_SKY_KEY', getenv('API_DARK_SKY_KEY') ? null : null),
        'units' => 'si',
    ],

    'duck_duck_go' => [
        'base_url' => 'https://api.duckduckgo.com',
    ],

    'wolfram_alpha' => [
        'base_url' => 'https://api.wolframalpha.com/v1/result',
        'api_key' => env('API_WOLFRAM_ALPHA_KEY', getenv('API_WOLFRAM_ALPHA_KEY') ? null : null),
    ],

    'timezone_db' => [
        'base_url' => 'https://api.timezonedb.com/v2.1/get-time-zone',
        'api_key' => env('API_TIMEZONE_DB_KEY', getenv('API_TIMEZONE_DB_KEY') ? null : null),
    ],

    'autoremote' => [
        'base_url' => 'https://autoremotejoaomgcd.appspot.com/sendmessage',
        'api_key' => env('API_AUTOREMOTE_KEY', getenv('API_AUTOREMOTE_KEY') ? null : null),
    ],

    'pushbullet' => [
        'base_url' => 'https://api.pushbullet.com/v2',
        'api_key' => env('API_PUSHBULLET_KEY', getenv('API_PUSHBULLET_KEY') ? null : null),
    ]
];
