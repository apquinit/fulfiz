<?php

namespace App\Services\Action;

use App\Interfaces\ActionServiceInterface;
use App\Services\External\LocationIQService;
use App\Services\External\DarkSkyService;

class WeatherByDateService implements ActionServiceInterface
{
    private $cityName;
    private $date;

    public function __construct($cityName, $date)
    {
        $this->cityName = $cityName;
        $this->date = $date;
    }

    public function getTextResponse()
    {
        // 1. Get latitude and longitude from Location IQ Service by city name.
        $location = $this->getLatitudeAndLongitudeFromLocationIqService();
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        // 2. Get weather data from Dark Sky Service by latitude and longitude
        $weather = $this->getWeatherByDateFromDarkSkyService($latitude, $longitude);

        // 3. Assemble text response from weather data.
        $textResponse = $this->setTextResponse($weather);

        return $textResponse;
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
        $temperatureTextResponse = 'Actual temperature is ' . $temperature . ' °C. ';
        $apparentTemperatureTextResponse = 'Apparent temperature is ' . $apparentTemperature . ' °C. ';
        $humidityTextResponse = 'Humidity is ' . $humidityPercent . '. ';
        $windTextResponse = 'Wind speed is at ' . $windSpeed . ' m/s with a gust of ' . $windGust . ' m/s. ';
        $pressureTextResponse = 'Atmospheric pressure is ' . $pressure . ' hPa.';

        $textResponse = $summaryTextResponse . $temperatureTextResponse . $apparentTemperatureTextResponse . $humidityTextResponse . $windTextResponse . $pressureTextResponse;

        return $textResponse;
    }

    private function getLatitudeAndLongitudeFromLocationIqService()
    {
        $locationIqService = new LocationIQService;

        return $locationIqService->getLatitudeAndLongitude($this->cityName);
    }

    private function getWeatherByDateFromDarkSkyService($latitude, $longitude)
    {
        $darkSkyService = new DarkSkyService;
        
        return $darkSkyService->getWeatherByDate($latitude, $longitude, $this->date);
    }
}
