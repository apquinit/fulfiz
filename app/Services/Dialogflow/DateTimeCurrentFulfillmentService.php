<?php

namespace App\Services\Dialogflow;

use App\Interfaces\DialogflowFulfillmentInterface;

/**
 * Class KeyRepository.
 */
class DateTimeCurrentFulfillmentService extends DialogflowFulfillmentService implements DialogflowFulfillmentInterface
{
    public function setParameters(array $parameters) : void
    {
        $this->parameters = $parameters;
    }

    public function getTextResponse() : string
    {
        return $this->textResponse;
    }

    public function process() : void
    {
        return;
    }
}
