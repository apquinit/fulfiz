<?php

namespace App\Services\External;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class DarkSkyService
{
    private $guzzleClient;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->guzzleClient = new Client;
    }

    public function getCurrentWeather($latitude, $longitude)
    {
        // Dark Sky forecast request URL (https://api.darksky.net/forecast/5a050170535218d28b85e8cad4e6f781/14.5906216,120.9799696?exclude=[minutely,hourly,daily,alerts,flags]&units=si)

        $exclude = '[minutely,hourly,daily,alerts,flags]';
        $requestUrl = config('api.dark_sky.base_url') . '/' . config('api.dark_sky.api_key') . '/' . $latitude . ',' . $longitude . '?exclude=' . $exclude . '&units=' . config('api.dark_sky.units');
        $response  = $this->guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $currentWeather = $content['currently'];
        
        return $currentWeather;
    }

    public function getWeatherByDate($latitude, $longitude, $date)
    {
        // Dark Sky forecast request URL (https://api.darksky.net/forecast/5a050170535218d28b85e8cad4e6f781/14.5906216,120.9799696,2019-05-10T12:00:00+08:00?exclude=[minutely,hourly,daily,alerts,flags]&units=si)

        $exclude = '[minutely,hourly,daily,alerts,flags]';
        $requestUrl = config('api.dark_sky.base_url') . '/' . config('api.dark_sky.api_key') . '/' . $latitude . ',' . $longitude . ',' . $date . '?exclude=' . $exclude . '&units=' . config('api.dark_sky.units');
        $response  = $this->guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $dateWeather = $content['currently'];
        
        return $dateWeather;
    }
}
