<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dialogflow\WebhookClient;
use App\Services\Action\DefaultFallbackService;
use App\Services\Action\CurrentWeatherService;
use App\Services\Action\WeatherByDateService;
use App\Services\Action\WebSearchService;
use App\Services\Action\CurrentDateTimeService;

class DialogflowController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $agent = $this->mapRequestToService(WebhookClient::fromData($this->request->json()->all()))->process();
        
        return response()->json($agent->render());
    }

    private function mapRequestToService(WebhookClient $agent)
    {   
        if ($agent->getAction() === 'fallback.wolfram_alpha') {
            return new DefaultFallbackService($agent);
        } else if ($agent->getAction() === 'weather.current') {
            return new CurrentWeatherService($agent);
        } else if ($agent->getAction() === 'weather.date') {
            return new WeatherByDateService($agent);
        } else if ($agent->getAction() === 'web.search') {
            return new WebSearchService($agent);
        } else if ($agent->getAction() === 'datetime.current') {
            return new CurrentDateTimeService($agent);
        }
    }
}
