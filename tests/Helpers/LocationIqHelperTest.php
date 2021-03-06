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
    }

    /**
     * @test
     */
    public function get_latitude_and_longitude_function_should_return_latitude_and_longitude_when_passed_dialogflow_agent_id_and_city()
    {
        $location = get_latitude_and_longitude('irene-lite-vbvypr', 'Manila');

        $this->assertArrayHasKey('lat', $location);
        $this->assertArrayHasKey('lon', $location);
    }

    /**
     * @test
     */
    public function get_latitude_and_longitude_function_should_return_latitude_and_longitude_when_passed_user_id_and_city()
    {
        factory(\App\Models\LocationIqUser::class)->create(
            [
                'user_id' => 1,
                'token' => config('services.location_iq.api_key'),
                'status' => 'ENABLED'
            ]
        );

        $location = get_latitude_and_longitude('1', 'Manila');

        $this->assertArrayHasKey('lat', $location);
        $this->assertArrayHasKey('lon', $location);
    }
}
