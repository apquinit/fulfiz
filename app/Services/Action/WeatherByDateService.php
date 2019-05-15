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
        if (array_key_exists('precipType', $weather)) {
            $precipType = $weather['precipType'];
        } else {
            $precipType = 'precipitation';
        }
        
        $summary = $weather['summary'];
        $temperatureMin = $weather['temperatureMin']; // Degrees Celsius.
        $temperatureMax = $weather['temperatureMax']; // Degrees Celsius
        $apparentTemperatureMin = $weather['apparentTemperatureMin']; // Degrees Celsius.
        $apparentTemperatureMax = $weather['apparentTemperatureMax']; // Degrees Celsius.
        $precipProbability = $weather['precipProbability']; // Percentage.
        $precipProbabilityPercent = round((float)$precipProbability * 100) . '%';
        $precipIntensity = $weather['precipIntensity']; // Percentage.
        $precipIntensityPercent = round((float)$precipIntensity * 100) . '%';
        $humidity = $weather['humidity']; // Percentage.
        $humidityPercent = round((float)$humidity * 100) . '%';
        $windSpeed = $weather['windSpeed']; // Meters per second.
        $windGust = $weather['windGust']; // Meters per second.
        $pressure = $weather['pressure']; // Hectopascals.

        $summaryTextResponse = $summary . ' ';
        $temperatureTextResponse = 'Actual temperature is between ' . $temperatureMin . '°C and ' . $temperatureMax . '°C. ';
        $apparentTemperatureTextResponse = 'Apparent temperature is between ' . $apparentTemperatureMin . '°C and ' . $apparentTemperatureMax . '°C. ';
        $precipTextResponse = 'Chance of ' . $precipType . ' is ' . $precipProbabilityPercent . ' with an intensity of ' .  $precipIntensityPercent . '. ';
        $humidityTextResponse = 'Humidity is ' . $humidityPercent . '. ';
        $windTextResponse = 'Wind speed is at ' . $windSpeed . ' m/s with gusts at about ' . $windGust . ' m/s. ';
        $pressureTextResponse = 'Atmospheric pressure is ' . $pressure . ' hPa.';

        $textResponse = $summaryTextResponse . $temperatureTextResponse . $apparentTemperatureTextResponse . $precipTextResponse . $humidityTextResponse . $windTextResponse . $pressureTextResponse;

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
