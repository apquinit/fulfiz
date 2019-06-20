<?php

use App\Services\External\TimeZoneDbService;

class TimeZoneDbServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->timeZoneDbService = new TimeZoneDbService;
    }

    /** @test */
    public function TimeZoneDbService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\External\TimeZoneDbService::class));
    }

    /** @test */
    public function getCurrentDateTime_method_should_return_formatted_timestamp_when_passed_longitude_and_latitude()
    {
        $currentDateTime = $this->timeZoneDbService->getCurrentDateTime(14.5906216, 120.9799696);
        $this->assertTrue(DateTime::createFromFormat('Y-m-d H:i:s', $currentDateTime) !== false);
    }
}
