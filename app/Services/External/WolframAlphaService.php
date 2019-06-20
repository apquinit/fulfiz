<?php

namespace App\Services\External;

use Log;
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
        
        $requestUrl = config('services.wolfram_alpha.base_url') . '?appid=' . config('services.wolfram_alpha.api_key') . '&i=' . $queryText . '&units=metric';
        $response  = $this->guzzleClient->get($requestUrl);
        $shortAnswer = $response->getBody()->getContents();

        Log::info('Wolfram Alpha Short Answer API fallback request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $shortAnswer]);

        return $shortAnswer;
    }
}
