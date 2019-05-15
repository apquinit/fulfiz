<?php

namespace App\Services\External;

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

    public function getInstantAnswer($topic)
    {
        // DuckDuckGo Instant Answer request URL (https://api.duckduckgo.com/?q=artificial%20intelligence&format=json&no_redirect=1&no_html=1&skip_disambig=1)

        $requestUrl = config('api.duck_duck_go.base_url') . '/?q=' . $topic  . '&format=json&no_redirect=1&no_html=1&skip_disambig=1';
        $response  = $this->guzzleClient->get($requestUrl);
        $instantAnswer = json_decode($response->getBody()->getContents(), true);

        return $instantAnswer;
    }
}
