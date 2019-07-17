<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutoRemoteHelperTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();  
    }

    /**
     * @test
     */
    public function send_autoremote_message_function_should_return_status_code_when_passed_dialogflow_agent_id_and_message()
    {
        $responseCode = send_autoremote_message('dialogflow/agent/irene-4fe98', 'TEST');

        $this->assertEquals($responseCode, 200);
    }

    /**
     * @test
     */
    public function send_autoremote_message_function_should_return_status_code_when_passed_user_id_and_message()
    {
        factory(\App\Models\Device::class)->create(
            [
                'status' => 'ENABLED',
                'code' => 'uvLPoqMf',
                'key' => 'fXbXbF6_tJo:APA91bFHN8DEiJ7BDRVMWSDEqJt_gWIqBTus1QhuevCUYmmgwf-ssqf5znXY4uCEoKZCBcjancLI3R8preYWBlWrrWhk4McWWmyKSKvJBrvaRCkIPJ_faOJFgR6wSvJwdTIGVPvh1hDm'
            ]
        );

        $responseCode = send_autoremote_message('uvLPoqMf', 'TEST');

        $this->assertEquals($responseCode, 200);
    }
}
