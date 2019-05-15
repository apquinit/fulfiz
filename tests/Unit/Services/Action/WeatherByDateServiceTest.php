<?php

use App\Services\Action\WeatherByDateService;

class WeatherByDateServiceTest extends TestCase
{
    /** @test */
    public function WeatherByDateService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Action\WeatherByDateService::class));
    }

    /** @test */
    public function getTextResponse_method_should_return_weather_summary_of_type_string_when_passed_city_name_and_date()
    {
        $this->weatherByDateService = new WeatherByDateService('Manila', '2019-05-14T12:00:00+08:00');
        $textResponse = $this->weatherByDateService->getTextResponse();
        $this->assertTrue(is_string($textResponse));
    }
}
