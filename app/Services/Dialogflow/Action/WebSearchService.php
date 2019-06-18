<?php

namespace App\Services\Action;

use App\Interfaces\ActionServiceInterface;
use App\Services\External\DuckDuckGoService;

class WebSearchService implements ActionServiceInterface
{
    private $topic;

    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    public function getTextResponse()
    {
        // 1. Get Instant Answer result from DuckDuckGo Service.
        $searchResult = $this->getInstantAnswerFromDuckDuckGoService();

        // 2. Assemble text response from search result data.
        $textResponse = $this->setTextResponse($searchResult);

        return $textResponse;
    }

    private function setTextResponse($searchResult)
    {
        $textResponse = $searchResult['AbstractText'];
        
        return $textResponse;
    }

    private function getInstantAnswerFromDuckDuckGoService()
    {
        $duckDuckGoService = new DuckDuckGoService;
        
        return $duckDuckGoService->getInstantAnswer($this->topic);
    }
}
