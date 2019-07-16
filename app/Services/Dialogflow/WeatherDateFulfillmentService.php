<?php

namespace App\Services\Dialogflow;

use App\Interfaces\DialogflowFulfillmentServiceInterface;

class WeatherDateFulfillmentService extends DialogflowFulfillmentService implements DialogflowFulfillmentServiceInterface
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
        $date = $this->parameters['date'];

        $dateWeather = get_date_weather($this->user['id'], $latitude, $longitude, $date);

        $summary = $dateWeather['summary'];
        $temperatureMin = $dateWeather['temperatureMin'];
        $temperatureMax = $dateWeather['temperatureMax'];
        $apparentTemperatureMin = $dateWeather['apparentTemperatureMin'];
        $apparentTemperatureMax = $dateWeather['apparentTemperatureMax'];
        $precipProbability = $dateWeather['precipProbability'];
        $precipProbabilityPercent = round((float)$precipProbability * 100) . '%';
        $precipIntensity = $dateWeather['precipIntensity'];
        $precipIntensityPercent = round((float)$precipIntensity * 100) . '%';
        $humidity = $dateWeather['humidity'];
        $humidityPercent = round((float)$humidity * 100) . '%';
        $windSpeed = $dateWeather['windSpeed'];
        $windGust = $dateWeather['windGust'];
        $pressure = $dateWeather['pressure'];
        if (array_key_exists('precipType', $dateWeather)) {
            $precipType = $dateWeather['precipType'];
            $precipTextResponse = 'Chance of ' . $precipType . ' is ' . $precipProbabilityPercent . ' with an intensity of ' .  $precipIntensityPercent . '. ';
        } else {
            $precipTextResponse = 'Chance of precipitation is 0%. ';
        }

        $summaryTextResponse = ucfirst(strtolower($summary . ' '));
        $temperatureTextResponse = 'Actual temperature is between ' . $temperatureMin . '°C and ' . $temperatureMax . '°C. ';
        $apparentTemperatureTextResponse = 'Apparent temperature is between ' . $apparentTemperatureMin . '°C and ' . $apparentTemperatureMax . '°C. ';
        $humidityTextResponse = 'Humidity is ' . $humidityPercent . '. ';
        $windTextResponse = 'Wind speed is at ' . $windSpeed . ' m/s with gusts at about ' . $windGust . ' m/s. ';
        $pressureTextResponse = 'Atmospheric pressure is ' . $pressure . ' hPa.';
        
        $this->textResponse = $summaryTextResponse . $temperatureTextResponse . $apparentTemperatureTextResponse . $precipTextResponse . $humidityTextResponse . $windTextResponse . $pressureTextResponse;
        
        return;
    }
}
