<?php

use Log as Log;
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
        
        if ($userId === config('app.dialogflow.irene_lite')) {
            $key = config('services.timezone_db.api_key');
        } else {
            $timeZoneDbUserRepository = new TimeZoneDbUserRepository;
            $timeZoneDbUser = $timeZoneDbUserRepository->getByUserId((int) $userId);

            if ($timeZoneDbUser->status === 'ENABLED') {
                if (empty($timeZoneDbUser->token)) {
                    abort(500, 'Internal server error.');
                }
                $key = $timeZoneDbUser->token;
            } elseif ($timeZoneDbUser->status === 'DISABLED') {
                abort(403, 'Service disabled.');
            } else {
                abort(500, 'Internal server error.');
            }
        }

        $guzzleClient = new Client;
        $requestUrl = config('services.timezone_db.base_url') . '?key=' . $key . '&format=json&by=position&lat=' . $latitude . '&lng=' . $longitude;

        try {
            $response  = $guzzleClient->get($requestUrl);
        } catch (\Exception $e) {
            abort(500, 'Internal server error.');
        }

        $content = json_decode($response->getBody()->getContents(), true);
        $currentDateTime = $content['formatted'];

        Log::info('TimeZoneDB current date and time request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $currentDateTime]);

        return $currentDateTime;
    }
}
