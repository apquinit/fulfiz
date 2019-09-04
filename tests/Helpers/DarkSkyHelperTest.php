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
                'token' => config('services.dark_sky.api_key'),
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

    /**
     * @test
     */
    public function get_date_weather_function_should_return_date_weather_when_passed_dialogflow_agent_id_and_latitude_longitude_and_date()
    {
        $dateWeather = get_date_weather('dialogflow/agent/irene-lite-vbvypr', 14.5906216, 120.9799696, '2019-07-17T12:00:00+08:00');

        $this->assertArrayHasKey('summary', $dateWeather);
        $this->assertArrayHasKey('temperatureMin', $dateWeather);
        $this->assertArrayHasKey('temperatureMax', $dateWeather);
        $this->assertArrayHasKey('apparentTemperatureMin', $dateWeather);
        $this->assertArrayHasKey('apparentTemperatureMax', $dateWeather);
        $this->assertArrayHasKey('precipProbability', $dateWeather);
        $this->assertArrayHasKey('precipIntensity', $dateWeather);
        $this->assertArrayHasKey('humidity', $dateWeather);
        $this->assertArrayHasKey('windSpeed', $dateWeather);
        $this->assertArrayHasKey('windGust', $dateWeather);
        $this->assertArrayHasKey('pressure', $dateWeather);
    }

    /**
     * @test
     */
    public function get_date_weather_function_should_return_date_weather_when_passed_user_id_and_latitude_longitude_and_date()
    {
        factory(\App\Models\DarkSkyUser::class)->create(
            [
                'user_id' => 1,
                'token' => config('services.dark_sky.api_key'),
                'status' => 'ENABLED'
            ]
        );

        $dateWeather = get_date_weather('dialogflow/agent/irene-lite-vbvypr', 14.5906216, 120.9799696, '2019-07-17T12:00:00+08:00');

        $this->assertArrayHasKey('summary', $dateWeather);
        $this->assertArrayHasKey('temperatureMin', $dateWeather);
        $this->assertArrayHasKey('temperatureMax', $dateWeather);
        $this->assertArrayHasKey('apparentTemperatureMin', $dateWeather);
        $this->assertArrayHasKey('apparentTemperatureMax', $dateWeather);
        $this->assertArrayHasKey('precipProbability', $dateWeather);
        $this->assertArrayHasKey('precipIntensity', $dateWeather);
        $this->assertArrayHasKey('humidity', $dateWeather);
        $this->assertArrayHasKey('windSpeed', $dateWeather);
        $this->assertArrayHasKey('windGust', $dateWeather);
        $this->assertArrayHasKey('pressure', $dateWeather);
    }
}
