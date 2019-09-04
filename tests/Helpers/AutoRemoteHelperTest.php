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
        $responseCode = send_autoremote_message('irene-messenger', 'TEST');

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
                'code' => config('app.device.default'),
                'key' => config('services.autoremote.api_key')
            ]
        );

        $responseCode = send_autoremote_message(config('app.device.default'), 'TEST');

        $this->assertEquals($responseCode, 200);
    }
}
