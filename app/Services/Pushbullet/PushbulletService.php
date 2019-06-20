<?php

namespace App\Services\Pushbullet;

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
        
        $requestUrl = config('api.pusher.base_url') . '/pushes';
        $requestHeader = [
            'headers' => [
                'Access-Token' => config('api.pusher.api_key'),
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

        $response  = $this->guzzleClient->post($requestUrl, $requestBody, $requestHeader);

        Log::info('Pushbullet push note to channel request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => 'OK']);

        return $response->getStatusCode();
    }
}
