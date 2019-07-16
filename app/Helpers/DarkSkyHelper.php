<?php

use Log as Log;
use GuzzleHttp\Exception\GuzzleException;
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
