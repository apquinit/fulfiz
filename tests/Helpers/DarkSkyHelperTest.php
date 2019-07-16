<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DarkSkyHelperTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function get_current_weather_function_should_return_current_weather_when_passed_dialogflow_agent_id_and_latitude_longitude()
    {
        $currentWeather = get_current_weather('dialogflow/agent/irene-lite-vbvypr', 14.5906216, 120.9799696);

        $this->assertArrayHasKey('summary', $currentWeather);
        $this->assertArrayHasKey('temperature', $currentWeather);
        $this->assertArrayHasKey('apparentTemperature', $currentWeather);
        $this->assertArrayHasKey('precipProbability', $currentWeather);
        $this->assertArrayHasKey('precipIntensity', $currentWeather);
        $this->assertArrayHasKey('humidity', $currentWeather);
        $this->assertArrayHasKey('windSpeed', $currentWeather);
        $this->assertArrayHasKey('windGust', $currentWeather);
        $this->assertArrayHasKey('pressure', $currentWeather);
        $this->assertArrayHasKey('nearestStormDistance', $currentWeather);
    }

    /**
     * @test
     */
    public function get_current_weather_function_should_return_current_weather_when_passed_user_id_and_latitude_longitude()
    {
        factory(\App\Models\DarkSkyUser::class)->create(
            [
                'user_id' => 1,
                'token' => '5a050170535218d28b85e8cad4e6f781',
                'status' => 'ENABLED'
            ]
        );

        $currentWeather = get_current_weather('dialogflow/agent/irene-lite-vbvypr', 14.5906216, 120.9799696);

        $this->assertArrayHasKey('summary', $currentWeather);
        $this->assertArrayHasKey('temperature', $currentWeather);
        $this->assertArrayHasKey('apparentTemperature', $currentWeather);
        $this->assertArrayHasKey('precipProbability', $currentWeather);
        $this->assertArrayHasKey('precipIntensity', $currentWeather);
        $this->assertArrayHasKey('humidity', $currentWeather);
        $this->assertArrayHasKey('windSpeed', $currentWeather);
        $this->assertArrayHasKey('windGust', $currentWeather);
        $this->assertArrayHasKey('pressure', $currentWeather);
        $this->assertArrayHasKey('nearestStormDistance', $currentWeather);
    }
}
