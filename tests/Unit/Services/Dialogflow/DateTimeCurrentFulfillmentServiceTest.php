<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Dialogflow\DateTimeCurrentFulfillmentService;

class DateTimeCurrentFulfillmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->dateTimeCurrentFulfillmentService = new DateTimeCurrentFulfillmentService;
    }

    /**
     * @test
     */
    public function DateTimeCurrentFulfillmentService_class_should_exist()
    {
        $this->assertTrue(class_exists(DateTimeCurrentFulfillmentService::class));
    }

    /**
     * @test
     */
    public function DateTimeCurrentFulfillmentService_class_should_return_text_response_when_passed_user_and_parameters_array()
    {
        $user = [
            'id' => 'irene-lite-vbvypr'
        ];

        $parameters = [
            'city' => 'Manila'
        ];

        $this->dateTimeCurrentFulfillmentService->setParameters($user, $parameters);
        $this->dateTimeCurrentFulfillmentService->process();
        $textResponse = $this->dateTimeCurrentFulfillmentService->getTextResponse();

        $this->assertTrue(is_string($textResponse));
    }
}
