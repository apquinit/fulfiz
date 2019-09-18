<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WolframAlphaHelperTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function get_default_fallback_function_should_return_default_fallback_when_passed_dialogflow_agent_id_and_query()
    {
        $defaultFallback = get_default_fallback('irene-lite-vbvypr', 'Who invented peanut butter?');

        $this->assertTrue(is_string($defaultFallback));
    }

    /**
     * @test
     */
    public function get_default_fallback_function_should_return_default_fallback_when_passed_user_id_and_query()
    {
        factory(\App\Models\WolframAlphaUser::class)->create(
            [
                'user_id' => 1,
                'token' => config('services.wolfram_alpha.api_key'),
                'status' => 'ENABLED'
            ]
        );

        $defaultFallback = get_default_fallback('1', 'Who invented peanut butter?');

        $this->assertTrue(is_string($defaultFallback));
    }
}
