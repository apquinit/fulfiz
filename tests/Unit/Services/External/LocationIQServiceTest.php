<?php

use App\Services\External\LocationIQService;

class LocationIQServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->locationIqService = new LocationIQService;
    }

    /** @test */
    public function LocationIQService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\External\LocationIQService::class));
    }

    /** @test */
    public function getLatitudeAndLongitude_method_should_return_latitude_and_longitude_when_passed_a_city_name()
    {
        $location = $this->locationIqService->getLatitudeAndLongitude('Manila');
        $this->assertTrue(array_key_exists('lat', $location) && array_key_exists('lon', $location));
    }
}
