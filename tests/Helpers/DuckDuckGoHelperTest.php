<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DuckDuckGoHelperTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function get_instant_answer_function_should_return_instant_answer_when_passed_dialogflow_agent_id_and_topic()
    {
        $instantAnswer = get_instant_answer('dialogflow/agent/irene-lite-vbvypr', 'Artificial intelligence');

        $this->assertArrayHasKey('AbstractText', $instantAnswer);
    }

    /**
     * @test
     */
    public function get_instant_answer_function_should_return_instant_answer_when_passed_user_id_and_topic()
    {
        factory(\App\Models\DuckDuckGoUser::class)->create(
            [
                'user_id' => 1,
                'status' => 'ENABLED'
            ]
        );

        $instantAnswer = get_instant_answer('1', 'Artificial intelligence');

        $this->assertArrayHasKey('AbstractText', $instantAnswer);
    }
}
