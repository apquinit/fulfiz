<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Dialogflow\DefaultFallbackFulfillmentService;

class DefaultFallbackFulfillmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->defaultFallbackFulfillmentService = new DefaultFallbackFulfillmentService;
    }

    /**
     * @test
     */
    public function DefaultFallbackFulfillmentService_class_should_exist()
    {
        $this->assertTrue(class_exists(DefaultFallbackFulfillmentService::class));
    }

    /**
     * @test
     */
    public function DefaultFallbackFulfillmentService_class_should_return_text_response_when_passed_user_and_parameters_array()
    {
        $user = [
            'id' => 'dialogflow/agent/irene-lite-vbvypr'
        ];

        $parameter = [
            'query' => 'Who invented peanut butter?'
        ];

        $this->defaultFallbackFulfillmentService->setParameters($user, $parameter);
        $this->defaultFallbackFulfillmentService->process();
        $textResponse = $this->defaultFallbackFulfillmentService->getTextResponse();

        $this->assertTrue(is_string($textResponse));
    }
}
