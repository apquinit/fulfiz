<?php

use App\Services\Action\CurrentDateTimeService;

class CurrentDateTimeServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->currentDateTimeService = new CurrentDateTimeService('Manila');
    }

    /** @test */
    public function CurrentWeatherService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Action\CurrentDateTimeService::class));
    }

    /** @test */
    public function getTextResponse_method_should_return_date_time_of_type_string_when_passed_formatted_date_time()
    {
        $textResponse = $this->currentDateTimeService->getTextResponse();
        $this->assertTrue(is_string($textResponse));
    }
}
