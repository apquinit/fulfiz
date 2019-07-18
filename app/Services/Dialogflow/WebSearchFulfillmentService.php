<?php

namespace App\Services\Dialogflow;

use App\Interfaces\DialogflowFulfillmentServiceInterface;

class WebSearchFulfillmentService extends DialogflowFulfillmentService implements DialogflowFulfillmentServiceInterface
{
    public function setParameters(array $user, array $parameters) : void
    {
        $this->user = $user;
        $this->parameters = $parameters;
    }

    public function getTextResponse() : string
    {
        return $this->textResponse;
    }

    public function process() : void
    {
        $instantAnswer = get_instant_answer($this->user['id'], $this->parameters['topic']);

        if (empty($instantAnswer['AbstractText'])) {
            $this->textResponse = "The topic '" . $this->parameters['topic'] . "' is quite ambiguous. Please provide a more specific query.";
        } else {
            $this->textResponse = $instantAnswer['AbstractText'];
        }
        
        return;
    }
}
