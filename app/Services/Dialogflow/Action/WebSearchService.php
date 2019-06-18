<?php

namespace App\Services\Action;

use Dialogflow\WebhookClient;
use App\Interfaces\ActionServiceInterface;
use App\Services\External\DuckDuckGoService;

class WebSearchService implements ActionServiceInterface
{
    private $agent;

    public function __construct(WebhookClient $agent)
    {
        $this->agent = $agent;
    }

    public function process()
    {
        // Get parameters from agent
        $parameters = $this->agent->getParameters();

        // Get Instant Answer result from DuckDuckGo Service.
        $searchResult = $this->getInstantAnswerFromDuckDuckGoService($parameters['topic']);

        // Assemble text response from search result data.
        $textResponse = $this->assembleTextResponse($searchResult);

        return $this->agent->reply($textResponse);
    }

    private function assembleTextResponse($searchResult)
    {
        $textResponse = $searchResult['AbstractText'];
        
        return $textResponse;
    }

    private function getInstantAnswerFromDuckDuckGoService($topic)
    {
        $duckDuckGoService = new DuckDuckGoService;
        
        return $duckDuckGoService->getInstantAnswer($topic);
    }
}
