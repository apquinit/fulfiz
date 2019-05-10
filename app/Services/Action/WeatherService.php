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

    public function actionCurrentWeather($cityName)
    {
        // 1. Get latitude and longitude from Location IQ Service by city name.
        $location = $this->getLatitudeAndLongitudeFromLocationService($cityName);
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        // 2. Get weather data from Dark Sky Service by latitude and longitude
        // 3. Assemble text response from weather data.

        $textResponse = 'The weather forecast calls for...';
    }

    public function actionWeatherByDate($cityName, $date)
    {
        // 1. Get latitude and longitude from Location IQ Service by city name.
        // 2. Get weather data from Dark Sky Service by latitude, longitude and date.
        // 3. Assemble text response from weather data.

        $textResponse = 'The weather forecast calls for...';
    }

    private function getLatitudeAndLongitudeFromLocationService($cityName)
    {
        return $this->locationIqService->getLatitudeAndLongitude($cityName);
    }

}
