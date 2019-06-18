<?php

namespace App\Services\Dialogflow\External;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class WolframAlphaService
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

    public function getShortAnswer(string $queryText) : string
    {
        // Short Answer request URL (https://api.wolframalpha.com/v1/result?appid=DEMO&i=QUERY)
        
        $requestUrl = config('api.wolfram_alpha.base_url') . '?appid=' . config('api.wolfram_alpha.api_key') . '&i=' . $queryText . '&units=metric';
        $response  = $this->guzzleClient->get($requestUrl);
        $shortAnswer = $response->getBody()->getContents();

        return $shortAnswer;
    }
}
