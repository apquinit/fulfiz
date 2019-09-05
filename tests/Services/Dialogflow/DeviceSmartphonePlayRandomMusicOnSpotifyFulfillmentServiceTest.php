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
}
