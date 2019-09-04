<?php

namespace App\Services\Dialogflow;

use App\Interfaces\DialogflowFulfillmentServiceInterface;

class DefaultFallbackFulfillmentService extends DialogflowFulfillmentService implements DialogflowFulfillmentServiceInterface
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
        // $defaultFallback  = get_default_fallback($this->user['id'], $this->parameters['query']);
        $instantAnswer = get_instant_answer($this->user['id'], $this->parameters['query']);
        $defaultFallback = $instantAnswer['AbstractText'];

        if (empty($defaultFallback)) {
            try {
                $defaultFallback  = get_default_fallback($this->user['id'], $this->parameters['query']);
            } catch (\Exception $e) {
                $this->textResponse = "Query '" . $this->parameters['query'] . "' is quite ambiguous. Can you please be more specific with your question?";
                return;
            }
        }

        if (is_numeric($defaultFallback)) {
            $this->textResponse = $defaultFallback;
            return;
        } else {
            if (strpos($defaultFallback, ".") !== false) {
                $this->textResponse = ucfirst($defaultFallback);
            } else {
                $this->textResponse = ucfirst($defaultFallback) . '.';
            }
        }
        
        return;
    }
}
