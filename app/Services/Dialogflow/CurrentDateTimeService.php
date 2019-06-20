<?php

namespace App\Services\Dialogflow;

use Dialogflow\WebhookClient;
use App\Interfaces\DialogflowServiceInterface;
use App\Services\External\LocationIqService;
use App\Services\External\TimeZoneDbService;

class CurrentDateTimeService implements DialogflowServiceInterface
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

        // Get latitude and longitude from Location IQ Service by city name.
        $location = $this->getLatitudeAndLongitudeFromLocationIqService($parameters['city']);
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        // Get time and date data from Time Zone DB Service by latitude and longitude
        $currentDateTime = $this->getCurrentDateTimeFromTimeZoneDbService($latitude, $longitude);

        // Assemble text response from weather data.
        $textResponse = $this->assembleTextResponse($currentDateTime);

        return $this->agent->reply($textResponse);
    }

    private function assembleTextResponse(string $currentDateTime) : string
    {
        $time = date('h:i A', strtotime($currentDateTime));
        $day = date('l', strtotime($currentDateTime));
        $date = date('F j', strtotime($currentDateTime));
        $year = date('Y', strtotime($currentDateTime));

        $textResponse = $time . ', ' . $day . ', ' . $date. ', ' . $year . '.';
        
        return $textResponse;
    }

    private function getLatitudeAndLongitudeFromLocationIqService(string $city) : array
    {
        $locationIqService = new LocationIqService;

        return $locationIqService->getLatitudeAndLongitude($city);
    }

    private function getCurrentDateTimeFromTimeZoneDbService(float $latitude, float $longitude) : string
    {
        $timeZoneDbService = new TimeZoneDbService;

        return $timeZoneDbService->getCurrentDateTime($latitude, $longitude);
    }
}
