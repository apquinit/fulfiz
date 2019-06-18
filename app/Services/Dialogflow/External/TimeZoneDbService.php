<?php

namespace App\Services\Dialogflow\External;

use Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class TimeZoneDbService
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

    public function getCurrentDateTime(float $latitude, float $longitude) : string
    {
        // Location IQ request URL (https://api.timezonedb.com/v2.1/get-time-zone?key=0RPFRW3KR7BJ&format=json&by=position&lat=14.5906216&lng=120.9799696)
        
        $requestUrl = config('api.timezone_db.base_url') . '?key=' . config('api.timezone_db.api_key') . '&format=json&by=position&lat=' . $latitude . '&lng=' . $longitude;
        $response  = $this->guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $currentDateTime = $content['formatted'];

        Log::info('Timezone DB API current date and time request', [
            'Status' => $response->getStatusCode(),
            'Request' => $requestUrl,
            'Response' => $currentDateTime
            ]
        );

        return $currentDateTime;
    }
}
