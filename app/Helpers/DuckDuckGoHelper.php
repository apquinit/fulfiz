<?php

use Log as Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Repositories\DuckDuckGoUserRepository;

if (!function_exists('get_instant_answer')) {

    /**
     * Get current weather of a given location by latitude and longitude.
     *
     * @param
     * @return
     */
    function get_instant_answer(string $userId, string $topic) : array
    {
        // DuckDuckGo request URL (https://api.duckduckgo.com/?q=QUERY&format=json&no_redirect=1&no_html=1&skip_disambig=1)

        if (strpos($userId, config('app.dialogflow.irene_lite')) !== false or strpos($userId, config('app.dialogflow.irene')) !== false) {
            $guzzleClient = new Client;
            $requestUrl = config('services.duck_duck_go.base_url') . '/?q=' . $topic  . '&format=json&no_redirect=1&no_html=1&skip_disambig=1';
            $response  = $guzzleClient->get($requestUrl);
            $content = json_decode($response->getBody()->getContents(), true);
            $instantAnswer = $content;
        } else {
            $duckDuckGoUserRepository = new DuckDuckGoUserRepository;
            $duckDuckGoUser = $duckDuckGoUserRepository->getByUserId((int) $userId);
            if ($duckDuckGoUser->status === 'ENABLED') {
                $guzzleClient = new Client;
                $requestUrl = config('services.duck_duck_go.base_url') . '/?q=' . $topic  . '&format=json&no_redirect=1&no_html=1&skip_disambig=1';
                $response  = $guzzleClient->get($requestUrl);
                $content = json_decode($response->getBody()->getContents(), true);
                $instantAnswer = $content;
            } elseif ($duckDuckGoUser->status === 'DISABLED') {
                abort(401, 'Service Disabled');
            } else {
                abort(500, 'Internal Server Error');
            }
        }
        
        Log::info('DuckDuckGo instant answer request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $instantAnswer]);
        
        return $instantAnswer;
    }
}
