<?php

use App\Services\Dialogflow\WeatherByDateService;
use Dialogflow\WebhookClient;
use Mockery as Mockery;

class WeatherByDateServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->agent = Mockery::mock('Dialogflow\WebhookClient');
        $this->weatherByDateService = new WeatherByDateService($this->agent);
    }

    /** @test */
    public function WeatherByDateService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Dialogflow\WeatherByDateService::class));
    }
}
