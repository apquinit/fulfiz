<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Dialogflow\DeviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService;

class DeviceSmartphonePlayRandomMusicOnSpotifyFulfillmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->deviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService = new DeviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService;
    }

    /**
     * @test
     */
    public function DeviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService_class_should_exist()
    {
        $this->assertTrue(class_exists(DeviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService::class));
    }

    /**
     * @test
     */
    public function DeviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService_class_should_return_text_response_when_passed_user_and_parameters_array()
    {
        $user = [
            'id' => 'dialogflow/agent/irene-lite-vbvypr',
            'device_code' => 'irene-messenger'
        ];

        $parameters = [
            'application' => 'test'
        ];

        $this->deviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService->setParameters($user, $parameters);
        $this->deviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService->process();
        $textResponse = $this->deviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService->getTextResponse();
        
        $this->assertTrue(is_string($textResponse));
    }
}
