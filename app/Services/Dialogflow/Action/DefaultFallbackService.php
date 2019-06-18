<?php

namespace App\Services\Action;

use App\Interfaces\ActionServiceInterface;
use App\Services\External\WolframAlphaService;

class DefaultFallbackService implements ActionServiceInterface
{
    private $queryText;

    public function __construct($queryText)
    {
        $this->queryText = $queryText;
    }

    public function getTextResponse()
    {
        // 1. Get short answer result from Wolfram Alpha Service.
        $shortAnswer = $this->getShortAnswerFromWolframAlphaService();
        $textResponse = $shortAnswer;

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

    private function getShortAnswerFromWolframAlphaService()
    {
        $wolframAlphaService = new WolframAlphaService;
        
        return $wolframAlphaService->getShortAnswer($this->queryText);
    }
}
