<?php

use Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

if (!function_exists('get_current_date_time')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function get_current_date_time(float $latitude, float $longitude) : string
    {
        // Location IQ request URL (https://api.timezonedb.com/v2.1/get-time-zone?key=0RPFRW3KR7BJ&format=json&by=position&lat=14.5906216&lng=120.9799696)

        $guzzleClient = new Client;

        if (is_null(config('services.timezone_db.base_url')))
        {
            Log::error('Timezone DB base url is null.');
            abort(500, 'Internal Server Error');
        }

        if (is_null(config('services.timezone_db.api_key')))
        {
            Log::error('Timezone DB API key is null.');
            abort(500, 'Internal Server Error');
        }
        
        $requestUrl = config('services.timezone_db.base_url') . '?key=' . config('services.timezone_db.api_key') . '&format=json&by=position&lat=' . $latitude . '&lng=' . $longitude;
        $response  = $guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $currentDateTime = $content['formatted'];

        Log::info('Timezone DB current date and time request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $currentDateTime]);

        return $currentDateTime;
    }
}
