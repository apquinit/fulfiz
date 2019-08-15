<?php

use Log as Log;

if (!function_exists('push_note_to_channel')) {

    /**
     * Get latitude and langitude of a city.
     *
     * @param
     * @return
     */
    function push_note_to_channel(string $channel, string $title, string $message) : array
    {
        // Pushbullet request URL (https://api.pushbullet.com/v2/pushes)
        $curl = curl_init(config('services.pushbullet.base_url') . '/pushes');

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Access-Token: ' . config('services.pushbullet.api_key', 'Content-Type: application/json')]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, ['channel_tag' => $channel, 'type' => 'note', 'title' => $title, 'body' => $message]);

        $response = curl_exec($curl);

        if ($response === '{}') {
            Log::info('Pushbullet push note to channel request', ['Status' => 200, 'Request' => config('services.pushbullet.base_url') . '/pushes', 'Response' => 'success']);
            return [
                'channel' => $channel,
                'title' => $title,
                'message' => $message,
            ];
        } else {
            Log::info('Pushbullet push note to channel request', ['Status' => 500, 'Request' => config('services.pushbullet.base_url') . '/pushes', 'Response' => 'error']);
            abort(500, 'Internal server error.');
        }
    }
}
