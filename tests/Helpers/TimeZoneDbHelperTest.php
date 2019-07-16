<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeZoneDbHelperTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();  
    }

    /**
     * @test
     */
    public function get_current_date_time_function_should_return_current_date_time_when_passed_dialogflow_agent_id_and_latitude_longitude()
    {
        $currentDateTime = get_current_date_time('dialogflow/agent/irene-lite-vbvypr', 14.5906216, 120.9799696);

        $this->assertTrue(is_string($currentDateTime));
        $this->assertTrue(\DateTime::createFromFormat('Y-m-d H:i:s', $currentDateTime) !== false);
    }

    /**
     * @test
     */
    public function get_current_date_time_function_should_return_current_date_time_when_passed_user_id_and_latitude_longitude()
    {
        factory(\App\Models\TimeZoneDbUser::class)->create(
            [
                'user_id' => 1,
                'token' => '0RPFRW3KR7BJ',
                'status' => 'ENABLED'
            ]
        );

        $currentDateTime = get_current_date_time('1', 14.5906216, 120.9799696);

        $this->assertTrue(is_string($currentDateTime));
        $this->assertTrue(\DateTime::createFromFormat('Y-m-d H:i:s', $currentDateTime) !== false);
    }
}
