<?php

use Log as Log;
use GuzzleHttp\Client;
use App\Repositories\LocationIqUserRepository;

if (!function_exists('get_latitude_and_longitude')) {

    /**
     * Get latitude and langitude of a city.
     *
     * @param
     * @return
     */
    function get_latitude_and_longitude(string $userId, string $city) : array
    {
        // Location IQ request URL (https://us1.locationiq.com/v1/search.php?key=YOUR_PRIVATE_TOKEN&q=SEARCH_STRING&format=json)

        if (strpos($userId, config('app.dialogflow.irene_lite')) !== false or strpos($userId, config('app.dialogflow.irene')) !== false) {
            $key = config('services.location_iq.api_key');
        } else {
            $locationIqUserRepository = new LocationIqUserRepository;
            $locationIqUser = $locationIqUserRepository->getByUserId((int) $userId);

            if ($locationIqUser->status === 'ENABLED') {
                $key = $locationIqUser->token;
            } elseif ($locationIqUser->status === 'DISABLED') {
                abort(401, 'Service Disabled');
            } else {
                abort(500, 'Internal Server Error');
            }
        }

        $guzzleClient = new Client;
        $requestUrl = config('services.location_iq.base_url') . '?key=' . $key . '&q=' . $city . '&format=json';
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
