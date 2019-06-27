<?php

use Log as Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Repositories\TimeZoneDbUserRepository;

if (!function_exists('get_current_date_time')) {

    /**
     * Get current date and time of a city by latitude and longitude.
     *
     * @param
     * @return
     */
    function get_current_date_time(string $userId, float $latitude, float $longitude) : string
    {
        // TimeZoneDb request URL (https://api.timezonedb.com/v2.1/get-time-zone?key=YOUR_PRIVATE_TOKEN&format=json&by=position&lat=YOUR_LATITUDE&lng=YOUR_LONGITUDE)

        if (strpos($userId, config('app.dialogflow.irene_lite')) !== false or strpos($userId, config('app.dialogflow.irene')) !== false) {
            $key = config('services.location_iq.api_key');
        } else {
            $timeZoneDbUserRepository = new TimeZoneDbUserRepository;
            $timeZoneDbUser = $timeZoneDbUserRepository->getByUserId($userId);

            if ($timeZoneDbUser->status === 'ENABLED') {
                $key = $timeZoneDbUser->token;
            } elseif ($timeZoneDbUser->status === 'DISABLED')  {
                abort(401, 'Service Disabled');
            } else {
                abort(500, 'Internal Server Error');
            }
        }

        $guzzleClient = new Client;
        $requestUrl = config('services.timezone_db.base_url') . '?key=' . $key . '&format=json&by=position&lat=' . $latitude . '&lng=' . $longitude;
        $response  = $guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $currentDateTime = $content['formatted'];

        Log::info('Timezone DB current date and time request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $currentDateTime]);

        return $currentDateTime;
    }
}
