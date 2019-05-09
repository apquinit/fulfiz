<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'pgsql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', getenv('DB_HOST') ? null : '127.0.0.1'),
            'port' => env('DB_PORT', getenv('DB_PORT') ? null : 5432),
            'database' => env('DB_DATABASE', getenv('DB_DATABASE') ? null : 'forge'),
            'username' => env('DB_USERNAME', getenv('DB_USERNAME') ? null : 'forge'),
            'password' => env('DB_PASSWORD', getenv('DB_PASSWORD') ? null : ''),
            'charset' => env('DB_CHARSET', getenv('DB_CHARSET') ? null : 'utf8'),
            'prefix' => env('DB_PREFIX', getenv('DB_PREFIX') ? null : ''),
            'schema' => env('DB_SCHEMA', getenv('DB_SCHEMA') ? null : 'public'),
            'sslmode' => env('DB_SSL_MODE', getenv('DB_SSL_MODE') ? null : 'prefer'),
        ],

    ],

    'migrations' => 'migrations',

];
