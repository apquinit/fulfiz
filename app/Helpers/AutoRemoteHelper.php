<?php

use Log as Log;
use GuzzleHttp\Client;
use App\Repositories\DeviceRepository;

if (!function_exists('send_autoremote_message')) {

    /**
     * Get short answer of a given query.
     *
     * @param
     * @return
     */
    function send_autoremote_message(string $deviceCode, string $message) : int
    {
        // AutoRemote request URL (https://autoremotejoaomgcd.appspot.com/sendmessage?key=KEY&message=MESSAGE)
        if ($deviceCode === 'irene-messenger') {
            $key = config('services.autoremote.api_key');
        } else {
            $deviceRepository = new DeviceRepository;
            $device = $deviceRepository->getByCode($deviceCode);

            if ($device->status === 'ENABLED') {
                if (empty($device->key)) {
                    abort(500, 'Internal server error.');
                }
                $key = $device->key;
            } elseif ($device->status === 'DISABLED') {
                abort(403, 'Device disabled.');
            } else {
                abort(500, 'Internal server error.');
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
