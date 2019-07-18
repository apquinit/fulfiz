<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Dialogflow\DeviceSmartphoneLaunchApplicationFulfillmentService;

class DeviceSmartphoneLaunchApplicationFulfillmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->deviceSmartphoneLaunchApplicationFulfillmentService = new DeviceSmartphoneLaunchApplicationFulfillmentService;
    }

    /**
     * @test
     */
    public function DeviceSmartphoneLaunchApplicationFulfillmentService_class_should_exist()
    {
        $this->assertTrue(class_exists(DeviceSmartphoneLaunchApplicationFulfillmentService::class));
    }

    /**
     * @test
     */
    public function DeviceSmartphoneLaunchApplicationFulfillmentService_class_should_return_text_response_when_passed_user_and_parameters_array()
    {
        $user = [
            'id' => 'dialogflow/agent/irene-lite-vbvypr',
            'device_code' => 'irene-messenger'
        ];

        $parameters = [
            'application' => 'test'
        ];

        $this->deviceSmartphoneLaunchApplicationFulfillmentService->setParameters($user, $parameters);
        $this->deviceSmartphoneLaunchApplicationFulfillmentService->process();
        $textResponse = $this->deviceSmartphoneLaunchApplicationFulfillmentService->getTextResponse();
        
        $this->assertTrue(is_string($textResponse));
    }
}