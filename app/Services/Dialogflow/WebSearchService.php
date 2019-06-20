<?php

namespace App\Services\Dialogflow;

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

    public function process() : WebhookClient
    {
        // Get parameters from agent
        $parameters = $this->agent->getParameters();

        // Get Instant Answer result from DuckDuckGo Service.
        $searchResult = $this->getInstantAnswerFromDuckDuckGoService($parameters['topic']);

        // Assemble text response from search result data.
        $textResponse = $this->assembleTextResponse($searchResult);

        return $this->agent->reply($textResponse);
    }

    private function assembleTextResponse(array $searchResult) : string
    {
        $textResponse = $searchResult['AbstractText'];
        
        return $textResponse;
    }

    private function getInstantAnswerFromDuckDuckGoService(string $topic) : array
    {
        $duckDuckGoService = new DuckDuckGoService;
        
        return $duckDuckGoService->getInstantAnswer($topic);
    }
}
