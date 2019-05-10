<?php

use App\Services\Action\WeatherService;

class WeatherServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
    }

    /** @test */
    public function WeatherService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Action\WeatherService::class));
    }
}
