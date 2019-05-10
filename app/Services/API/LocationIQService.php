<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class LocationIQService
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

    public function getLatitudeAndLongitude($cityName)
    {
        // Location IQ request URL (https://us1.locationiq.com/v1/search.php?key=YOUR_PRIVATE_TOKEN&q=SEARCH_STRING&format=json)

        $requestUrl = config('api.location_iq.base_url') . '?key=' . config('api.location_iq.api_key') . '&q=' . $cityName . '&format=json';
        $response  = $this->guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $location = [
            'lat' => $content[0]['lat'],
            'lon' => $content[0]['lon'],
        ];

        return $location;
    }
}
