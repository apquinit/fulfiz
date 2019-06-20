<?php

use App\Services\Dialogflow\CurrentDateTimeService;
use Dialogflow\WebhookClient;
use Mockery as Mockery;

class CurrentDateTimeServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->agent = Mockery::mock('Dialogflow\WebhookClient');
        $this->currentDateTimeService = new CurrentDateTimeService($this->agent);
    }

    /** @test */
    public function CurrentDateTimeService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Dialogflow\CurrentDateTimeService::class));
    }
}
