<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Dialogflow\WeatherCurrentFulfillmentService;

class WeatherCurrentFulfillmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->weatherCurrentFulfillmentService = new WeatherCurrentFulfillmentService;
    }

    /**
     * @test
     */
    public function WeatherCurrentFulfillmentService_class_should_exist()
    {
        $this->assertTrue(class_exists(WeatherCurrentFulfillmentService::class));
    }

    /**
     * @test
     */
    public function WeatherCurrentFulfillmentService_class_should_return_text_response_when_passed_user_and_parameters_array()
    {
        $user = [
            'id' => 'dialogflow/agent/irene-lite-vbvypr'
        ];

        $parameters = [
            'city' => 'Manila'
        ];

        $this->weatherCurrentFulfillmentService->setParameters($user, $parameters);
        $this->weatherCurrentFulfillmentService->process();
        $textResponse = $this->weatherCurrentFulfillmentService->getTextResponse();

        $this->assertTrue(is_string($textResponse));
    }
}
