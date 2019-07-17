<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Dialogflow\WebSearchFulfillmentService;

class WebSearchFulfillmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->webSearchFulfillmentService = new WebSearchFulfillmentService;
    }

    /**
     * @test
     */
    public function WebSearchFulfillmentService_class_should_exist()
    {
        $this->assertTrue(class_exists(WebSearchFulfillmentService::class));
    }

    /**
     * @test
     */
    public function WebSearchFulfillmentService_class_should_return_text_response_when_passed_user_and_parameters_array()
    {
        $user = [
            'id' => 'dialogflow/agent/irene-lite-vbvypr'
        ];

        $parameters = [
            'topic' => 'Artificial intelligence'
        ];

        $this->webSearchFulfillmentService->setParameters($user, $parameters);
        $this->webSearchFulfillmentService->process();
        $textResponse = $this->webSearchFulfillmentService->getTextResponse();

        $this->assertTrue(is_string($textResponse));
    }
}
