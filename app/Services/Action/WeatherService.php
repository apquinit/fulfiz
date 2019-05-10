<?php

namespace App\Services\Action;

use App\Services\External\LocationIQService;
use App\Services\External\DarkSkyService;

class WeatherService
{
    private $locationIqService;
    private $darkSkyService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->locationIqService = new LocationIQService;
        $this->darkSkyService = new DarkSkyService;
    }
}
