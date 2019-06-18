<?php

use App\Services\Dialogflow\External\LocationIqService;

class LocationIqServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->locationIqService = new LocationIqService;
    }

    /** @test */
    public function LocationIqService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Dialogflow\External\LocationIqService::class));
    }

    /** @test */
    public function getLatitudeAndLongitude_method_should_return_latitude_and_longitude_when_passed_a_city_name()
    {
        $location = $this->locationIqService->getLatitudeAndLongitude('Manila');
        $this->assertTrue(array_key_exists('lat', $location) && array_key_exists('lon', $location));
    }
}
