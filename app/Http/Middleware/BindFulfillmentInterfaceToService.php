<?php

namespace App\Http\Middleware;

use Closure;
use Dialogflow\WebhookClient;

class BindFulfillmentInterfaceToService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('api/dialogflow/fulfillment')) {
            $agent = WebhookClient::fromData($request->json()->all());

            app()->bind(
                'App\Interfaces\DialogflowFulfillmentServiceInterface',
                function () use ($agent) {
                    if ($agent->getAction() === 'default.fallback') {
                        return new \App\Services\Dialogflow\DefaultFallbackFulfillmentService;
                    } elseif ($agent->getAction() === 'datetime.current') {
                        return new \App\Services\Dialogflow\DateTimeCurrentFulfillmentService;
                    } elseif ($agent->getAction() === 'device.smartphone.launch_application') {
                        return new \App\Services\Dialogflow\DeviceSmartphoneLaunchApplicationFulfillmentService;
                    } elseif ($agent->getAction() === 'device.smartphone.play_random_music_on_spotify') {
                        return new \App\Services\Dialogflow\DeviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService;
                    } elseif ($agent->getAction() === 'weather.current') {
                        return new \App\Services\Dialogflow\WeatherCurrentFulfillmentService;
                    } elseif ($agent->getAction() === 'weather.date') {
                        return new \App\Services\Dialogflow\WeatherDateFulfillmentService;
                    } elseif ($agent->getAction() === 'web.search') {
                        return new \App\Services\Dialogflow\WebSearchFulfillmentService;
                    } else {
                        abort(500, 'Internal server error.');
                    }
                }
            );

            $request->agent = $agent;

            return $next($request);
        }
        
        return $next($request);
    }
}
