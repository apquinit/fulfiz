<?php

use Log as Log;
use GuzzleHttp\Client;
use App\Repositories\WolframAlphaUserRepository;

if (!function_exists('get_default_fallback')) {

    /**
     * Get short answer of a given query.
     *
     * @param
     * @return
     */
    function get_default_fallback(string $userId, string $query) : string
    {
        // WolframAlpha request URL (https://api.wolframalpha.com/v1/result?appid=DEMO&i=QUERY)

        if (strpos($userId, config('app.dialogflow.irene_lite')) !== false or strpos($userId, config('app.dialogflow.irene')) !== false) {
            $key = config('services.wolfram_alpha.api_key');
        } else {
            $wolframAlphaUserRepository = new WolframAlphaUserRepository;
            $wolframAlphaUser = $wolframAlphaUserRepository->getByUserId((int) $userId);

            if ($wolframAlphaUser->status === 'ENABLED') {
                $key = $wolframAlphaUser->token;
            } elseif ($wolframAlphaUser->status === 'DISABLED') {
                abort(403, 'Service disabled.');
            } else {
                abort(500, 'Internal server error.');
            }
        }

        $guzzleClient = new Client;
        $requestUrl = config('services.wolfram_alpha.base_url') . '?appid=' . config('services.wolfram_alpha.api_key') . '&i=' . $query . '&units=' . config('services.wolfram_alpha.units');
        $response  = $guzzleClient->get($requestUrl);
        $defaultFallback = $response->getBody()->getContents();
        
        Log::info('WolframAlpha short answer request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $defaultFallback]);
        
        return $defaultFallback;
    }
}
