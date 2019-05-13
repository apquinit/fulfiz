<?php

use App\Services\External\DarkSkyService;

class DarkSkyServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->darkSkyService = new DarkSkyService;
    }

    /** @test */
    public function DarkSkyService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\External\DarkSkyService::class));
    }

    /** @test */
    public function getCurrentWeather_method_should_return_current_weather_data_in_array_when_passed_longitude_and_latitude()
    {
        $weather = $this->darkSkyService->getCurrentWeather('14.5906216', '120.9799696');
        $this->assertTrue(
            in_array('summary', $weather) &&
            in_array('temperature', $weather) &&
            in_array('apparentTemperature', $weather) &&
            in_array('humidity', $weather) &&
            in_array('pressure', $weather) &&
            in_array('windSpeed', $weather) &&
            in_array('windGust', $weather)
        );
    }

    /** @test */
    public function getWeatherByDate_method_should_return_weather_data_by_date_in_array_when_passed_longitude_and_latitude_and_timestamp()
    {
        $weather = $this->darkSkyService->getWeatherByDate('14.5906216', '120.9799696', '2019-05-10T12:00:00+08:00');
        $this->assertTrue(
            in_array('summary', $weather) &&
            in_array('temperature', $weather) &&
            in_array('apparentTemperature', $weather) &&
            in_array('humidity', $weather) &&
            in_array('pressure', $weather) &&
            in_array('windSpeed', $weather) &&
            in_array('windGust', $weather)
        );
    }
}
