<?php

use App\Services\Dialogflow\CurrentWeatherService;
use Dialogflow\WebhookClient;
use Mockery as Mockery;

class CurrentWeatherServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->agent = Mockery::mock('Dialogflow\WebhookClient');
        $this->currentWeatherService = new CurrentWeatherService($this->agent);
    }

    /** @test */
    public function CurrentWeatherService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Dialogflow\CurrentWeatherService::class));
    }
}
