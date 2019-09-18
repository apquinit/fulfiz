<?php

use Log as Log;
use GuzzleHttp\Client;

if (!function_exists('get_facebook_graph_user_name')) {

    /**
     * Get Facebook name of a user.
     *
     * @param
     * @return
     */
    function get_facebook_graph_user_name(string $psid) : string
    {
        // Facebook Graph user profile request URL (https://graph.facebook.com/PSID?fields=name&access_token=PAGE_ACCESS_KEY)

        $guzzleClient = new Client;
        $requestUrl = config('services.facebook_graph.base_url') . '/' . $psid . '?fields=name' . '&access_token=' . config('services.facebook_graph.api_key');
        $response  = $guzzleClient->get($requestUrl);
        $content = json_decode($response->getBody()->getContents(), true);
        $userName = $content['name'];
        
        Log::info('Facebook Graph user profile request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $userName]);
        
        return $userName;
    }
}
