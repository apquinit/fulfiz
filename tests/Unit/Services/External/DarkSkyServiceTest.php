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
    public function getCurrentWeather_method_should_return_current_weather_data_array_when_passed_longitude_and_latitude()
    {
        $weather = $this->darkSkyService->getCurrentWeather('14.5906216', '120.9799696');
        $this->assertTrue(
            array_key_exists('summary', $weather) &&
            array_key_exists('temperature', $weather) &&
            array_key_exists('apparentTemperature', $weather) &&
            array_key_exists('precipProbability', $weather) &&
            array_key_exists('precipIntensity', $weather) &&
            array_key_exists('humidity', $weather) &&
            array_key_exists('pressure', $weather) &&
            array_key_exists('windSpeed', $weather) &&
            array_key_exists('windGust', $weather)
        );
    }

    /** @test */
    public function getWeatherByDate_method_should_return_weather_data_by_date_array_key_exists_when_passed_longitude_and_latitude_and_timestamp()
    {
        $weather = $this->darkSkyService->getWeatherByDate('14.5906216', '120.9799696', '2019-06-17T12:00:00+08:00');
        $this->assertTrue(
            array_key_exists('summary', $weather) &&
            array_key_exists('temperatureMin', $weather) &&
            array_key_exists('temperatureMax', $weather) &&
            array_key_exists('apparentTemperatureMin', $weather) &&
            array_key_exists('apparentTemperatureMax', $weather) &&
            array_key_exists('precipProbability', $weather) &&
            array_key_exists('precipIntensity', $weather) &&
            array_key_exists('humidity', $weather) &&
            array_key_exists('pressure', $weather) &&
            array_key_exists('windSpeed', $weather) &&
            array_key_exists('windGust', $weather)
        );
    }
}
