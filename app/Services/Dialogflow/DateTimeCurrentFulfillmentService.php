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
        $currentDateTime = get_current_date_time(14.5906216, 120.9799696);
        $hour = date('h:i A', strtotime($currentDateTime));
        $day = date('l', strtotime($currentDateTime));
        $date = date('F j', strtotime($currentDateTime));
        $year = date('Y', strtotime($currentDateTime));

        $this->textResponse = $hour . ', ' . $day . ', ' . $date. ', ' . $year . '.';

        return;
    }
}
