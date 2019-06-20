<?php

namespace App\Services\External;

use Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class DuckDuckGoService
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

    public function getInstantAnswer(string $topic) : array
    {
        // DuckDuckGo Instant Answer request URL (https://api.duckduckgo.com/?q=artificial%20intelligence&format=json&no_redirect=1&no_html=1&skip_disambig=1)

        $requestUrl = config('services.duck_duck_go.base_url') . '/?q=' . $topic  . '&format=json&no_redirect=1&no_html=1&skip_disambig=1';
        $response  = $this->guzzleClient->get($requestUrl);
        $instantAnswer = json_decode($response->getBody()->getContents(), true);

        Log::info('DuckDuckGo Instant Answer API topic request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $instantAnswer]);

        return $instantAnswer;
    }
}
