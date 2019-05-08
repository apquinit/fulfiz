<?php

namespace App\Services;

class HomeService
{
    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAppNameFromConfigurationFile()
    {
        return config('app.name');
    }
}
