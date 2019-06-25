<?php

use Log as Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

if (!function_exists('get_latitude_and_longitude')) {

    /**
     * Get latitude and langitude of a city.
     *
     * @param
     * @return
     */
    function get_latitude_and_longitude(string $city) : array
    {
        // Location IQ request URL (https://us1.locationiq.com/v1/search.php?key=YOUR_PRIVATE_TOKEN&q=SEARCH_STRING&format=json)

        $guzzleClient = new Client;

        $requestUrl = config('services.location_iq.base_url') . '?key=' . config('services.location_iq.api_key') . '&q=' . $city . '&format=json';
        $response  = $guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $location = [
            'lat' => $content[0]['lat'],
            'lon' => $content[0]['lon'],
        ];
        
        Log::info('Location IQ latitude and longitude request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $location]);
        
        return $location;
    }
}
