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

        if ($userId === config('app.dialogflow.irene_lite') or $userId === config('app.dialogflow.irene')) {
            $key = config('services.wolfram_alpha.api_key');
        } else {
            $wolframAlphaUserRepository = new WolframAlphaUserRepository;
            $wolframAlphaUser = $wolframAlphaUserRepository->getByUserId((int) $userId);

            if ($wolframAlphaUser->status === 'ENABLED') {
                if (empty($wolframAlphaUser->token)) {
                    abort(500, 'Internal server error.');
                }
                $key = $wolframAlphaUser->token;
            } elseif ($wolframAlphaUser->status === 'DISABLED') {
                abort(403, 'Service disabled.');
            } else {
                abort(500, 'Internal server error.');
            }
        }

        $guzzleClient = new Client;
        $requestUrl = config('services.wolfram_alpha.base_url') . '?appid=' . $key . '&i=' . $query . '&units=' . config('services.wolfram_alpha.units');

        try {
            $response  = $guzzleClient->get($requestUrl);
        } catch (\Exception $e) {
            abort(500, 'Internal server error.');
        }

        $defaultFallback = $response->getBody()->getContents();
        
        Log::info('WolframAlpha short answer request', ['Status' => $response->getStatusCode(), 'Request' => $requestUrl, 'Response' => $defaultFallback]);
        
        return $defaultFallback;
    }
}
