<?php

namespace App\Services;

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
        // Dark Sky forecast request URL (https://api.darksky.net/forecast/5a050170535218d28b85e8cad4e6f781/14.5906216,120.9799696?exclude=[minutely,hourly,daily,alerts,flags])

        $exclude = '[minutely,hourly,daily,alerts,flags]';
        $requestUrl = config('api.dark_sky.base_url') . '/' . config('api.dark_sky.api_key') . '/' . $latitude . ',' . $longitude . '?exclude=' . $exclude;
        $response  = $this->guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $currentWeather = $content['currently'];
        
        return $currentWeather;
    }
}
