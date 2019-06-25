<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DialogflowFulfillmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('DateTimeCurrentFulfillmentService', function ($app) {
            return new \App\Services\Dialogflow\DateTimeCurrentFulfillmentService;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
