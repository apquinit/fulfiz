<?php

use App\Services\Action\CurrentWeatherService;

class CurrentWeatherServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->currentWeatherService = new CurrentWeatherService('Manila');
    }

    /** @test */
    public function CurrentWeatherService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Action\CurrentWeatherService::class));
    }

    /** @test */
    public function getTextResponse_method_should_return_weather_summary_of_type_string_when_passed_a_city_name()
    {
        $textResponse = $this->currentWeatherService->getTextResponse();
        $this->assertTrue(is_string($textResponse));
    }
}
