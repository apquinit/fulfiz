<?php

use App\Services\LocationIQService;

class LocationIQServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->locationIqService = new LocationIQService;
    }

    /** @test */
    public function LocationIQServiceTest_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\LocationIQService::class));
    }

    /** @test */
    public function getLatitudeAndLongitude_method_should_return_latitude_and_longitude_when_passed_a_city_name()
    {
        $response = $this->locationIqService->getLatitudeAndLongitude('Manila');
        dd($response);
    }
}
