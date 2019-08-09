<?php

use Log as Log;
use GuzzleHttp\Client;
use App\Repositories\DarkSkyUserRepository;

if (!function_exists('get_current_weather')) {

    /**
     * Get current weather of a given location by latitude and longitude.
     *
     * @param
     * @return
     */
    function get_current_weather(string $userId, float $latitude, float $longitude) : array
    {
        // Dark Sky request URL (https://api.darksky.net/forecast/YOUR_PRIVATE_TOKEN/14.5906216,120.9799696?exclude=[minutely,hourly,daily,alerts,flags]&units=si)

        if (strpos($userId, config('app.dialogflow.irene_lite')) !== false or strpos($userId, config('app.dialogflow.irene')) !== false) {
            $key = config('services.dark_sky.api_key');
        } else {
            $darkSkyUserRepository = new DarkSkyUserRepository;
            $darkSkyUser = $darkSkyUserRepository->getByUserId((int) $userId);

            if ($darkSkyUser->status === 'ENABLED') {
                $key = $darkSkyUser->token;
            } elseif ($darkSkyUser->status === 'DISABLED') {
                abort(401, 'Service Disabled');
            } else {
                abort(500, 'Internal Server Error');
            }
        }

        $guzzleClient = new Client;
        $requestUrl = config('services.dark_sky.base_url') . '/' . $key . '/' . $latitude . ',' . $longitude . '?exclude=[minutely,hourly,daily,alerts,flags]' . '&units=' . config('services.dark_sky.units');
        $response  = $guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $currentWeather = $content['currently'];
        
        Log::info('Dark Sky current weather request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $currentWeather]);
        
        return $currentWeather;
    }
}

if (!function_exists('get_date_weather')) {

    /**
     * Get current weather of a given location by latitude and longitude.
     *
     * @param
     * @return
     */
    function get_date_weather(string $userId, float $latitude, float $longitude, string $date) : array
    {
        // Dark Sky request URL (https://api.darksky.net/forecast/YOUR_PRIVATE_TOKEN/14.5906216,120.9799696,2019-07-16T12:00:00+08:00?exclude=[minutely,hourly,daily,alerts,flags]&units=si)

        if (strpos($userId, config('app.dialogflow.irene_lite')) !== false or strpos($userId, config('app.dialogflow.irene')) !== false) {
            $key = config('services.dark_sky.api_key');
        } else {
            $darkSkyUserRepository = new DarkSkyUserRepository;
            $darkSkyUser = $darkSkyUserRepository->getByUserId((int) $userId);

            if ($darkSkyUser->status === 'ENABLED') {
                $key = $darkSkyUser->token;
            } elseif ($darkSkyUser->status === 'DISABLED') {
                abort(401, 'Service Disabled');
            } else {
                abort(500, 'Internal Server Error');
            }
        }

        $guzzleClient = new Client;
        $requestUrl = config('services.dark_sky.base_url') . '/' . $key . '/' . $latitude . ',' . $longitude . ',' . $date . '?exclude=[currently,minutely,hourly,alerts,flags]' . '&units=' . config('services.dark_sky.units');
        $response  = $guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $dateWeather = $content['daily']['data'][0];
        
        Log::info('Dark Sky weather by date request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $dateWeather]);
        
        return $dateWeather;
    }
}
