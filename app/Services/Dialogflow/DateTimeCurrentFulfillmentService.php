<?php

namespace App\Services\Dialogflow;

use App\Interfaces\DialogflowFulfillmentServiceInterface;

class DateTimeCurrentFulfillmentService extends DialogflowFulfillmentService implements DialogflowFulfillmentServiceInterface
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
        $location = get_latitude_and_longitude($this->user['id'], $this->parameters['city']);
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        $currentDateTime = get_current_date_time($this->user['id'], $latitude, $longitude);
        
        $hour = date('h:i A', strtotime($currentDateTime));
        $day = date('l', strtotime($currentDateTime));
        $date = date('F j', strtotime($currentDateTime));
        $year = date('Y', strtotime($currentDateTime));

        $this->textResponse = $hour . ", " . $day . ", " . $date. ", " . $year . ".";

        return;
    }
}
