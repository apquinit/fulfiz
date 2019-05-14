<?php

use App\Services\Action\WeatherService;

class WeatherServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->weatherService = new WeatherService;
    }

    /** @test */
    public function WeatherService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Action\WeatherService::class));
    }

    /** @test */
    public function getCurrentWeatherTextResponse_method_should_return_string_when_passed_a_city_name()
    {
        $textResponse = $this->weatherService->getCurrentWeatherTextResponse('Manila');
        $this->assertTrue(is_string($textResponse));
    }

    /** @test */
    public function getWeatherByDateTextResponse_method_should_return_string_when_passed_city_name_and_date()
    {
        $textResponse = $this->weatherService->getWeatherByDateTextResponse('Manila', '2019-05-14T12:00:00+08:00');
        $this->assertTrue(is_string($textResponse));
    }
}
