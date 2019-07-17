<?php

use Log as Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Repositories\DeviceRepository;

if (!function_exists('send_autoremote_message')) {

    /**
     * Get short answer of a given query.
     *
     * @param
     * @return
     */
    function send_autoremote_message(string $code, string $message) : int
    {
        // AutoRemote request URL (https://autoremotejoaomgcd.appspot.com/sendmessage?key=KEY&message=MESSAGE)

        if (strpos($code, config('app.dialogflow.irene')) !== false) {
            $key = config('services.autoremote.api_key');
        } else {
            $deviceRepository = new DeviceRepository;
            $device = $deviceRepository->getByCode($code);

            if ($device->status === 'ENABLED') {
                $key = $device->key;
            } elseif ($device->status === 'DISABLED') {
                abort(401, 'Device Disabled');
            } else {
                abort(500, 'Internal Server Error');
            }
        }

        $guzzleClient = new Client;
        $requestUrl = config('services.autoremote.base_url') . '?key=' . $key . '&message=' . $message;
        $response  = $guzzleClient->get($requestUrl);
        $responseCode = $response->getStatusCode();
        
        Log::info('AutoRemote message request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl]);
        
        return $responseCode;
    }
}
