<?php

namespace App\Services\Dialogflow;

use Dialogflow\WebhookClient;
use App\Interfaces\DialogflowServiceInterface;
use App\Services\External\LocationIqService;
use App\Services\External\DarkSkyService;

class CurrentWeatherService implements DialogflowServiceInterface
{
    private $agent;

    public function __construct(WebhookClient $agent)
    {
        $this->agent = $agent;
    }

    public function process() : WebhookClient
    {
        // Get parameters from agent
        $parameters = $this->agent->getParameters();

        // Get latitude and longitude from Location IQ Service by city name.
        $location = $this->getLatitudeAndLongitudeFromLocationIqService($parameters['city']);
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        // Get weather data from Dark Sky Service by latitude and longitude
        $weather = $this->getCurrentWeatherFromDarkSkyService($latitude, $longitude);

        // Assemble text response from weather data.
        $textResponse = $this->assembleTextResponse($weather);

        return $this->agent->reply($textResponse);
    }

    private function assembleTextResponse(array $weather) : string
    {
        $summary = $weather['summary'];
        $temperature = $weather['temperature']; // Degrees Celsius.
        $apparentTemperature = $weather['apparentTemperature']; // Degrees Celsius.
        $precipProbability = $weather['precipProbability']; // Percentage.
        $precipProbabilityPercent = round((float)$precipProbability * 100) . '%';
        $precipIntensity = $weather['precipIntensity']; // Percentage.
        $precipIntensityPercent = round((float)$precipIntensity * 100) . '%';
        $humidity = $weather['humidity']; // Percentage.
        $humidityPercent = round((float)$humidity * 100) . '%';
        $windSpeed = $weather['windSpeed']; // Meters per second.
        $windGust = $weather['windGust']; // Meters per second.
        $pressure = $weather['pressure']; // Hectopascals.

        if (array_key_exists('precipType', $weather)) {
            $precipType = $weather['precipType'];
            $precipTextResponse = 'Chance of ' . $precipType . ' is ' . $precipProbabilityPercent . ' with an intensity of ' .  $precipIntensityPercent . '. ';
        } else {
            $precipTextResponse = 'Chance of precipitation is 0%. ';
        }

        $summaryTextResponse = $summary . '. ';
        $temperatureTextResponse = 'Actual temperature is ' . $temperature . '°C. ';
        $apparentTemperatureTextResponse = 'Apparent temperature is ' . $apparentTemperature . '°C. ';
        $humidityTextResponse = 'Humidity is ' . $humidityPercent . '. ';
        $windTextResponse = 'Wind speed is at ' . $windSpeed . ' m/s with gusts at about ' . $windGust . ' m/s. ';
        $pressureTextResponse = 'Atmospheric pressure is ' . $pressure . ' hPa.';

        $textResponse = $summaryTextResponse . $temperatureTextResponse . $apparentTemperatureTextResponse . $precipTextResponse . $humidityTextResponse . $windTextResponse . $pressureTextResponse;

        return $textResponse;
    }

    private function getLatitudeAndLongitudeFromLocationIqService(string $city) : array
    {
        $locationIqService = new LocationIqService;

        return $locationIqService->getLatitudeAndLongitude($city);
    }

    private function getCurrentWeatherFromDarkSkyService(float $latitude, float $longitude) : array
    {
        $darkSkyService = new DarkSkyService;
        
        return $darkSkyService->getCurrentWeather($latitude, $longitude);
    }
}
