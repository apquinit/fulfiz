<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Dialogflow\WeatherDateFulfillmentService;

class WeatherDateFulfillmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->weatherDateFulfillmentService = new WeatherDateFulfillmentService;
    }

    /**
     * @test
     */
    public function WeatherDateFulfillmentService_class_should_exist()
    {
        $this->assertTrue(class_exists(WeatherDateFulfillmentService::class));
    }

    /**
     * @test
     */
    public function WeatherDateFulfillmentService_class_should_return_text_response_when_passed_user_and_parameters_array()
    {
        $user = [
            'id' => 'irene-lite-vbvypr'
        ];

        $parameters = [
            'city' => 'Manila',
            'date' => '2019-07-17T12:00:00+08:00'
        ];

        $this->weatherDateFulfillmentService->setParameters($user, $parameters);
        $this->weatherDateFulfillmentService->process();
        $textResponse = $this->weatherDateFulfillmentService->getTextResponse();

        $this->assertTrue(is_string($textResponse));
    }
}
