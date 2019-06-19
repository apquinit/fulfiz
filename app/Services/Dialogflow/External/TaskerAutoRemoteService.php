<?php

namespace App\Services\Dialogflow\External;

use Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class TaskerAutoRemoteService
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

    public function sendMessage(string $message) : int
    {
        // Tasker AutoRemote Send Message request URL (https://autoremotejoaomgcd.appspot.com/sendmessage?key=fXbXbF6_tJo:APA91bFHN8DEiJ7BDRVMWSDEqJt_gWIqBTus1QhuevCUYmmgwf-ssqf5znXY4uCEoKZCBcjancLI3R8preYWBlWrrWhk4McWWmyKSKvJBrvaRCkIPJ_faOJFgR6wSvJwdTIGVPvh1hDm&message=LAUNCH%20SPOTIFY)
        $requestUrl = config('api.tasker_autoremote.base_url') . '?key=' . config('api.tasker_autoremote.api_key') . '&message=' . $message;
        $response  = $this->guzzleClient->get($requestUrl);

        Log::info('Tasker AutoRemote API send message request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => 'OK']);

        return $response->getStatusCode();
    }
}