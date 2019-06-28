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

        config(['app.dialogflow.irene_lite' => 'irene-lite-vbvypr']);
        config(['app.dialogflow.irene' => 'irene-4fe98']);
        config(['services.timezone_db.base_url' => 'https://api.timezonedb.com/v2.1/get-time-zone']);
        config(['services.timezone_db.api_key' => '0RPFRW3KR7BJ']);
    }

    /**
     * @test
     */
    public function get_current_date_time_method_shoud_return_current_date_time_when_passed_dialogflow_agent_id()
    {
        $currentDateTime = get_current_date_time('dialogflow/agent/irene-lite-vbvypr', 14.5906216, 120.9799696);

        $this->assertTrue(is_string($currentDateTime));
        $this->assertTrue(\DateTime::createFromFormat('Y-m-d H:i:s', $currentDateTime) !== false);
    }

    /**
     * @test
     */
    public function get_current_date_time_method_shoud_return_current_date_time_when_passed_user_id()
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
