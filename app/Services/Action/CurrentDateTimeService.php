<?php

namespace App\Services\Action;

use App\Interfaces\ActionServiceInterface;
use App\Services\External\LocationIqService;
use App\Services\External\TimeZoneDbService;

class CurrentDateTimeService implements ActionServiceInterface
{
    private $cityName;

    public function __construct($cityName)
    {
        $this->cityName = $cityName;
    }

    public function getTextResponse()
    {
        // 1. Get latitude and longitude from Location IQ Service by city name.
        $location = $this->getLatitudeAndLongitudeFromLocationIqService();
        $latitude = $location['lat'];
        $longitude = $location['lon'];

        // 2. Get weather data from Dark Sky Service by latitude and longitude
        $currentDateTime = $this->getCurrentDateTimeFromTimeZoneDbService($latitude, $longitude);

        // 3. Assemble text response from weather data.
        $textResponse = $this->setTextResponse($currentDateTime);

        return $textResponse;
    }

    private function setTextResponse($currentDateTime)
    {
        $time = date('h:i:s A', strtotime($currentDateTime));
        $day = date('l', strtotime($currentDateTime));
        $date = date('F j', strtotime($currentDateTime));
        $year = date('Y', strtotime($currentDateTime));

        $textResponse = $time . ', ' . $day . ', ' . $date. ', ' . $year;
        
        return $textResponse;
    }

    private function getLatitudeAndLongitudeFromLocationIqService()
    {
        $locationIqService = new LocationIqService;

        return $locationIqService->getLatitudeAndLongitude($this->cityName);
    }

    private function getCurrentDateTimeFromTimeZoneDbService($latitude, $longitude)
    {
        $timeZoneDbService = new TimeZoneDbService;

        return $timeZoneDbService->getCurrentDateTime($latitude, $longitude);
    }

}
