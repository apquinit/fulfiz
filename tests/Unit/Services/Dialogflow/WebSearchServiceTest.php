<?php

use App\Services\Dialogflow\WebSearchService;
use Dialogflow\WebhookClient;
use Mockery as Mockery;

class WebSearchServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->agent = Mockery::mock('Dialogflow\WebhookClient');
        $this->webSearchService = new WebSearchService($this->agent);
    }

    /** @test */
    public function WebSearchService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Dialogflow\WebSearchService::class));
    }
}
