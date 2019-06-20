<?php

namespace App\Services\Dialogflow;

use Dialogflow\WebhookClient;
use App\Interfaces\DialogflowServiceInterface;
use App\Services\External\WolframAlphaService;

class DefaultFallbackService implements DialogflowServiceInterface
{
    private $agent;

    public function __construct(WebhookClient $agent)
    {
        $this->agent = $agent;
    }

    public function process() : WebhookClient
    {
        // Get query from agent
        $query = $this->agent->getQuery();

        // Get short answer result from Wolfram Alpha Service.
        $shortAnswer = $this->getShortAnswerFromWolframAlphaService($query);

        // Assemble text response from weather data.
        $textResponse = $this->assembleTextResponse($shortAnswer);

        return $this->agent->reply($textResponse);
    }

    private function assembleTextResponse(string $shortAnswer) : string
    {
        if (is_numeric($shortAnswer)) {
            return $textResponse;
        } else {
            if (strpos($shortAnswer, ".") !== false) {
                $textResponse = ucfirst($shortAnswer);
            } else {
                $textResponse = ucfirst($shortAnswer) . '.';
            }
        }
        
        return $textResponse;
    }

    private function getShortAnswerFromWolframAlphaService(string $query) : string
    {
        $wolframAlphaService = new WolframAlphaService;
        
        return $wolframAlphaService->getShortAnswer($query);
    }
}
