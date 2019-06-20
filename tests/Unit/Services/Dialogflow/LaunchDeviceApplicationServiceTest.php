<?php

use App\Services\Dialogflow\LaunchDeviceApplicationService;
use Dialogflow\WebhookClient;
use Mockery as Mockery;

class LaunchDeviceApplicationServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->agent = Mockery::mock('Dialogflow\WebhookClient');
        $this->launchDeviceApplicationService = new LaunchDeviceApplicationService($this->agent);
    }

    /** @test */
    public function LaunchDeviceApplicationService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Dialogflow\LaunchDeviceApplicationService::class));
    }
}
