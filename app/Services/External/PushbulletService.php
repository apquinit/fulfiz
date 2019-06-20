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

    public function pushNoteToChannel(string $channelTag, string $title, string $message) : int
    {
        // Pushbullet request URL (https://api.pushbullet.com/v2/pushes)
        
        // $requestUrl = config('services.pushbullet.base_url') . '/pushes';
        // $requestHeader = [
        //     'headers' => [
        //         'Access-Token' => config('services.pushbullet.api_key'),
        //         'Content-Type' => 'application/json',
        //     ]
        // ];
        // $requestBody = [
        //     'json' => [
        //         'type' => 'note',
        //         'title' => 'Irene',
        //         'body' => $message,
        //         'channel_tag' => $channelTag,
        //     ]
        // ];

        // $response  = $this->guzzleClient->post($requestUrl, $requestHeader, $requestBody);

        $curl = curl_init(config('services.pushbullet.base_url') . '/pushes');

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Access-Token: ' . config('services.pushbullet.api_key', 'Content-Type: application/json')]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, ['channel_tag' => $channelTag, 'type' => 'note', 'title' => $title, 'body' => $message]);

        $response = curl_exec($curl);

        if ($response === '{}') {
            return 200;
        } else {
            return 500;
        }
    }
}
