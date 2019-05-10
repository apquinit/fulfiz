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
    public function getCurrentWeather_method_should_return_current_weather_data_in_json_when_passed_longitude_and_latitude()
    {
        $weather = $this->darkSkyService->getCurrentWeather('14.5906216', '120.9799696');
        $this->assertTrue(
            array_key_exists('time', $weather) && 
            array_key_exists('summary', $weather) &&
            array_key_exists('icon', $weather) &&
            array_key_exists('precipIntensity', $weather) &&
            array_key_exists('precipProbability', $weather) &&
            array_key_exists('precipType', $weather) &&
            array_key_exists('temperature', $weather) &&
            array_key_exists('apparentTemperature', $weather) &&
            array_key_exists('dewPoint', $weather) &&
            array_key_exists('humidity', $weather) &&
            array_key_exists('pressure', $weather) &&
            array_key_exists('windSpeed', $weather) &&
            array_key_exists('windGust', $weather) &&
            array_key_exists('windBearing', $weather) &&
            array_key_exists('cloudCover', $weather) &&
            array_key_exists('uvIndex', $weather) &&
            array_key_exists('visibility', $weather) &&
            array_key_exists('ozone', $weather)
        );
    }
}
