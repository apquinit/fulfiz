<?php

namespace App\Services\Dialogflow;

use App\Interfaces\DialogflowFulfillmentServiceInterface;

class WeatherCurrentFulfillmentService extends DialogflowFulfillmentService implements DialogflowFulfillmentServiceInterface
{
    public function setParameters(array $user, array $parameters) : void
    {
        $this->user = $user;
        $this->parameters = $parameters;
    }

    public function getTextResponse() : string
    {
        return $this->textResponse;
    }

    public function process() : void
    {
        $location = get_latitude_and_longitude($this->user['id'], $this->parameters['city']);
        
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        $currentWeather = get_current_weather($this->user['id'], $latitude, $longitude);

        $summary = $currentWeather['summary'];
        $temperature = $currentWeather['temperature'];
        $apparentTemperature = $currentWeather['apparentTemperature'];
        $precipProbability = $currentWeather['precipProbability'];
        $precipProbabilityPercent = round((float)$precipProbability * 100) . '%';
        $precipIntensity = $currentWeather['precipIntensity'];
        $precipIntensityPercent = round((float)$precipIntensity * 100) . '%';
        $humidity = $currentWeather['humidity'];
        $humidityPercent = round((float)$humidity * 100) . '%';
        $windSpeed = $currentWeather['windSpeed'];
        $windGust = $currentWeather['windGust'];
        $pressure = $currentWeather['pressure'];
        if (array_key_exists('precipType', $currentWeather)) {
            $precipType = $currentWeather['precipType'];
            $precipTextResponse = 'Chance of ' . $precipType . ' is ' . $precipProbabilityPercent . ' with an intensity of ' .  $precipIntensityPercent . '. ';
        } else {
            $precipTextResponse = 'Chance of precipitation is 0%. ';
        }

        $summaryTextResponse = ucfirst(strtolower($summary . '. '));
        $temperatureTextResponse = 'Actual temperature is ' . $temperature . '°C. ';
        $apparentTemperatureTextResponse = 'Apparent temperature is ' . $apparentTemperature . '°C. ';
        $humidityTextResponse = 'Humidity is ' . $humidityPercent . '. ';
        $windTextResponse = 'Wind speed is at ' . $windSpeed . ' m/s with gusts at about ' . $windGust . ' m/s. ';
        $pressureTextResponse = 'Atmospheric pressure is ' . $pressure . ' hPa.';

        $this->textResponse = $summaryTextResponse . $temperatureTextResponse . $apparentTemperatureTextResponse . $precipTextResponse . $humidityTextResponse . $windTextResponse . $pressureTextResponse;
        
        return;
    }
}
