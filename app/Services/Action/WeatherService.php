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
        $location = $this->getLatitudeAndLongitudeFromLocationIqService($cityName);
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        // 2. Get weather data from Dark Sky Service by latitude and longitude
        $weather = $this->getCurrentWeatherFromDarkSkyService($latitude, $longitude);

        // 3. Assemble text response from weather data.
        $summary = $weather['summary'];
        $temperature = $weather['temperature']; //Degrees Celsius.
        $apparentTemperature = $weather['apparentTemperature']; //Degrees Celsius.
        $humidity = $weather['humidity']; //Percentage.
        $humidityPercent = round((float)$humidity * 100 ) . '%';
        $pressure = $weather['pressure']; //Hectopascals.
        $windSpeed = $weather['windSpeed']; //Meters per second.
        $windGust = $weather['windGust']; //Meters per second.

        $summaryTextResponse = 'The weather forecast calls for ' . $summary . '. ';
        $temperatureTextResponse = 'Actual temperature is ' . $temperature . ' degrees celsius. ';
        $apparentTemperatureTextResponse = 'Apparent temperature is ' . $apparentTemperature . ' degrees celsius. ';
        $humidityTextResponse = 'Humidity is ' . $humidityPercent . ' percent. ';
        $windTextResponse = 'Wind speed is currently at ' . $windSpeed . ' with a gust of ' . $windGust . ' meters per second. ';
        $pressureTextResponse = 'Atmospheric pressure is ' . $pressure . ' hectopascals. ';

        $textResponse = $summaryTextResponse . $temperatureTextResponse . $apparentTemperatureTextResponse . $humidityTextResponse . $windTextResponse . $pressureTextResponse;

        return $textResponse;
    }

    public function actionWeatherByDate($cityName, $date)
    {
        // 1. Get latitude and longitude from Location IQ Service by city name.
        // 2. Get weather data from Dark Sky Service by latitude, longitude and date.
        // 3. Assemble text response from weather data.

        $textResponse = 'The weather forecast calls for...';
    }

    private function getLatitudeAndLongitudeFromLocationIqService($cityName)
    {
        return $this->locationIqService->getLatitudeAndLongitude($cityName);
    }

    private function getCurrentWeatherFromDarkSkyService($latitude, $longitude)
    {
        return $this->darkSkyService->getCurrentWeather($latitude, $longitude);
    }
}
