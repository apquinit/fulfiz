<?php

namespace App\Services\External;

use Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class PushbulletService
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

    public function pushNoteToChannel(string $channelTag, string $message) : int
    {
        // Pushbullet request URL (https://api.pushbullet.com/v2/pushes)
        
        $requestUrl = config('api.pushbullet.base_url') . '/pushes';
        $requestHeader = [
            'headers' => [
                'Access-Token' => config('api.pushbullet.api_key'),
                'Content-Type' => 'application/json',
            ]
        ];
        $requestBody = [
            'form_params' => [
                'type' => 'note',
                'title' => 'Irene',
                'body' => $message,
                'channel_tag' => $channelTag,
            ]
        ];
    

        // dd($requestUrl, $requestHeader, $requestBody);

        $response  = $this->guzzleClient->post($requestUrl, $requestHeader, $requestBody);

        Log::info('Pushbullet push note to channel request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => 'OK']);

        return $response->getStatusCode();
    }
}
