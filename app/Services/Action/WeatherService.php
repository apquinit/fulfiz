<?php

namespace App\Services\Action;

use App\Services\External\LocationIQService;
use App\Services\External\DarkSkyService;

class WeatherService
{
    public function getCurrentWeatherTextResponse($cityName)
    {
        // 1. Get latitude and longitude from Location IQ Service by city name.
        $location = $this->getLatitudeAndLongitudeFromLocationIqService($cityName);
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        // 2. Get weather data from Dark Sky Service by latitude and longitude
        $weather = $this->getCurrentWeatherFromDarkSkyService($latitude, $longitude);

        // 3. Assemble text response from weather data.
        $textResponse = $this->setTextResponse($weather);

        return $textResponse;
    }

    public function getWeatherByDateTextResponse($cityName, $date)
    {
        // 1. Get latitude and longitude from Location IQ Service by city name.
        $location = $this->getLatitudeAndLongitudeFromLocationIqService($cityName);
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        // 2. Get weather data from Dark Sky Service by latitude and longitude
        $weather = $this->getWeatherByDateFromDarkSkyService($latitude, $longitude, $date);

        // 3. Assemble text response from weather data.
        $textResponse = $this->setTextResponse($weather);

        return $textResponse;
    }

    private function getLatitudeAndLongitudeFromLocationIqService($cityName)
    {
        $locationIqService = new LocationIQService;
        return $locationIqService->getLatitudeAndLongitude($cityName);
    }

    private function getCurrentWeatherFromDarkSkyService($latitude, $longitude)
    {
        $darkSkyService = new DarkSkyService;
        return $darkSkyService->getCurrentWeather($latitude, $longitude);
    }

    private function getWeatherByDateFromDarkSkyService($latitude, $longitude, $date)
    {
        $darkSkyService = new DarkSkyService;
        return $darkSkyService->getWeatherByDate($latitude, $longitude, $date);
    }

    private function setTextResponse($weather)
    {
        $summary = $weather['summary'];
        $temperature = $weather['temperature']; // Degrees Celsius.
        $apparentTemperature = $weather['apparentTemperature']; // Degrees Celsius.
        $humidity = $weather['humidity']; // Percentage.
        $humidityPercent = round((float)$humidity * 100) . '%';
        $pressure = $weather['pressure']; // Hectopascals.
        $windSpeed = $weather['windSpeed']; // Meters per second.
        $windGust = $weather['windGust']; // Meters per second.

        $summaryTextResponse = $summary . '. ';
        $temperatureTextResponse = 'Actual temperature is ' . $temperature . ' degrees celsius. ';
        $apparentTemperatureTextResponse = 'Apparent temperature is ' . $apparentTemperature . ' degrees celsius. ';
        $humidityTextResponse = 'Humidity is ' . $humidityPercent . ' percent. ';
        $windTextResponse = 'Wind speed is currently at ' . $windSpeed . ' with a gust of ' . $windGust . ' meters per second. ';
        $pressureTextResponse = 'Atmospheric pressure is ' . $pressure . ' hectopascals.';

        $textResponse = $summaryTextResponse . $temperatureTextResponse . $apparentTemperatureTextResponse . $humidityTextResponse . $windTextResponse . $pressureTextResponse;

        return $textResponse;
    }
}
