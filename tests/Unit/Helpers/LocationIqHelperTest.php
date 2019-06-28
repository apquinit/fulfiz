<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationIqHelperTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        config(['app.dialogflow.irene_lite' => 'irene-lite-vbvypr']);
        config(['app.dialogflow.irene' => 'irene-4fe98']);
        config(['services.location_iq.base_url' => 'https://us1.locationiq.com/v1/search.php']);
        config(['services.location_iq.api_key' => '4c53f82e708066']);
    }

    /**
     * @test
     */
    public function get_latitude_and_longitude_method_shoud_return_latitude_and_longitude_when_passed_dialogflow_agent_id()
    {
        $location = get_latitude_and_longitude('dialogflow/agent/irene-lite-vbvypr', 'Manila');

        $this->assertArrayHasKey('lat', $location);
        $this->assertArrayHasKey('lon', $location);
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function get_latitude_and_longitude_method_shoud_return_latitude_and_longitude_when_passed_user_id()
    {
        factory(\App\Models\LocationIqUser::class)->create(
            [
                'user_id' => 1,
                'token' => '4c53f82e708066',
                'status' => 'ENABLED'
            ]
        );

        $location = get_latitude_and_longitude('1', 'Manila');

        $this->assertArrayHasKey('lat', $location);
        $this->assertArrayHasKey('lon', $location);
        $this->assertTrue(true);
    }
}
