<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class JokeService
{
    private $guzzleClient;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Client $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function getJoke()
    {
        $request  = $this->guzzleClient->get(config('api.official-joke.url'));
        $statusCode = $request->getStatusCode();
        $content = json_decode($request->getBody()->getContents());
        $joke = $content->setup . ' ' . $content->punchline;

        return str_replace(array("\n ", "\r"), '', $joke);
    }

}
