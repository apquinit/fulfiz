<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Dialogflow\WebhookClient;
use App\Services\Dialogflow\Action\DefaultFallbackService;
use App\Services\Dialogflow\Action\CurrentWeatherService;
use App\Services\Dialogflow\Action\WeatherByDateService;
use App\Services\Dialogflow\Action\WebSearchService;
use App\Services\Dialogflow\Action\CurrentDateTimeService;

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
        Log::info('Dialogflow Request', ['Query' => $agent->getQuery(), 'Intent' => $agent->getIntent(), 'Action' => $agent->getAction(), 'Response' => $agent->render()]);
        
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
