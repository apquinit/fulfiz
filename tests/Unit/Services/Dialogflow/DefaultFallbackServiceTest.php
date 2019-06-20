<?php

use App\Services\Dialogflow\DefaultFallbackService;
use Dialogflow\WebhookClient;
use Mockery as Mockery;

class DefaultFallbackServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->agent = Mockery::mock('Dialogflow\WebhookClient');
        $this->defaultFallbackService = new DefaultFallbackService($this->agent);
    }

    /** @test */
    public function DefaultFallbackService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Dialogflow\DefaultFallbackService::class));
    }
}
